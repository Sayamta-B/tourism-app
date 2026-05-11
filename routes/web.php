<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Web\PlaceController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\CityController;
use App\Http\Controllers\Web\AuthController;
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
Route::resource('categories', CategoryController::class)->middleware('auth');
Route::resource('cities', CityController::class)->middleware('auth');

Route::get('login', [AuthController::class, 'login_view'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('register', [AuthController::class, 'register_view'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.submit');