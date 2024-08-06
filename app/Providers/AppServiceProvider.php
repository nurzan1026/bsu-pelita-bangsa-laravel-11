<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TelegramService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TelegramService::class, function ($app) {
            return new TelegramService();
        });
    }

    public function boot()
    {
        //
    }
}
