<?php

use App\Application\Router\Route;
use App\Controllers\UserController;
use App\Controllers\PostsController;

Route::post('/htdocs/instagram/registr', UserController::class, 'registr');
Route::post('/htdocs/instagram/login', UserController::class, 'login');
Route::post('/htdocs/instagram/logout', UserController::class, 'logout');
Route::post('/htdocs/instagram/post/publish', PostsController::class, 'publish');