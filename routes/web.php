<?php

use App\Http\Controllers\AdminBotController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\SubKategoriController;
use App\Http\Controllers\SubSubKategoriController;
use Illuminate\Support\Facades\Route;
use App\Models\Admin;

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

Route::get('/docs', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('v_home', [
        'title' => "Home",
    ]);
});

Route::get('/about', function () {
    return view('v_about', [
        'title' => "About"
    ]);
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::prefix('admin')->group(function () {
    Route::get('dashboard', [AdminBotController::class, 'dashboard']);
    Route::get('user', [AdminBotController::class, 'user']);
    Route::get('kategori', [AdminBotController::class, 'kategori']);
    Route::get('sub-kategori', [AdminBotController::class, 'subKategori']);
    Route::get('sub-sub-kategori', [AdminBotController::class, 'subSubKategori']);
    Route::get('pertanyaan', [AdminBotController::class, 'pertanyaan']);

    Route::get('tambah-kategori', [KategoriController::class, 'index']);
    Route::post('tambah-kategori', [KategoriController::class, 'store']);

    Route::get('tambah-sub-kategori', [SubKategoriController::class, 'index']);
    Route::post('tambah-sub-kategori', [SubKategoriController::class, 'store']);

    Route::get('tambah-sub-sub-kategori', [SubSubKategoriController::class, 'index']);
    Route::post('tambah-sub-sub-kategori', [SubSubKategoriController::class, 'store']);

    Route::get('tambah-pertanyaan', [PertanyaanController::class, 'index']);
    Route::post('tambah-pertanyaan', [PertanyaanController::class, 'store']);
});
