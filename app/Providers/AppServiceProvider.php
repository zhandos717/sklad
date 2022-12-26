<?php

namespace App\Providers;

use App\Services\Moysklad\UserContextLoaderService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserContextLoaderService::class, function () {
            return new UserContextLoaderService(request()->get('contextKey'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.force_scheme') === 'https') {
            URL::forceScheme('https');
        }
    }
}
