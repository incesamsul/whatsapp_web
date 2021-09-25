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
use App\Http\Controllers\MyAjax;
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

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [Authentication::class, 'wrapperLogin']);
    Route::get('/login', [Authentication::class, 'qrLogin'])->name('login');
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

Route::group(['middleware' => ['auth', 'ceklevel:1,2']], function () {
    Route::post('/ajax/login-qrcode', [MyAjax::class, 'loginQrcode']);
    Route::get('/scan-qrcode', [Authentication::class, 'scanQrcode'])->name('login');
    Route::get('/admin/pelanggan', [Pelanggan::class, 'home']);
    Route::get('/admin/suplier', [Suplier::class, 'home']);
    Route::get('/admin/kategori-produk', [KategoriProduk::class, 'home']);
    Route::get('/admin/satuan-produk', [SatuanProduk::class, 'home']);
    Route::get('/admin/produk', [Produk::class, 'home']);
    Route::get('/admin/stok-masuk', [StokMasuk::class, 'home']);
    Route::get('/admin/stok-keluar', [StokKeluar::class, 'home']);
    Route::get('/admin/transaksi', [Transaksi::class, 'home']);
    Route::get('/admin/laporan-penjualan', [LaporanPenjualan::class, 'home']);
    Route::get('/admin/laporan-stok-masuk', [LaporanStokMasuk::class, 'home']);
    Route::get('/admin/laporan-stok-keluar', [LaporanStokKeluar::class, 'home']);
    Route::get('/kasir', [Kasir::class, 'home']);
    Route::get('/cekabsen', [Kasir::class, 'cekabsen']);
    Route::post('/store-checkin', [Kasir::class, 'checkin']);
    Route::post('/update-posisi-pertama', [Kasir::class, 'updatePosisiPertama']);
    Route::post('/update-posisi-kedua', [Kasir::class, 'updatePosisiKedua']);
    Route::post('store-checkout', [Kasir::class, 'checkout']);


    // Segment Pelanggan
    Route::group(['prefix' => 'admin'], function () {
        Route::post('/tambah-pelanggan', [Pelanggan::class, 'tambah']);
        Route::post('/ubah-pelanggan', [Pelanggan::class, 'ubah']);
        Route::post('/hapus-pelanggan', [Pelanggan::class, 'hapus']);
    });

    // Segment Suplier
    Route::group(['prefix' => 'admin'], function () {
        Route::post('/tambah-suplier', [Suplier::class, 'tambah']);
        Route::post('/ubah-suplier', [Suplier::class, 'ubah']);
        Route::post('/hapus-suplier', [Suplier::class, 'hapus']);
    });

    // Segment satuan
    Route::group(['prefix' => 'admin'], function () {
        Route::post('/tambah-satuan', [SatuanProduk::class, 'tambah']);
        Route::post('/ubah-satuan', [SatuanProduk::class, 'ubah']);
        Route::post('/hapus-satuan', [SatuanProduk::class, 'hapus']);
    });


    // Segment satuan
    Route::group(['prefix' => 'admin'], function () {
        Route::post('/tambah-kategori', [KategoriProduk::class, 'tambah']);
        Route::post('/ubah-kategori', [KategoriProduk::class, 'ubah']);
        Route::post('/hapus-kategori', [KategoriProduk::class, 'hapus']);
    });


    // Segment produk
    Route::group(['prefix' => 'admin'], function () {
        Route::post('/tambah-produk', [Produk::class, 'tambah']);
        Route::post('/ubah-produk', [Produk::class, 'ubah']);
        Route::post('/hapus-produk', [Produk::class, 'hapus']);
    });

    // Segment stok masuk
    Route::group(['prefix' => 'admin'], function () {
        Route::post('/tambah-stok_masuk', [StokMasuk::class, 'tambah']);
        Route::post('/ubah-stok_masuk', [StokMasuk::class, 'ubah']);
        Route::post('/hapus-stok_masuk', [StokMasuk::class, 'hapus']);
    });

    // Segment stok keluar
    Route::group(['prefix' => 'admin'], function () {
        Route::post('/tambah-stok_keluar', [StokKeluar::class, 'tambah']);
        Route::post('/ubah-stok_keluar', [StokKeluar::class, 'ubah']);
        Route::post('/hapus-stok_keluar', [StokKeluar::class, 'hapus']);
    });

    // Segment transaksi
    Route::group(['prefix' => 'admin'], function () {
        Route::post('/tambah-transaksi', [Transaksi::class, 'tambah']);
        Route::post('/ubah-transaksi', [Transaksi::class, 'ubah']);
        Route::post('/hapus-transaksi', [Transaksi::class, 'hapus']);
    });
});
