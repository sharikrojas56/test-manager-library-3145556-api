<?php

use Illuminate\Support\Facades\Route;
use App\Infrastructure\Http\Controllers\AuthController;

Route::get('/health', [AuthController::class, 'health']);
Route::post('/auth/login', [AuthController::class, 'login']);