<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\PlaceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/map', [PlaceController::class, 'map']);

// Route::get('places/create', [PlaceController::class, 'create'])->name('places.create');

// Route::post('places/', [PlaceController::class, 'store'])->name('places.store');

// Route::get('places/index', [PlaceController::class, 'index'])->name('places.index');

// Route::get('places/{id}/edit', [PlaceController::class, 'edit'])->name('places.edit');

// Route::put('places/{id}', [PlaceController::class, 'update'])->name('places.update');

// Route::delete('places/{id}', [PlaceController::class, 'destroy'])->name('places.destroy');

Route::resource('places', PlaceController::class)->middleware('auth');

Route::get('login', [AuthController::class, 'login_view'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('register', [AuthController::class, 'register_view'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.submit');