<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            LoginResponse::class,
            \App\Http\Responses\LoginResponse::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
