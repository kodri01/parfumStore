<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\CategoriController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UsersController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('tologin');

Route::group(['middleware' => 'auth'], function () {
    //Log Out
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    //profile
    Route::get('profile/{id}', [ProfileController::class, 'index'])->name('profile');
    Route::put('photo/update/{id}', [ProfileController::class, 'update_profile'])->name('update.photo');
    Route::put('profile/update/{id}', [ProfileController::class, 'update'])->name('update.profile');

    //dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => 'role:administrator'], function () {
        //users
        Route::get('users', [UsersController::class, 'index'])->name('users');
        Route::post('/users_add', [UsersController::class, 'store'])->name('add.users');
        Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('edit.user');
        Route::put('/users', [UsersController::class, 'update'])->name('update.users');
        Route::delete('/users/delete/{id}', [UsersController::class, 'destroy'])->name('delete.users');


        //laporan
        Route::get('laporan/neraca', [LaporanController::class, 'index'])->name('lap.neraca');
        Route::get('laporan/rugi', [LaporanController::class, 'laba_rugi'])->name('lap.laba');
        Route::get('laporan/modal', [LaporanController::class, 'per_modal'])->name('lap.modal');

        //setting
        Route::get('setting', [SettingController::class, 'index'])->name('setting');
        Route::get('/setting/{id}/edit', [SettingController::class, 'edit'])->name('edit.setting');
        Route::put('/setting', [SettingController::class, 'store'])->name('update.setting');

        //Stok Produk
        Route::get('produks', [ProductController::class, 'index'])->name('product');
        Route::post('produks', [ProductController::class, 'store'])->name('add.product');
        Route::get('/produks/{id}/edit', [ProductController::class, 'edit'])->name('edit.product');
        Route::put('/produks', [ProductController::class, 'update'])->name('update.product');
        Route::delete('/produks/delete/{id}', [ProductController::class, 'destroy'])->name('delete.product');

        //Produk Masuk
        Route::get('masuk', [ProductController::class, 'masuk'])->name('product.masuk');
        Route::post('/masuk_add', [ProductController::class, 'masuk_store'])->name('add.masuk');
        Route::get('/masuk/{id}/edit', [ProductController::class, 'edit_masuk'])->name('edit.masuk');
        Route::put('/masuk', [ProductController::class, 'update_masuk'])->name('update.masuk');
        Route::delete('/masuk/delete/{id}', [ProductController::class, 'destroy_masuk'])->name('delete.masuk');

        //Produk Keluar
        Route::get('keluar', [ProductController::class, 'keluar'])->name('product.keluar');
        Route::post('/keluar_add', [ProductController::class, 'keluar_store'])->name('add.keluar');
        Route::get('/keluar/{id}/edit', [ProductController::class, 'edit_keluar'])->name('edit.keluar');
        Route::put('/keluar', [ProductController::class, 'update_keluar'])->name('update.keluar');
        Route::delete('/keluar/delete/{id}', [ProductController::class, 'destroy_keluar'])->name('delete.keluar');

        //Order Produk
        Route::get('order', [OrderController::class, 'index'])->name('product.order');
        Route::post('/order/edit/{no}', [OrderController::class, 'update'])->name('order.update');
        Route::post('/order', [OrderController::class, 'store'])->name('order.store');
        Route::get('/order/details/{no}', [OrderController::class, 'show'])->name('order.details');
        Route::delete('/order/delete/{id}', [OrderController::class, 'destroy'])->name('order.delete');

        //kategori
        Route::get('categori', [CategoriController::class, 'index'])->name('categori');
        Route::post('categori', [CategoriController::class, 'store'])->name('add.categori');
        Route::get('/categori/{id}/edit', [CategoriController::class, 'edit'])->name('edit.categori');
        Route::put('/categori', [CategoriController::class, 'update'])->name('update.categori');
        Route::delete('/categori/delete/{id}', [CategoriController::class, 'destroy'])->name('delete.categori');

        //credit
        Route::get('credit', [CreditController::class, 'index'])->name('credit');
        Route::post('credit', [CreditController::class, 'store'])->name('add.credit');
        Route::get('/credit/{id}/edit', [CreditController::class, 'edit'])->name('edit.credit');
        Route::put('/credit', [CreditController::class, 'update'])->name('update.credit');
        Route::delete('/credit/delete/{id}', [CreditController::class, 'destroy'])->name('delete.credit');
    });
});