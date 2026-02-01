<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageViewController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', [PageViewController::class,'showRegister'])->name('show.register');
Route::post('/register', [AuthController::class,'register'])->name('process.register');

Route::get('/login', [PageViewController::class,'showLogin'])->name('show.login');
Route::post('/login', [AuthController::class, 'login'])->name('process.login');

Route::post('/logout',[AuthController::class, 'logout'])->name('process.logout');

Route::get('/home',[PageViewController::class, 'showHome'])->name('show.home');

use App\Http\Controllers\ProfileController; // I'd rather put this close to where it's used...

Route::middleware('needsAuth')->group(function () {
Route::get('/profile', [PageViewController::class, 'showProfile'])->name('profile.show');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

use App\Http\Controllers\TaskController;
Route::middleware('needsAuth')->group(function(){
    Route::resource('tasks', TaskController::class);
});
