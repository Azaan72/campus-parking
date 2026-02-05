<?php

use App\Http\Controllers\ParkingSpotController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {


});

//index
Route::get('/parkingspots', [ParkingSpotController::class, 'index'])->name('parkingspots.index');
// Show
Route::get('/parkingspots/{parkingSpot}', [ParkingSpotController::class, 'show'])->name('parking-spots.show');
    // Create
    Route::get('/parkingspots/create', [ParkingSpotController::class, 'create'])->name('parkingspots.create');
    Route::post('/parkingspots', [ParkingSpotController::class, 'store'])->name('parkingspots.store');



    // Edit / Update
    Route::get('/parkingspots/{parkingSpot}/edit', [ParkingSpotController::class, 'edit'])->name('parkingspots.edit');
    Route::put('/parkingspots/{parkingSpot}', [ParkingSpotController::class, 'update'])->name('parkingspots.update');

    // Delete
    Route::delete('/parkingspots/{parkingSpot}', [ParkingSpotController::class, 'destroy'])->name('parkingspots.destroy');