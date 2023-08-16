<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ScheduleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/calendar/{id}', [ScheduleController::class, 'show'])->name('calendar.show'); // こちらだけ残す

Auth::routes();

Route::get('/calendar', [ScheduleController::class, 'show'])->name("show"); 
Route::post('/calendar/create', [ScheduleController::class, 'create'])->name("create");
Route::post('/calendar/get',  [ScheduleController::class, 'get'])->name("get");
Route::delete('/calendar/delete', [ScheduleController::class, 'delete'])->name("delete");
Route::get('/calendar/create', [ScheduleController::class, 'showCreateForm'])->name('calendar.create.form');
