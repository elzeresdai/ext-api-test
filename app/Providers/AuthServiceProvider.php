<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Services\WeArePentagon\WeArePentagonService;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->app->singleton(
            abstract: WeArePentagonService::class,
            concrete: fn () => new WeArePentagonService(
                baseUrl: strval(config('services.wearepentagon.url')),
                apiToken: strval(config('services.wearepentagon.token')),
            ),
        );
    }
}
