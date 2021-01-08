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
Route::prefix("/skp")->group(function () {
    Route::get("/", [App\Http\Controllers\SKPController::class, "list"]);
    Route::get("/add", [App\Http\Controllers\SKPController::class, "addHeaderForm"]);
    Route::get("/{id}/detail", [App\Http\Controllers\SKPController::class, "detailForm"]);
    Route::get("/{id}/detail/add", [App\Http\Controllers\SKPController::class, "addDetailForm"]);
    Route::get("/{id}/detail/add-tgstambahan", [App\Http\Controllers\SKPController::class, "addDetailTambahanForm"]);
    Route::get("/verifikasi", [App\Http\Controllers\SKPController::class, "listValidasiSKP"]);
    Route::get("/verifikasi/{id}/detail", [App\Http\Controllers\SKPController::class, "detailForm"]);
    // Pengesahan LIST
    Route::get("/pengesahan", [App\Http\Controllers\SKPController::class, "listPengesahanSKP"]);
    Route::get("/pengesahan/{id}/detail", [App\Http\Controllers\SKPController::class, "detailForm"]);

    // Data Process
    Route::post("/add", [App\Http\Controllers\SKPController::class, "add"]);
    Route::post("/{id}/detail/add", [App\Http\Controllers\SKPController::class, "addDetail"]);
    // Process tugas tambahan
    Route::post("/{id}/detail/add-tgstambahan", [App\Http\Controllers\SKPController::class, "addDetailTambahan"]);
    // delete detail
    Route::delete("/{id}/detail", [App\Http\Controllers\SKPController::class, "deleteDetail"]);

    // Ajukan Validasi
    Route::put("/{id}/detail", [App\Http\Controllers\SKPController::class, "ajukanValidasi"]);

    // Validasi SKP
    Route::patch("/verifikasi/{id}/detail", [App\Http\Controllers\SKPController::class, "validasiSKP"]);
    // Reject SKP
    Route::delete("/verifikasi/{id}/detail", [App\Http\Controllers\SKPController::class, "rejectSKP"]);
    // Pengesahan 
    Route::post("/pengesahan/{id}/detail", [App\Http\Controllers\SKPController::class, "pengesahanSKP"]);

    // Print Halaman
    Route::get("/{id}/print", [App\Http\Controllers\SKPController::class, "printSKP"]);
    // Ini URL untuk QR Code
    Route::get("/{id}/print/qr", [App\Http\Controllers\SKPController::class, "generateQR"]);
});

/** Penilaian SKP **/
Route::prefix("/skp/penilaian")->group(function () {
    // List SKP punya anak buah dari Atasan nya
    Route::get("/", [App\Http\Controllers\PenilaianSKPController::class, "listSKP"]);
    // Detail SKP yang dinilai/realisasi
    Route::get("/{id}/detail", [App\Http\Controllers\PenilaianSKPController::class, "realisasiForm"]);

    // Simpan Nilai Tugas Jabatan
    Route::post("/{id}/detail", [App\Http\Controllers\PenilaianSKPController::class, "simpanNilai"]);
});

/** Bagian BKD */
Route::get("/bkd", [App\Http\Controllers\BkdController::class, "index"]);
//Route::post("/bkd/create","BkdController@create");

Route::prefix("/bkd")->group(function () {
    Route::get("/", [App\Http\Controllers\BkdController::class, "index"]);
    Route::get("/pendidikan", [App\Http\Controllers\BkdController::class, "bidpend"]);
    Route::post("/create", [App\Http\Controllers\BkdController::class, "create"]);
    Route::get("/pendidikan/{No}/edit", [App\Http\Controllers\BkdController::class, "edit"]);
    Route::post("/pendidikan/{No}/update", [App\Http\Controllers\BkdController::class, "update"]);
    Route::get("/pendidikan/{No}/delete", [App\Http\Controllers\BkdController::class, "delete"]);
});

/** Bagian LKD */
Route::get("/lkd/add", [App\Http\Controllers\LKDController::class, "addlkd"]);
//Route::post("/bkd/create","BkdController@create");
