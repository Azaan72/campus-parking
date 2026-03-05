<?php 

use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;

Route::get('/maps', [MapController::class, 'index'])->name('maps.index');
Route::post('/maps/route', [MapController::class, 'route'])->name('maps.route');


