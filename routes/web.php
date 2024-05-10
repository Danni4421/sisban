<?php

use App\Http\Controllers\Guest\DashboardController as GuestDashboardController;
use App\Http\Controllers\Guest\PengajuanController as GuestPengajuanController;
use App\Http\Controllers\Guest\Bansos\AplicantController as GuestAplicantController;
use App\Http\Controllers\Guest\Bansos\RecipientController as GuestRecipientController;
use App\Http\Controllers\RT\DashboardController as RTDashboardController;
use App\Http\Controllers\RT\PengajuanController as RTPengajuanController;
use App\Http\Controllers\RT\Bansos\TypeController as RTBansosTypesController;
use App\Http\Controllers\RT\Bansos\RecipientController as RTBansosRecipientsController;
use App\Http\Controllers\RW\DashboardController as RWDashboardController;
use App\Http\Controllers\RW\MemberController as RWMemberController;
use App\Http\Controllers\RW\PengajuanController as RWPengajuanController;
use App\Http\Controllers\RW\Bansos\RecipientController as RWBansosRecipientsController;
use App\Http\Controllers\Admin\RWController as AdminRWController;
use App\Http\Controllers\Admin\RTController as AdminRTController;
use App\Http\Controllers\Admin\AplicantController as AdminAplicantController;
use App\Http\Controllers\Admin\Bansos\TypeController as AdminBansosTypesController;
use App\Http\Controllers\Admin\Bansos\RecipientController as AdminBansosRecipientsController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FaqController;
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


Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('guest')->group(function () {
  Route::get('/', [GuestDashboardController::class, 'index'])->name('guest.dashboard');
  Route::get('/pengajuan', [GuestPengajuanController::class, 'main'])->name('guest.pengajuan');
  Route::prefix('informasi')->group(function () {
    Route::get('/pemohon', [GuestAplicantController::class, 'index'])->name('guest.aplicant.information');
    Route::get('/penerima', [GuestRecipientController::class, 'index'])->name('guest.recipient.information');
  });
});

/*****************************************
 * RT Routes
 *****************************************/
Route::prefix('rt')->middleware(['auth', 'auth.session', 'level.validate'])->group(function () {
  Route::get('/', [RTDashboardController::class, 'index'])->name('rt.dashboard');
  Route::prefix('/pengajuan')->group(function () {
    Route::get('/masuk', [RTPengajuanController::class, 'incoming'])->name('rt.pengajuan.incoming');
    Route::get('/disetujui', [RTPengajuanController::class, 'approved'])->name('rt.pengajuan.approved');
    Route::post('/{no_kk}', [RTPengajuanController::class, 'show'])->name('rt.pengajuan.show');
    Route::put('/approve/{no_kk}', [RTPengajuanController::class, 'approvePengajuan'])->name('rt.pengajuan.approve');
    Route::put('/decline/{no_kk}', [RTPengajuanController::class, 'declinePengajuan'])->name('rt.pengajuan.decline');
  });
  Route::prefix('/bansos')->group(function() {
    Route::resource('/jenis', RTBansosTypesController::class);
    Route::resource('/penerima', RTBansosRecipientsController::class);
    Route::get('/{id_bansos}/penerima/{nik}/edit', [RTBansosRecipientsController::class, 'edit_recipient'])->name('rt.page.edit.bansos.recipient');
    Route::put('/{id_bansos}/penerima/{nik}', [RTBansosRecipientsController::class, 'update_recipient'])->name('rt.update.bansos.recipient');
    Route::delete('/{id_bansos}/penerima/{nik}', [RTBansosRecipientsController::class, 'delete_recipient'])->name('rt.delete.bansos.recipient');
  });
});
/*****************************************
 * End RT Routes
 *****************************************/

/*****************************************
 * RW Routes
 *****************************************/
Route::prefix('rw')->middleware(['auth', 'auth.session', 'level.validate'])->group(function () {
  Route::get('/', [RWDashboardController::class, 'index'])->name('rw.dashboard');
  Route::resource('/data-rt', RWMemberController::class);
  Route::get('/pemohon', [RWPengajuanController::class, 'approved'])->name('rw.aplicant.approved');
  Route::post('/pengajuan/{no_kk}', [RWPengajuanController::class, 'show'])->name('rw.aplicant.show');
  Route::get('/pengajuan/{no_kk}/cetak', [RWPengajuanController::class, 'print_pdf'])->name('rw.pengajuan.cetak');  
  Route::prefix('/bansos')->group(function () {
    Route::resource('/penerima', RWBansosRecipientsController::class);
    Route::get('/{id_bansos}/penerima/{nik}/edit', [RWBansosRecipientsController::class, 'edit'])->name('rw.page.edit.bansos.recipient');
    Route::put('/{id_bansos}/penerima/{nik}', [RWBansosRecipientsController::class, 'update'])->name('rw.update.bansos.recipient');
    Route::delete('/{id_bansos}/penerima/{nik}', [RWBansosRecipientsController::class, 'destroy'])->name('rw.delete.bansos.recipient');
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
    Route::get('/', [AdminRWController::class, 'index'])->name('admin.data-rw');
    Route::put('/{id}', [AdminRWController::class, 'update'])->name('admin.update.data-rw');
  });
  Route::resource('/data-rt', AdminRTController::class);
  Route::prefix('/pemohon')->group(function () {
    Route::get('/', [AdminAplicantController::class, 'index'])->name('admin.aplicant.index');
    Route::post('/{no_kk}', [AdminAplicantController::class, 'show'])->name('admin.aplicant.show');
    Route::put('/{no_kk}/approve', [AdminAplicantController::class, 'approve'])->name('admin.aplicant.approve');
    Route::put('/{no_kk}/decline', [AdminAplicantController::class, 'decline'])->name('admin.aplicant.decline');
  });
  Route::prefix('/bansos')->group(function () {
    Route::resource('/jenis', AdminBansosTypesController::class);
    Route::resource('/penerima', AdminBansosRecipientsController::class);
    Route::get('/{id_bansos}/penerima/{nik}/edit', [AdminBansosRecipientsController::class, 'edit_recipient'])->name('admin.page.edit.bansos.recipient');
    Route::put('/{id_bansos}/penerima/{nik}', [AdminBansosRecipientsController::class, 'update_recipient'])->name('admin.update.bansos.recipient');
    Route::delete('/{id_bansos}/penerima/{nik}', [AdminBansosRecipientsController::class, 'delete_recipient'])->name('admin.delete.bansos.recipient');
  });
});
/*****************************************
 * End Admin Routes
 *****************************************/

/*****************************************
 * General Routes
 *****************************************/
Route::middleware(['auth'])->group(function () {
  Route::prefix('/akun')->group(function () {
    Route::get('/informasi', [AccountController::class, 'index'])->name('account.information');
    Route::put('/informasi/{id}', [AccountController::class, 'update'])->name('account.information.update');
  });
  Route::get('/notifikasi', [NotificationController::class, 'index'])->name('general.notifikasi');
  Route::get('/pengaturan', [SettingController::class, 'index'])->name('general.pengaturan');
  Route::get('/faq', [FaqController::class, 'index'])->name('general.faq');
  Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});
/*****************************************
 * End General Routes
 *****************************************/