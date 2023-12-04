<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

Route::POST("/register", [UserController::class, "register"])->name("users/register");
Route::POST("/login", [UserController::class, "login"])->name("users/login");
Route::post("/addUser", [AdminController::class, "addUser"]);
Route::delete("/delete/{id}", [AdminController::class, "delete"])->name("/delete/{id}");
Route::PUT("/edit/{id}/{username}/{email}", [AdminController::class, "edit"]);
Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('login');
    });
    Route::get('/', function () {
        return view('login');
    });

    Route::get('/register', function () {
        return view('register');
    });
});
Route::middleware(['user'])->group(function () {
    Route::get('dashboard', function () {
        return view('/dashboard');
    });
    Route::get('/homepage', function () {
        return view('homepage');
    });
});
