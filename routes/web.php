<?php

use Illuminate\Support\Facades\Route;
use App\Infrastructure\Http\Controllers\AuthController;
use App\Infrastructure\Http\Controllers\BooksController;
use App\Infrastructure\Http\Controllers\CategoriesController;

// Public routes
Route::get('/health', [AuthController::class, 'health']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Protected routes (would add auth middleware)
Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/books', [BooksController::class, 'index']);
Route::get('/books/{id}', [BooksController::class, 'show']);
Route::post('/books', [BooksController::class, 'store']);