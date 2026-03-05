<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatistiekenController;

Route::middleware('auth')->get('/statistieken', [StatistiekenController::class, 'index'])
    ->name('statistieken');