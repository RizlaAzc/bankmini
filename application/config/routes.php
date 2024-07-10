<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'C_Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Route Auth
$route[''] = 'C_Auth';
$route['login'] = 'C_Auth/login';
$route['registrasi'] = 'C_Auth/registrasi';
$route['logout'] = 'C_Auth/logout';

// Route Transaksi
$route['transaksi'] = 'C_Transaksi';
$route['lakukan_transaksi'] = 'C_Transaksi/transaksi';
$route['export_transaksi'] = 'C_Transaksi/export';

// Route Tabungan
$route['tabungan_harian'] = 'tabungan/C_Harian';
$route['export_tabungan_harian'] = 'tabungan/C_Harian/export';
$route['mutasi_harian/(:any)'] = 'tabungan/C_Harian/mutasi/$1';
$route['export_mutasi_harian/(:any)'] = 'tabungan/C_Harian/export_mutasi/$1';

$route['tabungan_tahunan'] = 'tabungan/C_Tahunan';
$route['export_tabungan_tahunan'] = 'tabungan/C_Tahunan/export';
$route['mutasi_tahunan/(:any)'] = 'tabungan/C_Tahunan/mutasi/$1';
$route['export_mutasi_tahunan/(:any)'] = 'tabungan/C_Tahunan/export_mutasi/$1';

// Route Data
$route['kelas'] = 'data/C_kelas';
$route['tambah_kelas'] = 'data/C_Kelas/fungsi_tambah';
$route['edit_kelas/(:any)'] = 'data/C_Kelas/edit/$1';
$route['fungsi_edit_kelas'] = 'data/C_Kelas/fungsi_edit';
$route['fungsi_hapus_kelas/(:any)'] = 'data/C_Kelas/fungsi_hapus/$1';
$route['download_template_kelas'] = 'data/C_Kelas/download_template';
$route['export_kelas'] = 'data/C_Kelas/export';
$route['import_kelas'] = 'data/C_Kelas/import';

$route['petugas'] = 'data/C_petugas';
$route['level_admin/(:any)'] = 'data/C_Petugas/admin_level_user/$1';
$route['level_petugas/(:any)'] = 'data/C_Petugas/petugas_level_user/$1';
$route['active_status/(:any)'] = 'data/C_Petugas/active_status_user/$1';
$route['deactive_status/(:any)'] = 'data/C_Petugas/deactive_status_user/$1';
$route['fungsi_hapus_petugas/(:any)'] = 'data/C_Petugas/fungsi_hapus/$1';
$route['export_petugas'] = 'data/C_Petugas/export';

$route['siswa'] = 'data/C_siswa';
$route['tambah_siswa'] = 'data/C_Siswa/fungsi_tambah';
$route['edit_siswa/(:any)'] = 'data/C_Siswa/edit/$1';
$route['fungsi_edit_siswa'] = 'data/C_Siswa/fungsi_edit';
$route['fungsi_hapus_siswa/(:any)'] = 'data/C_Siswa/fungsi_hapus/$1';
$route['download_template_siswa'] = 'data/C_Siswa/download_template';
$route['export_siswa'] = 'data/C_Siswa/export';
$route['import_siswa'] = 'data/C_Siswa/import';