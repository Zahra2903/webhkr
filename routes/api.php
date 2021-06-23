<?php
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\timController;
use App\Http\Controllers\unitController;
use App\Http\Controllers\kriteriaController;
use App\Http\Controllers\kategori_hasilController;
use App\Http\Controllers\nilaiController;
use App\Http\Controllers\tim_detailController;
use App\Http\Controllers\unit_detailController;
use App\Http\Controllers\penilaianController;
use App\Http\Controllers\penilaian_detailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::resource('karyawan', karyawanController::class);
Route::resource('tim', timController::class);
Route::resource('unit', unitController::class);
Route::resource('kriteria', kriteriaController::class);
Route::resource('kategori_hasil', kategori_hasilController::class);
Route::resource('nilai', nilaiController::class);
Route::resource('tim_detail', tim_detailController::class);
Route::resource('unit_detail', unit_detailController::class);
Route::resource('penilaian', penilaianController::class);
Route::resource('penilaian_detail', penilaian_detailController::class);
Route::get('kriteria/{id}/showkriteria', [kriteriaController::class, 'showkriteria'])->name('kriteria.showkriteria');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
