$(function () {

	//UNTUK MODAL KATEGORI
	$('.tombolTambahDataKategori').on('click', function () {
		$('#formModalKategoriBaruLabel').html('<strong>Tambah Data Kategori</strong>');
		$('.buttonModal').html('<strong>Tambah Data!</strong>');
		$('.aksiModalKategori').attr('action', base_url + 'admin/kategoriPerangkat');
		$('#nama_kategori').val("");
		$('#id_kategori').val("");
	});
	$('.tampilModalUbahKategori').on('click', function () {
		//UBAH TAMPILAN HTML DI MODAL
		$('#formModalKategoriBaruLabel').html('<strong>Ubah Data Kategori</strong>');
		$('.buttonModal').html('<strong>Ubah Data!</strong>');
		$('.aksiModalKategori').attr('action', base_url + 'admin/ubahKategori');

		//AMBIL ID YANG MAU DIUPDATE
		const id_kategori = $(this).data('id');

		//JALANIN AJAX
		$.ajax({
			url: base_url + 'admin/getUbahKategori',
			data: {
				id_kategori: id_kategori
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				$('#id_kategori').val(data.id_kategori);
				$('#nama_kategori').val(data.nama_kategori);
			}
		});
	});


	//UNTUK MODAL KANTOR CABANG
	$('.tombolTambahDataKC').on('click', function () {
		$('#formModalKCBaruLabel').html('<strong>Tambah Data Kantor Cabang</strong>');
		$('.buttonModal').html('<strong>Tambah Data!</strong>');
		$('.aksiModalKC').attr('action', base_url + 'admin/dataKantorCabang');
		$('#kode_cabang').val("");
		$('#nama_kantorcabang').val("");
		$('#id_kantorcabang').val("");
	});
	$('.tombolUbahKC').on('click', function () {
		//UBAH TAMPILAN HTML DI MODAL
		$('#formModalKCBaruLabel').html('<strong>Ubah Data Kantor Cabang</strong>');
		$('.buttonModal').html('<strong>Ubah Data!</strong>');
		$('.aksiModalKC').attr('action', base_url + 'admin/ubahKC');

		//AMBIL ID YANG MAU DIUPDATE
		const id_kantorcabang = $(this).data('id');

		//JALANIN AJAX
		$.ajax({
			url: base_url + 'admin/getUbahKC',
			data: {
				id_kantorcabang: id_kantorcabang
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				$('#id_kantorcabang').val(data.id_kantorcabang);
				$('#kode_cabang').val(data.kode_cabang);
				$('#nama_kantorcabang').val(data.nama_kantorcabang);
			}
		});
	});


	//UNTUK MODAL MENU
	$('.tombolTambahDataMenu').on('click', function () {
		$('#formModalMenuBaruLabel').html('<strong>Tambah Menu Baru</strong>');
		$('.buttonModal').html('<strong>Tambah Data!</strong>');
		$('.aksiModalMenu').attr('action', base_url + 'menu');
		$('#nama_menu').val("");
		$('#id_user_menu').val("");
		$('#controller').val("");
	});
	$('.tampilModalUbahMenu').on('click', function () {
		//UBAH TAMPILAN HTML DI MODAL
		$('#formModalMenuBaruLabel').html('<strong>Ubah Data Menu</strong>');
		$('.buttonModal').html('<strong>Ubah Data!</strong>');
		$('.aksiModalMenu').attr('action', base_url + 'menu/ubahMenu');

		//AMBIL ID YANG MAU DIUPDATE
		const id_user_menu = $(this).data('id');

		//JALANIN AJAX
		$.ajax({
			url: base_url + 'menu/getUbahMenu',
			data: {
				id_user_menu: id_user_menu
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				$('#id_user_menu').val(data.id_user_menu);
				$('#nama_menu').val(data.nama_menu);
				$('#controller').val(data.controller);
			}
		});
	});


	//UNTUK MODAL SUBMENU
	$('.tombolTambahDataSubMenu').on('click', function () {
		$('#formModalSubMenuBaruLabel').html('<strong>Tambah Sub Menu Baru</strong>');
		$('.buttonModal').html('<strong>Tambah Data!</strong>');
		$('.aksiModalSubMenu').attr('action', base_url + 'menu/submenu');
		$('#judul').val("");
		$('#id_user_menu').val("");
		$('#url').val("");
		$('#icon').val("");
		$('#id_user_sub_menu').val("");
	});
	$('.tampilModalUbahSubMenu').on('click', function () {
		//UBAH TAMPILAN HTML DI MODAL
		$('#formModalSubMenuBaruLabel').html('<strong>Ubah Data Sub Menu</strong>');
		$('.buttonModal').html('<strong>Ubah Data!</strong>');
		$('.aksiModalSubMenu').attr('action', base_url + 'menu/ubahSubMenu');

		//AMBIL ID YANG MAU DIUPDATE
		const id_user_sub_menu = $(this).data('id');

		//JALANIN AJAX
		$.ajax({
			url: base_url + 'menu/getUbahSubMenu',
			data: {
				id_user_sub_menu: id_user_sub_menu
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				$('#id_user_sub_menu').val(data.id_user_sub_menu);
				$('#judul').val(data.judul);
				$('#id_user_menu').val(data.id_user_menu);
				$('#url').val(data.url);
				$('#icon').val(data.icon);
				$('#is_active').val(data.is_active);
			}
		});
	});

	//UNTUK MODAL ROLE
	$('.tombolTambahDataRole').on('click', function () {
		$('#formModalRoleBaruLabel').html('<strong>Tambah Role Baru</strong>');
		$('.buttonModal').html('<strong>Tambah Data!</strong>');
		$('.aksiModalRole').attr('action', base_url + 'admin/role');
		$('#id_user_role').val("");
		$('#role').val("");
	});
	$('.tampilModalUbahRole').on('click', function () {
		//UBAH TAMPILAN HTML DI MODAL
		$('#formModalRoleBaruLabel').html('<strong>Ubah Data Role</strong>');
		$('.buttonModal').html('<strong>Ubah Data!</strong>');
		$('.aksiModalRole').attr('action', base_url + 'admin/ubahRole');

		//AMBIL ID YANG MAU DIUPDATE
		const id_user_role = $(this).data('id');

		//JALANIN AJAX
		$.ajax({
			url: base_url + 'admin/getUbahRole',
			data: {
				id_user_role: id_user_role
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				$('#id_user_role').val(data.id_user_role);
				$('#role').val(data.role);
			}
		});
	});
});
