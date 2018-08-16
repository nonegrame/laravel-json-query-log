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
        $middles = config("queryLog.MIDDLE_APPEND");
        /** @var Router $router */
        $router = $this->app['router'];
        if (is_string($middles)) {
            $router->pushMiddlewareToGroup($middles, DatabaseQueryLogMiddleware::class);
        }

        if (is_array($middles)) {
            foreach ($middles as $middle) {
                $router->pushMiddlewareToGroup($middle, DatabaseQueryLogMiddleware::class);
            }
        }
    }
}