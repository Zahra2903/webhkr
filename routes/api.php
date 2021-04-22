<?php
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\timController;
use App\Http\Controllers\unitController;
use App\Http\Controllers\kriteriaController;
use App\Http\Controllers\kategori_hasilController;
use App\Http\Controllers\nilaiController;
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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
