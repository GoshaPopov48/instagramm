<?php

namespace App\Middleweare;

use App\Application\Middleweare\Middleware;
use App\Application\Auth\Auth;
use App\Application\Router\Redirect;

class GuestMiddleWeare extends Middleware
{

    public function handle()
    {
        if (Auth::check()) {
            Redirect::to('index');
        }
    }
}