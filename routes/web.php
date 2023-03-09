<?php

use Illuminate\Support\Facades\Route;
use WebduoNederland\LaravelImageResizer\Http\Controllers\ImageController;

Route::pattern('image_path', '.*');
Route::get('/{image_path}', [ImageController::class, 'index']);