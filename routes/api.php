<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

Route::get('/comments', [CommentController::class, 'index']); // Return JSON
Route::post('/comments', [CommentController::class, 'store']); // Save comment
