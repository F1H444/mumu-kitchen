<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\DashboardKategoriController;
use App\Http\Controllers\DashboardProdukController;
use App\Http\Controllers\DashboardProvinsiController;
use App\Http\Controllers\DashboardKotaController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\DashboardUkuranController;
use App\Http\Controllers\UkuranProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\PesananAdminController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanUserController;




use App\Http\Controllers\PaymentCallbackController;






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

// Auth
Route::get('/login', [LoginController::class, 'index'])->middleware(['guest'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware(['guest']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware(['auth']);

Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/register', [RegisterController::class, 'index'])->middleware(['guest']);
Route::post('/register', [RegisterController::class, 'register'])->middleware(['guest']);

// Front
Route::get('/', [FrontController::class, 'index']);
Route::get('kategori/{id}', [KategoriProdukController::class, 'kategoriproduk']);
Route::get('kategorikatalog/{id}', [KategoriProdukController::class, 'katalogproduk']);

Route::get('produk', [ProdukController::class, 'indexproduk']);
Route::get('produk/{id}', [ProdukController::class, 'produk']);
Route::get('produkdetail/{id}', [ProdukController::class, 'indexprodukdetail']);

Route::get('/keranjang', [KeranjangController::class, 'index'])->middleware('auth');
Route::post('/keranjang', [KeranjangController::class, 'store'])->middleware('auth');
Route::match(['POST', 'PUT'], '/keranjang/{id}', [KeranjangController::class, 'update'])->middleware('auth');
Route::delete('/keranjang/{id}', [KeranjangController::class, 'delete'])->middleware('auth');

Route::get('/alamat', [AlamatController::class, 'index'])->middleware('auth');
Route::delete('/alamat/{id}', [AlamatController::class, 'delete'])->middleware('auth');
Route::get('/alamattambah', [AlamatController::class, 'indextambahalamat'])->middleware('auth');
Route::post('/alamattambah', [AlamatController::class, 'store'])->middleware('auth');
Route::get('/pesanan', [PesananController::class, 'index'])->middleware('auth');
Route::post('/pesanan/pembayaran', [PesananController::class, 'pembayaran'])->middleware('auth');

Route::get('provinsi/{id}/kota', [DashboardProvinsiController::class, 'kota']);
Route::post('/checkout/get-ongkir', [PesananController::class, 'getOngkir'])->middleware('auth');
Route::post('/checkout/pembayaran/charge', [PesananController::class, 'charge'])->middleware('auth');
Route::post('/checkout/pembayaran/success', [PesananController::class, 'updatePaymentSuccess'])->middleware('auth');

Route::get('/riwayat', [RiwayatController::class, 'index'])->middleware('auth');
Route::get('/riwayat/pembayaran/{id}/detail', [RiwayatController::class, 'detail'])->middleware('auth');

Route::post('/riwayat/pembayaran/{id}/kembalistatuscancel', [RiwayatController::class, 'BatalPesanan'])->middleware('auth');
Route::post('/riwayat/pembayaran/{id}/updateselesai', [RiwayatController::class, 'SelesaiPesanan'])->middleware('auth');


Route::get('/contact', [ContactController::class, 'index']);

Route::get('/profile', [ProfileController::class, 'index']);
Route::post('/profileuser', [ProfileController::class, 'profile']);

Route::get('/riwayat/laporanpdf/{id}', [LaporanUserController::class, 'laporanpdf'])->middleware('auth');




Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);

// API for getting product sizes
Route::get('/api/produk/{id}/ukuran', [ProdukController::class, 'getSizes']);


// Dashboard
Route::prefix('dashboard')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('kategori', DashboardKategoriController::class);
    Route::post('kategori/{id}/edit', [DashboardKategoriController::class, 'update']);
    Route::resource('produk', DashboardProdukController::class);
    Route::post('produk/{id}/edit', [DashboardProdukController::class, 'update']);
    Route::resource('produk/{produk_id}/ukurans', UkuranProdukController::class);
    Route::resource('provinsi', DashboardProvinsiController::class);
    Route::post('provinsi/{id}/edit', [DashboardProvinsiController::class, 'update']);
    Route::resource('kota', DashboardKotaController::class);
    Route::post('kota/{id}/edit', [DashboardKotaController::class, 'update']);
    Route::resource('ukuran', DashboardUkuranController::class);
    Route::post('ukuran/{id}/edit', [DashboardUkuranController::class, 'update']);

    Route::get('/pesananbaru', [PesananAdminController::class, 'pesananbaru'])->middleware('admin');
    Route::post('/pesananbaru', [PesananAdminController::class, 'pesananbaru'])->middleware('admin');
    Route::get('/pesananbaru/{id}/detaile', [PesananAdminController::class, 'showpesanbaru'])->middleware('admin');
    Route::post('/pesananbaru/{id}/updatebaru', [PesananAdminController::class, 'updateStatusbaru'])->middleware('admin');

    Route::get('/pesanandiproses', [PesananAdminController::class, 'pesanandiproses'])->middleware('admin');
    Route::post('/pesanandiproses', [PesananAdminController::class, 'pesanandiproses'])->middleware('admin');
    Route::get('/pesanandiproses/{id}/detaile', [PesananAdminController::class, 'showpesanproses'])->middleware('admin');
    Route::post('/pesanandiproses/{id}/updateproses', [PesananAdminController::class, 'updateStatusproses'])->middleware('admin');


    Route::get('/pesanandalampengiriman', [PesananAdminController::class, 'pesanandalampengiriman'])->middleware('admin');
    Route::post('/pesanandalampengiriman', [PesananAdminController::class, 'pesanandalampengiriman'])->middleware('admin');
    Route::get('/pesanandalampengiriman/{id}/detaile', [PesananAdminController::class, 'showpesanpengiriman'])->middleware('admin');
    Route::post('/pesanandalampengiriman/{id}/updatedikirim', [PesananAdminController::class, 'updateStatusdikirim'])->middleware('admin');
    Route::post('/pesanandalampengiriman/{id}/kembalidiproses', [PesananAdminController::class, 'kembaliproses'])->middleware('admin');


    Route::get('/pesanandibatalkan', [PesananAdminController::class, 'pesanandibatalkan'])->middleware('admin');
    Route::post('/pesanandibatalkan', [PesananAdminController::class, 'pesanandibatalkan'])->middleware('admin');
    Route::get('/pesanandibatalkan/{id}/detaile', [PesananAdminController::class, 'showpesanbatal'])->middleware('admin');
    Route::post('/pesanandibatalkan/{id}/update', [PesananAdminController::class, 'updateStatusbatal'])->middleware('admin');

    Route::get('/pesananselesai', [PesananAdminController::class, 'pesananselesai'])->middleware('admin');
    Route::post('/pesananselesai', [PesananAdminController::class, 'pesananselesai'])->middleware('admin');
    Route::get('/pesananselesai/{id}/detaile', [PesananAdminController::class, 'showpesanselesai'])->middleware('admin');
    Route::post('/pesananselesai/{id}/update', [PesananAdminController::class, 'updateStatusselesai'])->middleware('admin');

    Route::get('/laporan', [LaporanController::class, 'index'])->middleware('admin');
    Route::post('/laporan/cetak_pdf', [LaporanController::class, 'cetak_pdf'])->middleware('admin');

    // Route::get('/invoice', [InvoiceController::class, ]);
    Route::get('/invoice/cetak_pdf/{id}', [InvoiceController::class, 'cetak_pdf']);
});

// Route untuk testing email (HAPUS NANTI DI PRODUCTION)
Route::get('/test-email', function () {
    try {
        Illuminate\Support\Facades\Mail::raw('Halo! Ini adalah email testing dari Mumu Kitchen.', function ($message) {
            $message->to('mumuuu112233@gmail.com') // Ganti dengan email tujuan testing
                ->subject('Test Email Config');
        });
        return 'Email berhasil dikirim! Silakan cek inbox.';
    } catch (\Exception $e) {
        return 'Gagal mengirim email. Error: ' . $e->getMessage();
    }
});
