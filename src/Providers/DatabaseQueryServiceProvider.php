<?php

namespace Nonegrame\LaravelJsonQueryLog\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Nonegrame\LaravelJsonQueryLog\Http\Middleware\DatabaseQueryLogMiddleware;

class DatabaseQueryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Config file publish
        $configPath = app()->basePath() . '/config/queryLog.php';
        $this->publishes([
            __DIR__ . '/../config/queryLog.php' => $configPath,
        ], 'queryLog');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /** @var Router $router */
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('api', DatabaseQueryLogMiddleware::class);
    }
}