<?php 

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');

Route::middleware('auth')->group(function () {
    Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');
    Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');
    Route::get('/locations/{location}/edit', [LocationController::class, 'edit'])->name('locations.edit');
    Route::put('/locations/{location}', [LocationController::class, 'update'])->name('locations.update');
    Route::delete('/locations/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');
    });
    
Route::get('/locations/{location}', [LocationController::class, 'show'])->name('locations.show');