<?php

use App\Http\Controllers\AdminBotController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestPertanyaan;
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


// Login Handle Fitur
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login')->middleware('isAdminLogin');
    Route::post('/login', 'authenticate')->name('auth.login');
    Route::get('logout', 'logout')->prefix('admin')->name('auth.logout');
});

Route::controller(DashboardController::class)->group(function () {
    // Dashboard Admin Page
    Route::get('/', 'pageIndex');

    Route::post('/', 'pertanyaan')->name('post.question');
    Route::post('/check-token', 'checkToken')->name('post.check-token');
});

Route::prefix('admin')->group(function () {

    Route::put('profile', [ProfileController::class, 'updateProfile']);

    Route::middleware('auth.login')->group(function () {

        Route::controller(TelegramBotController::class)->group(function () {
            Route::post('bot', 'botAction')->name('bot.grup.sendmessage');
            Route::get('/webhook', 'handleBot')->withoutMiddleware('auth.login');
        });
        Route::redirect('bot', '/admin/grup');

        Route::controller(AdminBotController::class)->name('bot.')->group(function () {
            Route::get('dashboard', 'dashboard')->name('dashboard');
            Route::get('kategori', 'kategori')->name('kategori');
            Route::get('users', 'user')->name('user');
            Route::get('profile', 'profilePage')->name('email');
            Route::get('grup', 'grup')->name('grup');
            Route::get('sub-kategori', 'subKategori')->name('sub-kategori');
            Route::get('sub-sub-kategori', 'subSubKategori')->name('sub-sub-kategori');
            Route::get('pertanyaan', 'pertanyaan')->name('pertanyaan');
            Route::get('bot-settings', 'botSettings')->middleware(['superadmin', 'auth'])->name('botsettings');
            Route::get('admins', [AdminBotController::class, 'admins'])->middleware('superadmin')->name('admins');
        });


        Route::post('kategori', [KategoriController::class, 'store']);
        Route::post('edit-kategori/{kategori:kategori}', [KategoriController::class, 'update']);
        Route::get('hapus-kategori/{kategori:id}', [KategoriController::class, 'delete'])->name('delete');
        Route::delete('kategori', [KategoriController::class, 'deleteAll'])->name('bot.kategori.selected');

        Route::controller(SubKategoriController::class)->group(function () {
            Route::post('sub-kategori', 'store');
            Route::post('edit-sub-kategori/{subkategori:sub_kategori}', 'update');
            Route::get('hapus-sub-kategori/{subkategori:id}', 'delete');
        });

        Route::controller(SubSubKategoriController::class)->group(function () {
            Route::post('sub-sub-kategori', 'store');
            Route::post('edit-sub-sub-kategori/{subsubkategori:sub_sub_kategori}', 'update');
            Route::get('hapus-sub-sub-kategori/{subsubkategori:id}', 'delete');
        });

        Route::controller(PertanyaanController::class)->group(function () {
            Route::post('pertanyaan', 'store');
            Route::post('edit-pertanyaan/{pertanyaan:id}', 'update');
            Route::get('hapus-pertanyaan/{pertanyaan:id}', 'delete');
        });

        Route::controller(RequestPertanyaan::class)->group(function () {
            Route::get('request-pertanyaan', 'index')->name('bot.request');
            Route::post('verifikasi-pertanyaan', 'verifikasiPertanyaan')->name('bot.verifikasi.diterima');
            Route::post('tolak-pertanyaan', 'tolakPertanyaan')->name('bot.verifikasi.ditolak');
            Route::delete('hapus-semua-pertanyaan', 'hapusSemua')->name('request.delete-all');
        });

        Route::middleware(['superadmin'])->group(function () {
            Route::controller(BotController::class)->group(function () {
                Route::post('bot-settings', 'addBot')->name('bot.botsettings.add');
                Route::put('bot-settings/{bot:id}', 'updateBot')->name('bot.botsettings.update');
                Route::delete('bot-settings', 'deleteAll')->name('bot.botsettings.selected');
                Route::get('hapus-bot/{bot:id}', 'destroyBot');
                Route::post('webhook-settings/{bot:id}', 'setWebhook')->name('bot.webhooksettings');
                Route::delete('webhook-settings/{bot:id}', 'deleteWebhook')->name('bot.webhooksettings.delete');
            });

            Route::controller(AdminController::class)->group(function () {
                Route::delete('admins', 'deleteAll')->name('bot.admins.selected');
                Route::post('admins', 'createAdmin');
                Route::put('admins/{user:id}', 'updateAdmin');
                Route::get('hapus-admin/{user:id}', 'deleteAdmin');
            });
        });
    });
});
