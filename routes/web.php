<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ArticleController::class, 'index']);

Route::post('/webhook/articles', [ArticleController::class, 'store']);