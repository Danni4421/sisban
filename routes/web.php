<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\RT\DashboardController as RTDashboardController;
use App\Http\Controllers\RT\PengajuanController as RTPengajuanController;
use App\Http\Controllers\RT\BansosController as RTBansosController;
use App\Http\Controllers\RW\DashboardController as RWDashboardController;
use App\Http\Controllers\RW\MemberController as RWMemberController;
use App\Http\Controllers\RW\PengajuanController as RWPengajuanController;
use App\Http\Controllers\RW\BansosController as RWBansosController;
use App\Http\Controllers\Admin\RWController as AdminRWController;
use App\Http\Controllers\Admin\RTController as AdminRTController;
use App\Http\Controllers\Admin\AplicantController as AdminAplicantController;
use App\Http\Controllers\Admin\BansosController as AdminBansosController;
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
  ->name('login')
  ->middleware('guest');
Route::post('/login', [AuthenticationController::class, 'authenticate']);
Route::post('/logout', [AuthenticationController::class, 'logout']);

Route::prefix('rt')->group(function() {
  Route::get('/', [RTDashboardController::class, 'index']);
  Route::prefix('/pengajuan')->group(function() {
    Route::get('/masuk', [RTPengajuanController::class, 'incoming']);
    Route::get('/disetujui', [RTPengajuanController::class, 'approved']);
  });
  Route::prefix('/bansos')->group(function() {
    Route::get('/jenis', [RTBansosController::class, 'types']);
    Route::get('/penerima', [RTBansosController::class, 'recipients']);
  });
})->middleware(['auth', 'auth.session']);

Route::prefix('rw')->group(function() {
  Route::get('/', [RWDashboardController::class, 'index']);
  Route::get('/data-rt', [RWMemberController::class, 'main']);
  Route::prefix('/pengajuan')->group(function() {
    Route::get('/masuk', [RWPengajuanController::class, 'incoming']);
    Route::get('/disetujui', [RWPengajuanController::class, 'approved']);
  });
  Route::get('/bansos/penerima', [RWBansosController::class, 'recipients']);
})->middleware(['auth', 'auth.session']);

Route::prefix('admin')->group(function() {
  Route::get('/data-rw', [AdminRWController::class, 'index']);
  Route::get('/data-rt', [AdminRTController::class, 'index']);
  Route::get('/pemohon', [AdminAplicantController::class, 'index']);
  Route::prefix('/bansos')->group(function() {
    Route::get('/jenis', [AdminBansosController::class, 'types']);
    Route::get('/penerima', [AdminBansosController::class, 'recipients']);
  });
})->middleware(['auth', 'auth.session']);

Route::get('/notifikasi', [NotificationController::class, 'index']);
Route::get('/settings', [SettingController::class, 'index']);
Route::get('/faq', [FaqController::class, 'index']);