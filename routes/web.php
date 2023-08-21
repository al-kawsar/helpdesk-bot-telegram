<?php

use App\Http\Controllers\AdminBotController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\SubKategoriController;
use App\Http\Controllers\SubSubKategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramBotController;
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
        'teks' => ""
    ]);
});

Route::get('/about', function () {
    return view('v_about', [
        'title' => "About",
        'teks' => ""
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

    Route::post('kategori', [KategoriController::class, 'store']);
    Route::post('edit-kategori/{kategori:kategori}', [KategoriController::class, 'update']);
    Route::get('hapus-kategori/{kategori:id}', [KategoriController::class, 'delete'])->name('delete');

    Route::post('sub-kategori', [SubKategoriController::class, 'store']);
    Route::post('edit-sub-kategori/{subkategori:sub_kategori}', [SubKategoriController::class, 'update']);
    Route::get('hapus-sub-kategori/{subkategori:id}', [SubKategoriController::class, 'delete']);

    Route::post('sub-sub-kategori', [SubSubKategoriController::class, 'store']);
    Route::post('edit-sub-sub-kategori/{subsubkategori:sub_sub_kategori}', [SubSubKategoriController::class, 'update']);
    Route::get('hapus-sub-sub-kategori/{subsubkategori:id}', [SubSubKategoriController::class, 'delete']);

    Route::post('pertanyaan', [PertanyaanController::class, 'store']);
    Route::post('edit-pertanyaan/{pertanyaan:pertanyaan}', [PertanyaanController::class, 'update']);
    Route::get('hapus-pertanyaan/{pertanyaan:id}', [PertanyaanController::class, 'delete']);

    Route::get('/info-webhook', [TelegramBotController::class, 'infoWebhook']);
    Route::get('/bot', [TelegramBotController::class, 'getUpdates']);
    Route::get('/info-bot', [TelegramBotController::class, 'getInfoBot']);
    Route::get('/setWebhook', [TelegramBotController::class, 'setWebhook']);
    Route::get('/deleteWebhook', [TelegramBotController::class, 'deleteWebhook']);
    Route::post('/webhook', [TelegramBotController::class, 'webhook']);
});

// Route::get('/clear-success-message', function () {
//     session()->forget('success_message');
// });