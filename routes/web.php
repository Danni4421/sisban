<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Guest\DashboardController as GuestDashboardController;
use App\Http\Controllers\Guest\PengajuanController as GuestPengajuanController;
use App\Http\Controllers\Guest\Bansos\AplicantController as GuestAplicantController;
use App\Http\Controllers\Guest\Bansos\RecipientController as GuestRecipientController;
use App\Http\Controllers\RT\DashboardController as RTDashboardController;
use App\Http\Controllers\RT\PengajuanController as RTPengajuanController;
use App\Http\Controllers\RT\BansosController as RTBansosController;
use App\Http\Controllers\RT\Bansos\TypeController as RTBansosTypesController;
use App\Http\Controllers\RT\Bansos\RecipientController as RTBansosRecipientsController;
use App\Http\Controllers\RW\DashboardController as RWDashboardController;
use App\Http\Controllers\RW\MemberController as RWMemberController;
use App\Http\Controllers\RW\PengajuanController as RWPengajuanController;
use App\Http\Controllers\RW\Bansos\RecipientController as RWBansosRecipientsController;
use App\Http\Controllers\RW\AplicantController as RWAplicantController;
use App\Http\Controllers\Admin\RWController as AdminRWController;
use App\Http\Controllers\Admin\RTController as AdminRTController;
use App\Http\Controllers\Admin\AplicantController as AdminAplicantController;
use App\Http\Controllers\Admin\Bansos\TypeController as AdminBansosTypesController;
use App\Http\Controllers\Admin\Bansos\RecipientController as AdminBansosRecipientsController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/login', [AuthenticationController::class, 'login'])
  ->name('login');
Route::post('/login', [AuthenticationController::class, 'authenticate']);
Route::post('/logout', [AuthenticationController::class, 'logout']);

Route::middleware('guest')->group(function () {
  Route::get('/', [GuestDashboardController::class, 'index']);
  Route::get('/pengajuan', [GuestPengajuanController::class, 'main']);
  Route::prefix('informasi')->group(function () {
    Route::get('/pemohon', [GuestAplicantController::class, 'index'])->name('guest.aplicant');
    Route::get('/penerima', [GuestRecipientController::class, 'index'])->name('guest.recipient');
  });
});

/*****************************************
 * RT Routes
 *****************************************/
Route::prefix('rt')->middleware(['auth', 'auth.session', 'level.validate'])->group(function () {
  Route::get('/', [RTDashboardController::class, 'index']);
  Route::prefix('/pengajuan')->group(function () {
    Route::get('/masuk', [RTPengajuanController::class, 'incoming']);
    Route::get('/disetujui', [RTPengajuanController::class, 'approved']);
    Route::post('/{no_kk}', [RTPengajuanController::class, 'show']);
    Route::put('/approve/{no_kk}', [RTPengajuanController::class, 'approvePengajuan'])->name('pengajuan.approve');
    Route::put('/decline/{no_kk}', [RTPengajuanController::class, 'declinePengajuan'])->name('pengajuan.decline');
  });
  Route::prefix('/bansos')->group(function() {
    Route::resource('/jenis', RTBansosTypesController::class);
    Route::resource('/penerima', RTBansosRecipientsController::class);
    Route::get('/{id_bansos}/penerima/{nik}/edit', [RTBansosRecipientsController::class, 'edit_recipient']);
    Route::put('/{id_bansos}/penerima/{nik}', [RTBansosRecipientsController::class, 'update_recipient']);
    Route::delete('/{id_bansos}/penerima/{nik}', [RTBansosRecipientsController::class, 'delete_recipient']);
  });
});
/*****************************************
 * End RT Routes
 *****************************************/

/*****************************************
 * RW Routes
 *****************************************/
Route::prefix('rw')->middleware(['auth', 'auth.session', 'level.validate'])->group(function () {
  Route::get('/', [RWDashboardController::class, 'index']);
  Route::resource('/data-rt', RWMemberController::class);
  Route::prefix('/pengajuan')->group(function () {
    Route::get('/masuk', [RWPengajuanController::class, 'incoming']);
    Route::get('/disetujui', [RWPengajuanController::class, 'approved']);
  });
  Route::prefix('/bansos')->group(function () {
    Route::resource('/penerima', RWBansosRecipientsController::class);
    Route::get('/{id_bansos}/penerima/{nik}/edit', [RWBansosRecipientsController::class, 'edit_recipient']);
    Route::put('/{id_bansos}/penerima/{nik}', [RWBansosRecipientsController::class, 'update_recipient']);
    Route::delete('/{id_bansos}/penerima/{nik}', [RWBansosRecipientsController::class, 'delete_recipient']);
  });
});
/*****************************************
 * End RW Routes
 *****************************************/

/*****************************************
 * Admin Routes
 *****************************************/
Route::prefix('admin')->middleware(['auth', 'auth.session', 'level.validate'])->group(function () {
  Route::prefix('/data-rw')->group(function () {
    Route::get('/', [AdminRWController::class, 'index']);
    Route::put('/{id}', [AdminRWController::class, 'update']);
  });
  Route::resource('/data-rt', AdminRTController::class);
  Route::prefix('/pemohon')->group(function () {
    Route::get('/', [AdminAplicantController::class, 'index']);
    Route::post('/{no_kk}', [AdminAplicantController::class, 'show']);
    Route::put('/{no_kk}/approve', [AdminAplicantController::class, 'approve']);
    Route::put('/{no_kk}/decline', [AdminAplicantController::class, 'decline']);
  });
  Route::prefix('/bansos')->group(function () {
    Route::resource('/jenis', AdminBansosTypesController::class);
    Route::resource('/penerima', AdminBansosRecipientsController::class);
    Route::get('/{id_bansos}/penerima/{nik}/edit', [AdminBansosRecipientsController::class, 'edit_recipient']);
    Route::put('/{id_bansos}/penerima/{nik}', [AdminBansosRecipientsController::class, 'update_recipient']);
    Route::delete('/{id_bansos}/penerima/{nik}', [AdminBansosRecipientsController::class, 'delete_recipient']);
  });
});
/*****************************************
 * End Admin Routes
 *****************************************/

Route::get('/notifikasi', [NotificationController::class, 'index']);
Route::get('/settings', [SettingController::class, 'index']);
Route::get('/faq', [FaqController::class, 'index']);
