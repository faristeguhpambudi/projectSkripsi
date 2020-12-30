<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adminkantorcabang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //MENJALANKAN HELPER FUNCTION CEK LOGIN
        apakah_sudah_login(); //dalam folder helper
        //MEMANGGIL MODEL DI CONSTRUCT
        $this->load->model('User_model');
        $this->load->model('Role_model');
        $this->load->model('Menu_model');
        $this->load->model('KantorCabang_model');
        $this->load->model('Perangkat_model');
        $this->load->model('Tindakan_model');
        $this->load->model('Historis_model');
    }

    public function index()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Data Perangkat";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["perangkat"]  = $this->Perangkat_model->getAllPerangkatByKC($idKC);

        //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('perangkat/dataperangkatkc', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function detailPerangkat($id_perangkat)
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Detail Perangkat";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["perangkatDetail"] = $this->Perangkat_model->getPerangkatById($id_perangkat);

        //MEMANGGIL VIEW HALAMAN LOGIN    
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('perangkat/detaildataperangkat', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function tambahDataPerangkatKC()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Tambah Data Perangkat";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["kantorCabang"]  = $this->KantorCabang_model->getAllKantorCabang();
        $data["kategori"]  = $this->Perangkat_model->getAllKategori();
        $idKC = $data["user"]["id_kantorcabang"];

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH PERANGKAT
        $this->form_validation->set_rules('serial_number', 'Serial Number', 'required|trim', [
            'required' => 'Kolom serial number tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required|trim', [
            'required' => 'Kolom kategori tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('end_of_life', 'End of life', 'required|trim', [
            'required' => 'Kolom End of Life tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('end_of_sale', 'End of Sale', 'required|trim', [
            'required' => 'Kolom End of Sale tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('last_date_support', 'Last Date Support', 'required|trim', [
            'required' => 'Kolom Last date support tidak boleh kosong!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            // MEMANGGIL VIEW HALAMAN TAMBAH DATA USER
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('perangkat/tambahdataperangkatkc', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            // //KE METHOD YANG ADA DI MODEL
            $this->Perangkat_model->tambahDataPerangkatKC($idKC);
            // //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanDataPerangkat", "ditambah");
            // //ALIHKAN HALAMAN
            redirect('adminkantorcabang');
        }
    }

    public function hapusPerangkat($id_perangkat)
    {
        //KE METHOD YANG ADA DI MODEL
        $this->Perangkat_model->hapusDataPerangkat($id_perangkat);
        //KIRIM FLASHDATA
        $this->session->set_flashdata("flashPesanDataPerangkat", "dihapus");
        //ALIHKAN HALAMAN
        redirect('adminkantorcabang');
    }

    public function ubahPerangkat($id_perangkat)
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Ubah Data Perangkat";
        $data["user"] = $this->User_model->dataSessionUser();
        $data["perangkatbyid"] = $this->Perangkat_model->getPerangkatById($id_perangkat);
        $data["kantorCabang"]  = $this->KantorCabang_model->getAllKantorCabang();
        $data["kategori"]  = $this->Perangkat_model->getAllKategori();
        $idKC = $data["user"]["id_kantorcabang"];

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH PERANGKAT
        $this->form_validation->set_rules('serial_number', 'Serial Number', 'required|trim', [
            'required' => 'Kolom serial number tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required|trim', [
            'required' => 'Kolom kategori tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('end_of_life', 'End of life', 'required|trim', [
            'required' => 'Kolom End of Life tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('end_of_sale', 'End of Sale', 'required|trim', [
            'required' => 'Kolom End of Sale tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('last_date_support', 'Last Date Support', 'required|trim', [
            'required' => 'Kolom Last date support tidak boleh kosong!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            // MEMANGGIL VIEW HALAMAN TAMBAH DATA USER
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('perangkat/ubahdataperangkatkc', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            // //KE METHOD YANG ADA DI MODEL
            $this->Perangkat_model->ubahDataPerangkatKC($idKC);
            // //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanDataPerangkat", "diubah");
            // //ALIHKAN HALAMAN
            redirect('adminkantorcabang');
        }
    }

    public function tindakan()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Data Tindakan";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["tindakan"]  = $this->Tindakan_model->getAllTindakanByKC($idKC);

        //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('tindakan/datatindakankc', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function tambahDataTindakanKC()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Tambah Data Tindakan";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["teknisi"]  = $this->Tindakan_model->getAllTeknisiByKC($idKC);
        $data["perangkat"]  = $this->Perangkat_model->getAllPerangkatByKC($idKC);

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH PERANGKAT
        $this->form_validation->set_rules('kode_tindakan', 'kode', 'required|trim', [
            'required' => 'Kolom kode tindakan tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('tgl_tindakan', 'tgl', 'required|trim', [
            'required' => 'Kolom tanggal tindakan tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_user', 'teknisi', 'required|trim', [
            'required' => 'Kolom teknisi tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_perangkat', 'perangkat', 'required|trim', [
            'required' => 'Kolom perangkat tidak boleh kosong!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            // MEMANGGIL VIEW HALAMAN TAMBAH DATA USER
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('tindakan/tambahdatatindakankc', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            // //KE METHOD YANG ADA DI MODEL
            $this->Tindakan_model->tambahDataTindakanKC();
            // //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanDataTindakan", "ditambah");
            // //ALIHKAN HALAMAN
            redirect('adminkantorcabang/tindakan');
        }
    }

    public function hapusTindakan($id_tindakan)
    {
        //KE METHOD YANG ADA DI MODEL
        $this->Tindakan_model->hapusDataTindakan($id_tindakan);
        //KIRIM FLASHDATA
        $this->session->set_flashdata("flashPesanDataTindakan", "dihapus");
        //ALIHKAN HALAMAN
        redirect('adminkantorcabang/tindakan');
    }

    public function ubahDataTindakanKC($id_tindakan)
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Ubah Data Tindakan";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["teknisi"]  = $this->Tindakan_model->getAllTeknisiByKC($idKC);
        $data["perangkat"]  = $this->Perangkat_model->getAllPerangkatByKC($idKC);
        $data["tindakanbyid"] = $this->Tindakan_model->getTindakanById($id_tindakan);


        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH PERANGKAT
        $this->form_validation->set_rules('kode_tindakan', 'kode', 'required|trim', [
            'required' => 'Kolom kode tindakan tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('tgl_tindakan', 'tgl', 'required|trim', [
            'required' => 'Kolom tanggal tindakan tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_user', 'teknisi', 'required|trim', [
            'required' => 'Kolom teknisi tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_perangkat', 'perangkat', 'required|trim', [
            'required' => 'Kolom perangkat tidak boleh kosong!'
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            // MEMANGGIL VIEW HALAMAN TAMBAH DATA USER
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('tindakan/ubahdatatindakankc', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            // //KE METHOD YANG ADA DI MODEL
            $this->Tindakan_model->ubahDataTindakanKC();
            // //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanDataTindakan", "diubah");
            // //ALIHKAN HALAMAN
            redirect('adminkantorcabang/tindakan');
        }
    }

    public function detailTindakan($id_tindakan)
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Detail Tindakan";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["tindakan"]  = $this->Tindakan_model->getAllTindakanByKC($idKC);
        $data["tindakanbyid"] = $this->Tindakan_model->getTindakanById($id_tindakan);

        //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('tindakan/detailtindakan', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function historis()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Data Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["historis"]  = $this->Historis_model->getAllHistorisByKC($idKC);

        //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('historis/datahistoriskc', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function tambahDataHistorisKC()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Tambah Data Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["teknisi"]  = $this->Tindakan_model->getAllTeknisiByKC($idKC);
        $data["perangkat"]  = $this->Perangkat_model->getAllPerangkatByKC($idKC);
        $data["tindakan"]  = $this->Tindakan_model->getAllTindakanByKC($idKC);
        $data["status"]  = $this->KantorCabang_model->getAllStatus();
        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH PERANGKAT
        $this->form_validation->set_rules('tgl_historis', 'tgl', 'required|trim', [
            'required' => 'Kolom tanggal historis tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_tindakan', 'tindakan', 'required|trim', [
            'required' => 'Kolom kode tindakan tidak boleh kosong!'
        ]);
        // $this->form_validation->set_rules('status_perangkat', 'status', 'required|trim', [
        //     'required' => 'Kolom status perangkat tidak boleh kosong!'
        // ]);
        $this->form_validation->set_rules('biaya', 'biaya', 'required|trim|integer', [
            'required' => 'Kolom biaya tidak boleh kosong!',
            'integer' => 'Yang anda masukkan bukan angka!',
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            // MEMANGGIL VIEW HALAMAN TAMBAH DATA USER
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('historis/tambahdatahistoriskc', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            // //KE METHOD YANG ADA DI MODEL
            $this->Historis_model->tambahDataHistorisKC();
            // //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanDataHistoris", "ditambah");
            // //ALIHKAN HALAMAN
            redirect('adminkantorcabang/historis');
        }
    }

    public function hapusHistoris($id_historis)
    {
        //KE METHOD YANG ADA DI MODEL
        $this->Historis_model->hapusDataHistoris($id_historis);
        //KIRIM FLASHDATA
        $this->session->set_flashdata("flashPesanDataHistoris", "dihapus");
        //ALIHKAN HALAMAN
        redirect('adminkantorcabang/historis');
    }

    public function ubahDataHistorisKC($id_historis)
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Ubah Data Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["tindakan"]  = $this->Tindakan_model->getAllTindakanByKC($idKC);
        $data["historisid"] = $this->Historis_model->getHistorisById($id_historis);

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH PERANGKAT
        $this->form_validation->set_rules('tgl_historis', 'tgl', 'required|trim', [
            'required' => 'Kolom tanggal historis tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_tindakan', 'tindakan', 'required|trim', [
            'required' => 'Kolom kode tindakan tidak boleh kosong!'
        ]);
        // $this->form_validation->set_rules('status_perangkat', 'status', 'required|trim', [
        //     'required' => 'Kolom status perangkat tidak boleh kosong!'
        // ]);
        $this->form_validation->set_rules('biaya', 'biaya', 'required|trim|integer', [
            'required' => 'Kolom biaya tidak boleh kosong!',
            'integer' => 'Yang anda masukkan bukan angka!',
        ]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            // MEMANGGIL VIEW HALAMAN TAMBAH DATA USER
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('historis/ubahdatahistoriskc', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            // //KE METHOD YANG ADA DI MODEL
            $this->Historis_model->ubahDataHistorisKC();
            // //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanDataHistoris", "diubah");
            // //ALIHKAN HALAMAN
            redirect('adminkantorcabang/historis');
        }
    }

    public function detailHistoris($id_historis)
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Detail Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["tindakan"]  = $this->Tindakan_model->getAllTindakanByKC($idKC);
        $data["historisbyid"] = $this->Historis_model->getHistorisById($id_historis);

        //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('historis/detailhistoris', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function laporanHistoris()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Laporan Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["historis"]  = $this->Historis_model->getAllHistorisByKC($idKC);


        //ATUR RULE
        $this->form_validation->set_rules("tanggalmulai", "Tanggal Mulai", "required");
        $this->form_validation->set_rules("tanggalselesai", "Tanggal Selesai", "required");

        $data["tanggalmulai"] = $this->input->post("tanggalmulai");
        $data["tanggalselesai"] = $this->input->post("tanggalselesai");
        $data["submit"] = $this->input->post("submit");
        $this->session->set_userdata('tanggalmulai', $data["tanggalmulai"]);
        $this->session->set_userdata('tanggalselesai', $data["tanggalselesai"]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('historis/laporanhistoriskc', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            //MENGIRIM DATA HISTORI DENGAN CARI
            $data["historis"]  = $this->Historis_model->cariDataHistorisforLaporanKC($idKC);
            //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('historis/laporanhistoriskc', $data);
            $this->load->view('templates/halaman_footer', $data);
        }
    }

    public function cetakLaporanHistoris()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Laporan Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["historis"]  = $this->Historis_model->getAllHistorisByKC($idKC);

        $data["tanggalmulai"] = $this->input->post("tanggalmulai");
        $data["tanggalselesai"] = $this->input->post("tanggalselesai");
        $data["submit"] = $this->input->post("submit");
        $tanggalmulai = $this->session->userdata('tanggalmulai');
        $tanggalmulai = $this->session->userdata('tanggalselesai');
        //JIKA
        if ($tanggalmulai == null) {
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->filename = "laporan-historiskc.pdf";
            $this->pdf->load_view('historis/laporankcpdf', $data);
        } else {
            $data["historis"]  = $this->Historis_model->cariDataHistorisforLaporan3($idKC);
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->filename = "laporan-historiskc.pdf";
            $this->pdf->load_view('historis/laporankcpdf', $data);
        }
    }

    public function laporanTindakan()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Laporan Tindakan";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["tindakan"]  = $this->Tindakan_model->getAllTindakanByKC($idKC);


        //ATUR RULE
        $this->form_validation->set_rules("tanggalmulai", "Tanggal Mulai", "required");
        $this->form_validation->set_rules("tanggalselesai", "Tanggal Selesai", "required");

        $data["tanggalmulai"] = $this->input->post("tanggalmulai");
        $data["tanggalselesai"] = $this->input->post("tanggalselesai");
        $data["submit"] = $this->input->post("submit");
        $this->session->set_userdata('tanggalmulai', $data["tanggalmulai"]);
        $this->session->set_userdata('tanggalselesai', $data["tanggalselesai"]);

        //JIKA ISI FORM VALIDASINYA SALAH
        if ($this->form_validation->run() == false) {
            //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('tindakan/laporantindakankc', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            //MENGIRIM DATA HISTORI DENGAN CARI
            $data["tindakan"]  = $this->Tindakan_model->cariDataTindakanforLaporanKC($idKC);
            //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
            $this->load->view('templates/halaman_header', $data);
            $this->load->view('templates/halaman_sidebar', $data);
            $this->load->view('templates/halaman_topbar', $data);
            $this->load->view('tindakan/laporantindakankc', $data);
            $this->load->view('templates/halaman_footer', $data);
        }
    }

    public function cetakLaporanTindakan()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Laporan Historis";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["tindakan"]  = $this->Tindakan_model->getAllTindakanByKC($idKC);

        $data["tanggalmulai"] = $this->input->post("tanggalmulai");
        $data["tanggalselesai"] = $this->input->post("tanggalselesai");
        $data["submit"] = $this->input->post("submit");
        $tanggalmulai = $this->session->userdata('tanggalmulai');
        $tanggalmulai = $this->session->userdata('tanggalselesai');
        //JIKA
        if ($tanggalmulai == null) {
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->filename = "laporan-tindakankc.pdf";
            $this->pdf->load_view('tindakan/laporankcpdf', $data);
        } else {
            $data["tindakan"]  = $this->Tindakan_model->cariDataTindakanforLaporan2($idKC);
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->filename = "laporan-tindakankc.pdf";
            $this->pdf->load_view('tindakan/laporankcpdf', $data);
        }
    }
}
