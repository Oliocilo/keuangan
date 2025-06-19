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

//LOGIN
$route['processLogin'] = 'login/processLogin';
$route['register'] = 'login/register';
$route['reset'] = 'login/reset';
$route['processRegister'] = 'login/processRegister';
$route['processReset'] = 'login/processReset';
$route['processBukukas'] = 'login/processBukukas';
$route['logoutAdmin'] = 'login/logout';

//BOOKTRANSAKSI
$route['book/id/(:any)'] = 'book/index/$1';

//UTANG PIUTANG
$route['debt'] = 'utangpiutang/index/Utang';
$route['debt/id/(:any)'] = 'utangpiutang/details/$1';
$route['debt/delete/(:any)'] = 'utangpiutang/delete/$1';
$route['debt/delete/(:any)/(:any)'] = 'utangpiutang/delete/$1/$2';
$route['debt/detail/delete/(:any)'] = 'utangpiutang/deleteDetail/$1';
$route['debt/detail/delete/(:any)/(:any)'] = 'utangpiutang/deleteDetail/$1/$2';
$route['credit'] = 'utangpiutang/index/Piutang';
$route['credit/id/(:any)'] = 'utangpiutang/details/$1';
$route['credit/delete/(:any)'] = 'utangpiutang/delete/$1';
$route['credit/delete/(:any)/(:any)'] = 'utangpiutang/delete/$1/$2';
$route['credit/detail/delete/(:any)'] = 'utangpiutang/deleteDetail/$1';
$route['credit/detail/delete/(:any)/(:any)'] = 'utangpiutang/deleteDetail/$1/$2';

//BARANG
$route['barang/jual'] = 'penjualanbarang';
$route['barang/jual/add'] = 'penjualanbarang/add';
$route['barang/jual/add_barang'] = 'penjualanbarang/addBarang';
$route['barang'] = 'master/barang';
$route['barang/add'] = 'master/barang/add';
$route['barang/edit/(:any)'] = 'master/barang/edit/$1';
$route['barang/update/(:any)'] = 'master/barang/update/$1';
$route['barang/stok/(:any)'] = 'master/barang/stok/$1';
$route['barang/stok/update/(:any)'] = 'master/barang/updateStok/$1';

//CATATAN
$route['catatan'] = 'alat/catatan/index';
$route['catatan/update/(:any)'] = 'alat/catatan/update/$1';
$route['catatan/delete/(:any)'] = 'alat/catatan/delete/$1';
$route['invoice'] = 'alat/einvoice';

//Akun Saya
$route['akun'] = 'pengaturan/akun';
$route['akun/update'] = 'pengaturan/akun/update';

//Multi User
$route['pengguna'] = 'master/user';

//Riwayat Pembayaran
$route['pembayaran'] = 'pengaturan/riwayatpembayaran';

//Riwayat Pembayaran
$route['premium'] = 'pengaturan/premium';
$route['premium/buy/(:any)'] = 'pengaturan/premium/buy/$1';

//Admin Web
$route['conf/adminweb'] = 'adminweb/home_aw/index';
$route['conf/pengguna'] = 'adminweb/pengguna_aw/index';
$route['conf/pengguna/json'] = 'adminweb/pengguna_aw/jsonData';
$route['conf/pengguna/detail/(:num)'] = 'adminweb/pengguna_aw/detail/$1';

$route['conf/premium'] = 'adminweb/premium_aw/index';
$route['conf/premium/add'] = 'adminweb/premium_aw/add';
$route['conf/premium/store'] = 'adminweb/premium_aw/store';
$route['conf/premium/json'] = 'adminweb/premium_aw/jsonData';
$route['conf/premium/edit/(:num)'] = 'adminweb/premium_aw/edit/$1';
$route['conf/premium/update'] = 'adminweb/premium_aw/update';
$route['conf/premium/delete'] = 'adminweb/premium_aw/delete';

$route['conf/rekening'] = 'adminweb/rekening_aw/index';
$route['conf/rekening/add'] = 'adminweb/rekening_aw/add';
$route['conf/rekening/store'] = 'adminweb/rekening_aw/store';
$route['conf/rekening/json'] = 'adminweb/rekening_aw/jsonData';
$route['conf/rekening/edit/(:num)'] = 'adminweb/rekening_aw/edit/$1';
$route['conf/rekening/update'] = 'adminweb/rekening_aw/update';
$route['conf/rekening/delete'] = 'adminweb/rekening_aw/delete';

$route['conf/transaksi'] = 'adminweb/transaksi_aw/index';
$route['conf/transaksi/json'] = 'adminweb/transaksi_aw/jsonData';
$route['conf/transaksi/konfirmasi_pembayaran/(:num)'] = 'adminweb/transaksi_aw/konf_pembayaran/$1';







$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
