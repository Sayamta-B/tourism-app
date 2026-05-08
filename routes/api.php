<?php
use App\Http\Controllers\Api\PlaceController;

Route::get('/places', [PlaceController::class, 'index']);
Route::get('/places/{id}', [PlaceController::class, 'show']);