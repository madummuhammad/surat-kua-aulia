<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RecomendationController;
use App\Http\Controllers\Admin\KeteranganController;
use App\Http\Controllers\Admin\PemberitahuanController;
use App\Http\Controllers\Admin\NikahController;
use App\Http\Controllers\Admin\PermohonanController;
use App\Http\Controllers\Admin\DisposisiController;
use App\Http\Controllers\Admin\PegawaiController;

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

Route::get('/storage-link', function () { 
    $targetFolder = base_path().'/storage/app/public'; 
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage'; 
    symlink($targetFolder, $linkFolder); 
});

Route::get('/clear-cache', function () {
    Artisan::call('route:cache');
});

Route::get('/', [LoginController::class, 'index']);

// Authentication
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [LoginController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [LoginController::class, 'create_user'])->name('create_user')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//Admin
Route::prefix('admin')
->middleware('auth')
->group(function(){
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('admin-dashboard');
    Route::resource('/user', UserController::class);
    Route::resource('/pegawai', PegawaiController::class);
    
    Route::resource('/permohonan', PermohonanController::class);
    Route::get('permohonan/download/{id}', [PermohonanController::class, 'download_permohonan'])->name('download-permohonan');
    Route::get('permohonan/download_hasil/{id}', [PermohonanController::class, 'download_hasil'])->name('download-hasil');
    Route::get('permohonan/download_balasan/{id}', [PermohonanController::class, 'download_balasan'])->name('download-balasan');
    Route::post('permohonan/upload/{id}', [PermohonanController::class, 'upload'])->name('permohonan.upload');
    Route::post('permohonan/upload_balasan/{id}', [PermohonanController::class, 'upload_balasan'])->name('permohonan.upload_balasan');
    Route::post('/permohonan/verification/{id}', [PermohonanController::class,'verification'])->name('permohonan.verification');
    Route::get('permohonan/print/cetak_laporan',[PermohonanController::class,'cetak_laporan'])->name('permohonan.cetak-laporan');

    Route::resource('/recomendation', RecomendationController::class);
    Route::post('/recomendation/verification/{id}', [RecomendationController::class,'verification'])->name('recomendation.verification');
    Route::post('/recomendation/pegawai/{id}', [RecomendationController::class,'pegawai'])->name('recomendation.pegawai');
    Route::get('recomendation/download/{id}', [RecomendationController::class, 'download_recomendation'])->name('download-recomendation');
    Route::get('recomendation/print/create',[RecomendationController::class,'print'])->name('recomendation.print');
    Route::get('recomendation/print/cetak/{id}',[RecomendationController::class,'cetak'])->name('recomendation.cetak');
    Route::get('recomendation/print/cetak_laporan',[RecomendationController::class,'cetak_laporan'])->name('recomendation.cetak-laporan');

    Route::resource('/keterangan', KeteranganController::class);
    Route::post('/keterangan/verification/{id}', [KeteranganController::class,'verification'])->name('keterangan.verification');
    Route::post('/keterangan/pegawai/{id}', [KeteranganController::class,'pegawai'])->name('keterangan.pegawai');
    Route::get('keterangan/download/{id}', [KeteranganController::class, 'download_keterangan'])->name('download-keterangan');
    Route::get('keterangan/print/create',[KeteranganController::class,'print'])->name('keterangan.print');
    Route::get('keterangan/print/cetak/{id}',[KeteranganController::class,'cetak'])->name('keterangan.cetak');
    Route::get('keterangan/print/show/{id}',[KeteranganController::class,'show'])->name('keterangan.show');
    Route::get('keterangan/print/cetak_laporan',[KeteranganController::class,'cetak_laporan'])->name('keterangan.cetak-laporan');

    Route::resource('/pemberitahuan', PemberitahuanController::class);
    Route::post('/pemberitahuan/verification/{id}', [PemberitahuanController::class,'verification'])->name('pemberitahuan.verification');
    Route::get('pemberitahuan/download/{id}', [PemberitahuanController::class, 'download_pemberitahuan'])->name('download-pemberitahuan');
    Route::get('pemberitahuan/print/create',[PemberitahuanController::class,'print'])->name('pemberitahuan.print');
    Route::post('pemberitahuan/print/cetak',[PemberitahuanController::class,'cetak'])->name('pemberitahuan.cetak');
    Route::get('pemberitahuan/print/cetak_laporan',[PemberitahuanController::class,'cetak_laporan'])->name('pemberitahuan.cetak-laporan');

    Route::resource('/nikah', NikahController::class);
    Route::post('/nikah/verification/{id}', [NikahController::class,'verification'])->name('nikah.verification');
    Route::get('nikah/download/{id}', [NikahController::class, 'download_nikah'])->name('download-nikah');
    Route::get('nikah/print/create',[NikahController::class,'print'])->name('nikah.print');
    Route::post('nikah/print/cetak',[NikahController::class,'cetak'])->name('nikah.cetak');
    Route::get('nikah/print/cetak_laporan',[NikahController::class,'cetak_laporan'])->name('nikah.cetak-laporan');

    Route::resource('/disposisi', DisposisiController::class);
    Route::post('/disposisi/verification/{id}', [DisposisiController::class,'verification'])->name('disposisi.verification');
    Route::get('disposisi/download/{id}', [DisposisiController::class, 'download_disposisi'])->name('download-disposisi');
    Route::get('disposisi/print/cetak_laporan',[DisposisiController::class,'cetak_laporan'])->name('disposisi.cetak-laporan');
});
