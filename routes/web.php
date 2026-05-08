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

// Route::get('places/listPlaces', [PlaceController::class, 'index'])->name('places.index');

// Route::get('places/{id}/edit', [PlaceController::class, 'edit'])->name('places.edit');

// Route::put('places/{id}', [PlaceController::class, 'update'])->name('places.update');

// Route::delete('places/{id}', [PlaceController::class, 'destroy'])->name('places.destroy');

Route::resource('places', PlaceController::class);