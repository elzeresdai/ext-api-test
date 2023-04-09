<?php

namespace App\Providers;

use App\Services\WeArePentagon\WeArePentagonService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(
            abstract: WeArePentagonService::class,
            concrete: fn () => new WeArePentagonService(
                baseUrl: strval(config('services.wearepentagon.url')),
                apiToken:strval(config('services.wearepentagon.token')),
                client_id:strval(config('services.wearepentagon.username')),
                client_secret:strval(config('services.wearepentagon.password')),
            ),
        );
    }
}
