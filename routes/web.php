<?php

use App\Http\Controllers\AdminBotController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
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

Route::get('/', [DashboardController::class, 'pageIndex']);

Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('isAdminLogin');
Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login');


Route::prefix('admin')->group(function () {
    // Route::redirect('{user:email}','/admin/dashboard/');

    Route::get('logout', [LoginController::class, 'logout'])->name('auth.logout');

    Route::get('{user:id}/profile', [AdminBotController::class, 'profilePage'])->name('bot.email');
    Route::put('{user:id}/profile', [ProfileController::class, 'updateProfile']);


    Route::middleware('auth.login')->group(function () {

        Route::get('dashboard', [AdminBotController::class, 'dashboard'])->name('bot.dashboard');
        Route::get('kategori', [AdminBotController::class, 'kategori'])->name('bot.kategori');

        Route::get('users', [AdminBotController::class, 'user'])->name('bot.user');
        Route::get('grup', [AdminBotController::class, 'grup'])->name('bot.grup');
        Route::get('sub-kategori', [AdminBotController::class, 'subKategori'])->name('bot.sub-kategori');
        Route::get('sub-sub-kategori', [AdminBotController::class, 'subSubKategori'])->name('bot.sub-sub-kategori');
        Route::get('pertanyaan', [AdminBotController::class, 'pertanyaan'])->name('bot.pertanyaan');

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

        Route::middleware(['auth', 'superadmin'])->group(function () {
            Route::get('admins', [AdminBotController::class, 'admins'])->name('bot.admins');
            Route::post('admins', [AdminController::class, 'createAdmin']);
            Route::put('admins/{user:id}', [AdminController::class, 'updateAdmin']);
            Route::get('hapus-admin/{user:id}', [AdminController::class, 'deleteAdmin']);
        });
    });
});


// Bot Handler Action

Route::post('bot', [TelegramBotController::class, 'botAction']);
Route::get('bot', [TelegramBotController::class, 'botInfo']);
// Route::redirect('/webhook', '/');


Route::post('/webhook', [TelegramBotController::class, 'handleBot']);
// Route::post('{keypassword}/reset-password', ResetPasswordController::class, 'reset');

// Route::middleware(['first.time.login'])->group(function () {
//     Route::get('/admin/dashboard', [AdminBotController::class, 'dashboard'])->name('bot.dashboard');
//     Route::get('/admin/users', [AdminBotController::class, 'user'])->name('bot.user');
//     Route::get('/admin/grup', [AdminBotController::class, 'grup'])->name('bot.grup');


// });
