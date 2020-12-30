<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teknisi extends CI_Controller
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
        $this->load->model('Teknisi_model');
    }

    public function index()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Data Perangkat KC";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["perangkat"]  = $this->Perangkat_model->getAllPerangkatByKC($idKC);

        //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('teknisi/dataperangkatkc', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function tindakan()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Tindakan";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["tindakan"]  = $this->Tindakan_model->getAllTindakanByKC($idKC);

        //MEMANGGIL VIEW HALAMAN DATA KANTOR CABANG
        $this->load->view('templates/halaman_header', $data);
        $this->load->view('templates/halaman_sidebar', $data);
        $this->load->view('templates/halaman_topbar', $data);
        $this->load->view('teknisi/datatindakankc', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function tambahDataTindakanKC()
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Tambah Tindakan";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["perangkat"]  = $this->Perangkat_model->getAllPerangkatByKC($idKC);

        //MENYIAPKAN ATURAN/SYARAT UNTUK FORM TAMBAH PERANGKAT
        $this->form_validation->set_rules('kode_tindakan', 'kode', 'required|trim', [
            'required' => 'Kolom kode tindakan tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('tgl_tindakan', 'tgl', 'required|trim', [
            'required' => 'Kolom tanggal tindakan tidak boleh kosong!'
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
            $this->load->view('teknisi/tambahdatatindakankc', $data);
            $this->load->view('templates/halaman_footer', $data);
        } else {
            // //KE METHOD YANG ADA DI MODEL
            $this->Teknisi_model->tambahDataTindakanKC();
            // //KIRIM FLASHDATA
            $this->session->set_flashdata("flashPesanDataTindakan", "ditambah");
            // //ALIHKAN HALAMAN
            redirect('teknisi/tindakan');
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
        $this->load->view('teknisi/detailtindakan', $data);
        $this->load->view('templates/halaman_footer', $data);
    }

    public function cetakTindakan($id_tindakan)
    {
        //MENYIAPKAN DATA UNTUK DIKIRIM
        $data["judulHalaman"] = "Detail Tindakan";
        $data["user"] = $this->User_model->dataSessionUser();
        $idKC = $data["user"]["id_kantorcabang"];
        $data["tindakan"]  = $this->Tindakan_model->getAllTindakanByKC($idKC);
        $data["tindakanbyid"] = $this->Tindakan_model->getTindakanById($id_tindakan);


        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "buktitindakan.pdf";
        $this->pdf->load_view('teknisi/buktitindakanpdf', $data);
    }
}
