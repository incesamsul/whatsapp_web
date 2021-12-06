<?php

// use App\Http\Controllers\Controller;
use App\Http\Controllers\Absensi;
use App\Http\Controllers\admin\Admin;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Laporan;
use App\Http\Controllers\admin\Dashboard;
use App\Http\Controllers\admin\KategoriProduk;
use App\Http\Controllers\admin\LaporanPenjualan;
use App\Http\Controllers\admin\LaporanStokKeluar;
use App\Http\Controllers\admin\LaporanStokMasuk;
use App\Http\Controllers\admin\Pelanggan;
use App\Http\Controllers\admin\Produk;
use App\Http\Controllers\admin\SatuanProduk;
use App\Http\Controllers\admin\StokKeluar;
use App\Http\Controllers\admin\StokMasuk;
use App\Http\Controllers\admin\Suplier;
use App\Http\Controllers\admin\Transaksi;
use App\Http\Controllers\Kasir;
use App\Http\Controllers\Main;
use App\Http\Controllers\MyAjax;
use App\Http\Controllers\UserController;
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

Route::get('/logout', [Authentication::class, 'logout']);
Route::post('/postlogin', [Authentication::class, 'postLogin']);
Route::post('/postRegister', [UserController::class, 'postRegister']);

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [Authentication::class, 'wrapperLogin']);
    Route::get('/login', [Authentication::class, 'qrLogin'])->name('login');
    Route::get('/registration', [UserController::class, 'registration']);
    Route::get('/login-biasa', [Authentication::class, 'login'])->name('login');
    Route::get('/ajax/qrcodeCheck', [MyAjax::class, 'qrcodeCheck']);
    Route::post('/ajax/ajaxPostLogin', [MyAjax::class, 'ajaxPostLogin']);
});


Route::group(['middleware' => ['auth', 'ceklevel:1']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [Admin::class, 'home']);
        Route::get('/dashboard', [Admin::class, 'home']);
        Route::get('/dashboard/chart-tahunan/{user_id}', [Admin::class, 'home']);
        Route::get('/dashboard/chart-bulanan/{bln}', [Admin::class, 'home']);
        Route::get('/managementuser', [Admin::class, 'user']);
        // Management User
        Route::post('/tambah-user', [Admin::class, 'tambahUser']);
        Route::post('/ubah-user', [Admin::class, 'ubahUser']);
        Route::post('/hapus-user', [Admin::class, 'hapusUser']);
        Route::get('/laporan-harian', [Admin::class, 'laporanHarian']);
        Route::get('/laporan-harian/{tgl}', [Admin::class, 'laporanHarian']);
        Route::get('/laporan-bulanan', [Admin::class, 'laporanBulanan']);
        Route::get('/laporan-bulanan/{bln}', [Admin::class, 'laporanBulanan']);
        Route::get('/laporan-perpegawai', [Admin::class, 'laporanPerPegawai']);
        Route::get('/laporan-perpegawai/{user_id}', [Admin::class, 'laporanPerPegawai']);
    });
});

Route::group(['middleware' => ['auth', 'ceklevel:1,2,3']], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/fetch_data_chat', [UserController::class, 'fetchDataChat']);
        Route::post('/send_message', [UserController::class, 'sendMessage']);
    });
});

Route::group(['middleware' => ['auth', 'ceklevel:1,2']], function () {
    Route::get('/main', [Main::class, 'home']);
});
