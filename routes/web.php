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
    Route::post("/add", [App\Http\Controllers\SKPController::class, "add"]);
});