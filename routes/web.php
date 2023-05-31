<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
//api data-tables
Route::get("/api-list-pengguna", [\App\Http\Controllers\Barjas\UsersController::class, "get_all_users"])->name("api-list-pengguna");

Route::get("/", [\App\Http\Controllers\Auth\LoginController::class, "index"])->name("index");
Route::get("/dashboard", [\App\Http\Controllers\DashboardController::class, "index"])->name("dashboard");
//pengguna
Route::get("/pengguna", [\App\Http\Controllers\Barjas\UsersController::class, "index"])->name("pengguna");
Route::post("/buat-pengguna", [\App\Http\Controllers\Barjas\UsersController::class, "buat"])->name("buat-pengguna");
Route::get("{id}/pengguna", [\App\Http\Controllers\Barjas\UsersController::class, "ambil"]);
Route::delete("{id}/hapus-pengguna", [\App\Http\Controllers\Barjas\UsersController::class, "hapus"])->name("hapus-pengguna");
