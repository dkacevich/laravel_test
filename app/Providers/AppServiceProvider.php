<?php

namespace App\Providers;

use App\Services\ImageManager\ImageManager;
use App\Services\ImageManager\TInyPng\TinyPngImageManager;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app
            ->bind(ImageManager::class, function (Application $app) {
                return new TinyPngImageManager(config('services.tiny_png.api_key'));
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro(
            'validationException',
            function (string $message, array $fails) {

                return Response::json([
                    'success' => false,
                    'message' => $message,
                    'fails' => $fails
                ], 422);

            });
    }
}
