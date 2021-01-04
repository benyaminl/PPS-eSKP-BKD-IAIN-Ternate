<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [App\Http\Controllers\SKPController::class, "list"]);

/** Bagian SKP */
Route::prefix("/skp")->group(function() {
    Route::get("/", [App\Http\Controllers\SKPController::class, "list"]);
    Route::get("/add", [App\Http\Controllers\SKPController::class, "addHeaderForm"]);
    Route::get("/{id}/detail", [App\Http\Controllers\SKPController::class, "detailForm"]);
    Route::get("/{id}/detail/add", [App\Http\Controllers\SKPController::class, "addDetailForm"]);
    Route::get("/verifikasi", [App\Http\Controllers\SKPController::class, "listValidasiSKP"]);
    Route::get("/verifikasi/{id}/detail", [App\Http\Controllers\SKPController::class, "detailForm"]);

    // Data Process
    Route::post("/add", [App\Http\Controllers\SKPController::class, "add"]);
    Route::post("/{id}/detail/add", [App\Http\Controllers\SKPController::class, "addDetail"]);
    // delete detail
    Route::delete("/{id}/detail", [App\Http\Controllers\SKPController::class, "deleteDetail"]);

    // Ajukan Validasi
    Route::put("/{id}/detail", [App\Http\Controllers\SKPController::class, "ajukanValidasi"]);

    // Validasi SKP
    Route::patch("/verifikasi", [App\Http\Controllers\SKPController::class, "validasiSKP"]);
    // Reject SKP
    Route::delete("/verifikasi", [App\Http\Controllers\SKPController::class, "rejectSKP"]);
});
