<?php

namespace WebduoNederland\LaravelImageResizer;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Support\Facades\Route;

class ServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        $this
            ->registerConfig();
    }

    protected function registerConfig(): static
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-image-resizer.php', 'laravel-image-resizer');

        return $this;
    }

    public function boot(): void
    {
        $this
            ->bootConfig()
            ->bootRoutes();
    }

    protected function bootConfig(): static
    {
        $this->publishes([
            __DIR__.'/../config/laravel-image-resizer.php' => config_path('laravel-image-resizer.php'),
        ], 'config');

        return $this;
    }

    protected function bootRoutes(): static
    {
        Route::prefix(config('laravel-image-resizer.prefix'))
            ->group(fn () => $this->loadRoutesFrom(__DIR__.'/../routes/web.php'));

        return $this;
    }
}