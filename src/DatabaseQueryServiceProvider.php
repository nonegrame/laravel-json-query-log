<?php

namespace Nonegrame\LaravelJsonQueryLog;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class DatabaseQueryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /** @var Router $router */
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('api', DatabaseQueryLogMiddleware::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}