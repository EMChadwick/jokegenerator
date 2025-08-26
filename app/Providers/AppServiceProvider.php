<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Connectors\JokeAccess;
use App\Connectors\APIJokeAccess;

use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // definitely overkill but it demonstrates dependency injection
        $this->app->bind(JokeAccess::class, APIJokeAccess::class);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::aliasMiddleware('api-token', \App\Http\Middleware\ApiTokenAuth::class);
    }
}
