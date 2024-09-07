<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        // 'auth' => \App\Http\Middleware\Authenticate::class,
        // 'auth.custom' => \App\Http\Middleware\CustomAuthenticate::class,
    ];
}
