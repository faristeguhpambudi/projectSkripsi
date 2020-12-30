//ALERT UNTUK kategori
const flashDataTindakan = $('.flash-data').data('flashdatatindakan');
if (flashDataTindakan) {
	Swal.fire({
		title: '<strong>Data Tindakan</strong>',
		text: 'Berhasil ' + flashDataTindakan,
		icon: 'success'
	});
}

//ALERT UNTUK historis
const flashDataHistoris = $('.flash-data').data('flashdatahistoris');
if (flashDataHistoris) {
	Swal.fire({
		title: '<strong>Data Historis</strong>',
		text: 'Berhasil ' + flashDataHistoris,
		icon: 'success'
	});
}


//ALERT UNTUK kategori
const flashDataKategori = $('.flash-data').data('flashdatakategori');
if (flashDataKategori) {
	Swal.fire({
		title: '<strong>Data Kategori</strong>',
		text: 'Berhasil ' + flashDataKategori,
		icon: 'success'
	});
}

//ALERT UNTUK dataperangkat
const flashDataPerangkat = $('.flash-data').data('flashdataperangkat');
if (flashDataPerangkat) {
	Swal.fire({
		title: '<strong>Data Perangkat</strong>',
		text: 'Berhasil ' + flashDataPerangkat,
		icon: 'success'
	});
}


//ALERT UNTUK datausers
const flashDataUsers = $('.flash-data').data('flashdatausers');
if (flashDataUsers) {
	Swal.fire({
		title: '<strong>Data User</strong>',
		text: 'Berhasil ' + flashDataUsers,
		icon: 'success'
	});
}

//ALERT UNTUK KC
const flashDataKC = $('.flash-data').data('flashdatakc');
if (flashDataKC) {
	Swal.fire({
		title: '<strong>Data Kantor Cabang</strong>',
		text: 'Berhasil ' + flashDataKC,
		icon: 'success'
	});
}


//ALERT UNTUK MENU
const flashDataMenu = $('.flash-data').data('flashdatamenu');
if (flashDataMenu) {
	Swal.fire({
		title: '<strong>Data Menu</strong>',
		text: 'Berhasil ' + flashDataMenu,
		icon: 'success'
	});
}

//ALERT UNTUK EDIT PROFIL
const flashDataProfil = $('.flash-data').data('flashdataprofil');
if (flashDataProfil) {
	Swal.fire({
		title: '<strong>Data Profil Anda</strong>',
		text: 'Berhasil ' + flashDataProfil,
		icon: 'success'
	});
}


//ALERT UNTUK SUBMENU
const flashDataSubMenu = $('.flash-data').data('flashdatasub');
if (flashDataSubMenu) {
	Swal.fire({
		title: '<strong>Data Sub Menu</strong>',
		text: 'Berhasil ' + flashDataSubMenu,
		icon: 'success'
	});
}

//ALERT UNTUK ROLE
const flashDataDataRole = $('.flash-data').data('flashdatadatarole');
if (flashDataDataRole) {
	Swal.fire({
		title: '<strong>Data Role</strong>',
		text: 'Berhasil ' + flashDataDataRole,
		icon: 'success'
	});
}


//ALERT UNTUK AKSES ROLE
const flashDataAksesRole = $('.flash-data').data('flashdataaksesrole');
if (flashDataAksesRole) {
	Swal.fire({
		title: '<strong>Hak Akses Role Ini</strong>',
		text: 'Berhasil ' + flashDataAksesRole,
		icon: 'success'
	});
}

//ALERT UNTUK ubah pass gagal
const flashDataPassGagal = $('.flash-data').data('flashdataubahpassgagal');
if (flashDataPassGagal) {
	Swal.fire({
		title: '<strong>Upss..</strong>',
		text: flashDataPassGagal,
		icon: 'error'
	});
}

//ALERT UNTUK ubah pass sukses
const flashDataPassSuk = $('.flash-data').data('flashdataubahpass');
if (flashDataPassSuk) {
	Swal.fire({
		title: '<strong>Yeayy!</strong>',
		text: flashDataPassSuk,
		icon: 'success'
	});
}

//ALERT KONFIRMASI HAPUS KATEGORI
$('.tombolHapusTindakan').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
		title: 'Yakin menghapus data ini?',
		text: 'Data Tindakan ini akan dihapus',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '<strong>Ya, Hapus Data</strong>',
		cancelButtonText: '<strong>Batal</strong>'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})
});

//ALERT KONFIRMASI HAPUS HISTORI
$('.tombolHapusHistori').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
		title: 'Yakin menghapus data ini?',
		text: 'Data Histori ini akan dihapus',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '<strong>Ya, Hapus Data</strong>',
		cancelButtonText: '<strong>Batal</strong>'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})
});




//ALERT KONFIRMASI HAPUS KATEGORI
$('.tombolHapusKategori').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
		title: 'Yakin menghapus data ini?',
		text: 'Data Kategori ini akan dihapus',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '<strong>Ya, Hapus Data</strong>',
		cancelButtonText: '<strong>Batal</strong>'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})
});



//ALERT KONFIRMASI HAPUS PERANGKAT
$('.tombolHapusPerangkat').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
		title: 'Yakin menghapus data ini?',
		text: 'Data Perangkat ini akan dihapus',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '<strong>Ya, Hapus Data</strong>',
		cancelButtonText: '<strong>Batal</strong>'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})
});


//ALERT KONFIRMASI HAPUS USERS
$('.tombolHapusUsers').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
		title: 'Yakin menghapus data ini?',
		text: 'Data User ini akan dihapus',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '<strong>Ya, Hapus Data</strong>',
		cancelButtonText: '<strong>Batal</strong>'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})
});

//ALERT KONFIRMASI HAPUS KANTORC
$('.tombolHapusKantorCabang').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
		title: 'Yakin menghapus data ini?',
		text: 'Data Kantor Cabang ini akan dihapus',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '<strong>Ya, Hapus Data</strong>',
		cancelButtonText: '<strong>Batal</strong>'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})
});


//ALERT KONFIRMASI HAPUS MENU
$('.tombolHapusMenu').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
		title: 'Yakin menghapus data ini?',
		text: 'Data Menu ini akan dihapus',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '<strong>Ya, Hapus Data</strong>',
		cancelButtonText: '<strong>Batal</strong>'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})
});

//ALERT KONFIRMASI HAPUS SUBMENU
$('.tombolHapusSubMenu').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
		title: 'Yakin menghapus data ini?',
		text: 'Data Sub Menu ini akan dihapus',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '<strong>Ya, Hapus Data</strong>',
		cancelButtonText: '<strong>Batal</strong>'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})
});

//ALERT KONFIRMASI HAPUS ROLE
$('.tombolHapusDataRole').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
		title: 'Yakin menghapus data ini?',
		text: 'Data Role ini akan dihapus',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '<strong>Ya, Hapus Data</strong>',
		cancelButtonText: '<strong>Batal</strong>'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})
});




//tmbol Logout
$('.tombolLogoutIni').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
		title: 'Yakin ingin logout?',
		text: 'Anda akan keluar dari sistem ini.',
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '<strong>Ya, Logout!</strong>',
		cancelButtonText: '<strong>Batal</strong>'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})
});
