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
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SubKategoriController;
use App\Http\Controllers\SubSubKategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\WebhookConfigurationController;

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

Route::post('/', [DashboardController::class, 'pertanyaan'])->name('post.question');
Route::post('/check-token', [DashboardController::class, 'checkToken'])->name('post.check-token');

Route::prefix('admin')->group(function () {
    // Route::redirect('{user:email}','/admin/dashboard/');

    Route::get('logout', [LoginController::class, 'logout'])->name('auth.logout');

    Route::get('{user:email}/profile', [AdminBotController::class, 'profilePage'])->name('bot.email');
    Route::put('{user:id}/profile', [ProfileController::class, 'updateProfile']);


    Route::middleware('auth.login')->group(function () {

        Route::post('bot', [TelegramBotController::class, 'botAction'])->name('bot.grup.sendmessage');
        Route::redirect('bot', '/admin/grup');

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
        Route::delete('kategori', [KategoriController::class, 'deleteAll'])->name('bot.kategori.selected');

        Route::post('sub-kategori', [SubKategoriController::class, 'store']);
        Route::post('edit-sub-kategori/{subkategori:sub_kategori}', [SubKategoriController::class, 'update']);
        Route::get('hapus-sub-kategori/{subkategori:id}', [SubKategoriController::class, 'delete']);

        Route::post('sub-sub-kategori', [SubSubKategoriController::class, 'store']);
        Route::post('edit-sub-sub-kategori/{subsubkategori:sub_sub_kategori}', [SubSubKategoriController::class, 'update']);
        Route::get('hapus-sub-sub-kategori/{subsubkategori:id}', [SubSubKategoriController::class, 'delete']);

        Route::post('pertanyaan', [PertanyaanController::class, 'store']);
        Route::post('edit-pertanyaan/{pertanyaan:id}', [PertanyaanController::class, 'update']);
        Route::get('hapus-pertanyaan/{pertanyaan:id}', [PertanyaanController::class, 'delete']);

        Route::get('request-pertanyaan', [RequestPertanyaan::class, 'index'])->name('bot.request');
        Route::post('verifikasi-pertanyaan',[RequestPertanyaan::class,'verifikasiPertanyaan'])->name('bot.verifikasi.diterima');
        Route::post('tolak-pertanyaan',[RequestPertanyaan::class,'tolakPertanyaan'])->name('bot.verifikasi.ditolak');

        Route::middleware(['auth', 'superadmin'])->group(function () {

            Route::get('bot-settings', [AdminBotController::class, 'botSettings'])->name('bot.botsettings');
            Route::post('bot-settings', [BotController::class, 'addBot'])->name('bot.botsettings.add');
            Route::put('bot-settings/{bot:id}', [BotController::class, 'updateBot'])->name('bot.botsettings.update');
            Route::delete('bot-settings', [BotController::class, 'deleteAll'])->name('bot.botsettings.selected');
            Route::get('hapus-bot/{bot:id}', [BotController::class, 'destroyBot']);

            Route::post('webhook-settings/{bot:id}', [BotController::class, 'setWebhook'])->name('bot.webhooksettings');
            Route::delete('webhook-settings/{bot:id}', [BotController::class, 'deleteWebhook'])->name('bot.webhooksettings.delete');



            Route::get('admins', [AdminBotController::class, 'admins'])->name('bot.admins');
            Route::delete('admins', [AdminController::class, 'deleteAll'])->name('bot.admins.selected');
            Route::post('admins', [AdminController::class, 'createAdmin']);
            Route::put('admins/{user:id}', [AdminController::class, 'updateAdmin']);
            Route::get('hapus-admin/{user:id}', [AdminController::class, 'deleteAdmin']);
        });
    });
});


// Bot Handler Action


// Route::post($_ENV['ACCESS_WEBHOOK'] . '/webhook', [TelegramBotController::class, 'handleBot']);
Route::post('/webhook', [TelegramBotController::class, 'handleBot']);
