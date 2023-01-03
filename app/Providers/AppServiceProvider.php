<?php

namespace App\Providers;

use App\Models\MoySkladConfig;
use App\Services\Moysklad\JsonApiService;
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
    public function register(): void
    {
        $this->app->bind(UserContextLoaderService::class, function (){
            return new UserContextLoaderService(request()->get('contextKey'));
        });

        $this->app->bind(JsonApiService::class, function (){
            $accessToken = MoySkladConfig::whereAccountId( request()->get('accountId'))->first()->access_token;
            return new JsonApiService($accessToken, request()->get('objectId'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if (config('app.force_scheme') === 'https') {
            URL::forceScheme('https');
        }
    }
}
