<?php

namespace Infotech\Data2Monthly;

use Illuminate\Support\ServiceProvider;
use Infotech\Data2Monthly\Data2Monthly;

class Data2MonthlyServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        $this->app->singleton('Monthly', function ($app) {
            return new Data2Monthly;
        });
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }
}
