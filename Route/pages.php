<?php

use App\Application\Router\Route;
use App\Controllers\PsgesController;
use App\Middleweare\GuestMiddleWeare;

Route::page('/htdocs/instagram/index', PsgesController::class, 'index');
Route::page('/htdocs/instagram/login', PsgesController::class, 'login', GuestMiddleWeare::class);
Route::page('/htdocs/instagram/registr', PsgesController::class, 'registr', GuestMiddleWeare::class);
Route::page('/htdocs/instagram/profile', PsgesController::class, 'profile');