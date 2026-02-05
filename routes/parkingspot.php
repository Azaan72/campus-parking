<?php

use App\Http\Controllers\ParkingSpotController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {});


Route::get('/parkingspots', [ParkingSpotController::class, 'index'])->name('parkingspots.index');
Route::get('/parkingspots/create', [ParkingSpotController::class, 'create'])->name('parkingspots.create');
Route::post('/parkingspots', [ParkingSpotController::class, 'store'])->name('parkingspots.store');
Route::get('/parkingspots/{parkingspot}', [ParkingspotController::class, 'show'])->name('parkingspots.show'); 
Route::get('/parkingspots/{parkingspot}/edit', [ParkingSpotController::class, 'edit'])->name('parkingspots.edit');
Route::put('/parkingspots/{parkingspot}', [ParkingSpotController::class, 'update'])->name('parkingspots.update');
Route::delete('/parkingspots/{parkingspot}', [ParkingSpotController::class, 'destroy'])->name('parkingspots.destroy');
