<?php
# KONTROL MENU PROGRAM
if ($_GET) {
	// Jika mendapatkan variabel URL ?page
	switch($_GET['page']) {
		case '' :
			if (!file_exists("admin.dashboard.php")) die ("Halaman tidak ditemukan!");
			include "admin.dashboard.php";
		break;
		case 'dashboard' :
			if (!file_exists("admin.dashboard.php")) die ("Halaman tidak ditemukan!"); 
			include "admin.dashboard.php";
		break;
			
		// TAMPIL DATA
		case 'data_relawan_kab' :
			if (!file_exists("admin.data_relawan_kab.php")) die ("Halaman tidak ditemukan!"); 
			include "admin.data_relawan_kab.php";
		break;

		case 'data_saksi_kab' :
			if (!file_exists("admin.data_saksi_kab.php")) die ("Halaman tidak ditemukan!"); 
			include "admin.data_saksi_kab.php";
		break;

		// TAMBAH DATA
		case 'form_add_relawan_kab' :
			if (!file_exists("admin.form_add_relawan_kab.php")) die ("Halaman tidak ditemukan!"); 
			include "admin.form_add_relawan_kab.php";
		break;

		case 'form_add_saksi_kab' :
			if (!file_exists("admin.form_add_saksi_kab.php")) die ("Halaman tidak ditemukan!"); 
			include "admin.form_add_saksi_kab.php";
		break;

		// EDIT DATA
		case 'form_edit_relawan_kab' :
			if (!file_exists("admin.form_edit_relawan_kab.php")) die ("Halaman tidak ditemukan!"); 
			include "admin.form_edit_relawan_kab.php";
		break;

		case 'form_edit_saksi_kab' :
			if (!file_exists("admin.form_edit_saksi_kab.php")) die ("Halaman tidak ditemukan!"); 
			include "admin.form_edit_saksi_kab.php";
		break;

		// DATA LAINNYA
		default:
			if (!file_exists("admin.dashboard.php")) die ("Halaman tidak ditemukan!"); 
			include "admin.dashboard.php";							
		break;
	}
} else {
	// Jika tidak mendapatkan variabel URL : ?page
	if (!file_exists("admin.dashboard.php")) die ("Halaman tidak ditemukan!"); 
	include "admin.dashboard.php";	
}

?>