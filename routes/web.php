<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisProductController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

##################################################################################################
// AUTHENTICATION
Route::get('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/store', [AuthController::class, 'store']);
Route::post('/auth/aksi_login', [AuthController::class, 'authenticate']);
Route::post('/auth/logout', [AuthController::class, 'logout']);

Route::get('/profiluser', [AuthController::class, 'profiluser'])->middleware('auth');
Route::get('/profiltoko', [AuthController::class, 'profiltoko'])->middleware('auth');
Route::put('/ubah_profile/{id}', [AuthController::class, 'update'])->middleware('auth');


##################################################################################################
// FRONT END
// Home Company
Route::get('/', [HomeController::class, 'index']);
Route::get('/home/company', [HomeController::class, 'company']);
Route::get('/home/jenisproduk/{id}', [HomeController::class, 'jenisproduct']);
Route::get('/home/produk/{id}', [HomeController::class, 'product']);
Route::get('/home/transaksi', [HomeController::class, 'trans'])->middleware('auth');
Route::put('/home/update_transaksi/{id}', [HomeController::class, 'update'])->middleware('auth');
Route::put('/home/batal_transaksi/{id}', [HomeController::class, 'batal'])->middleware('auth');
Route::put('/home/update_bayar/{id}', [HomeController::class, 'bayar'])->middleware('auth');
Route::put('/home/kirim_bukti/{id}', [HomeController::class, 'buktibayar'])->middleware('auth');
Route::put('/home/terima_pesanan/{id}', [HomeController::class, 'selesai'])->middleware('auth');
Route::post('/home/pesan', [HomeController::class, 'store'])->middleware('auth');
Route::delete('/home/delete_transaksi/{id}', [HomeController::class, 'destroy'])->middleware('auth');

##################################################################################################
// BACK END
Route::get('/dashboard/home', [DashboardController::class, 'index']);
Route::get('/dashboard/jenis_produk', [JenisProductController::class, 'index']);
Route::get('/dashboard/transaksi', [TransaksiController::class, 'index']);
Route::get('/dashboard/laporan_bm', [DashboardController::class, 'laporanbm']);
Route::get('/dashboard/laporan_pesanan', [DashboardController::class, 'laporanpesanan']);
Route::get('/dashboard/metode_bayar',[DashboardController::class, 'metodebayar']);
Route::put('/dashboard/transaksi_proses/{id}', [TransaksiController::class, 'update']);
Route::put('/dashboard/update_metodebayar/{id}', [DashboardController::class, 'updatemetodebayar']);
Route::post('/dashboard/save_metodebayar', [DashboardController::class, 'savemetodebayar']);
Route::post('/dashboard/lihat_bm', [DashboardController::class, 'lihatbm'])->middleware('auth');
Route::post('/dashboard/cetak_bm', [DashboardController::class, 'cetakbm'])->middleware('auth');
Route::post('/dashboard/lihat_pesanan', [DashboardController::class, 'lihatpesanan'])->middleware('auth');
Route::post('/dashboard/cetak_pesanan', [DashboardController::class, 'cetakpesanan'])->middleware('auth');
Route::post('/dashboard/product_upload/{id}', [ProductController::class, 'upload'])->middleware('auth');
Route::delete('/dashboard/delete_metodebayar/{id}', [DashboardController::class, 'destroy'])->middleware('auth');

Route::resource('/dashboard/customers', CustomerController::class);
Route::resource('/dashboard/jenis_products', JenisProductController::class);
Route::resource('/dashboard/products', ProductController::class);
Route::resource('/dashboard/karyawans', KaryawanController::class);
Route::resource('/dashboard/barang_masuks', BarangMasukController::class);
