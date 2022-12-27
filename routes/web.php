<?php

use App\Http\Controllers\Moysklad\IframeController;
use App\Http\Controllers\Moysklad\SettingController;
use App\Http\Controllers\Moysklad\VendorController;
use App\Http\Controllers\Moysklad\WidgetController;
use App\Http\Controllers\Moysklad\ConfigController;
use App\Http\Middleware\RequestLogger;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(RequestLogger::class)->group(function () {

    Route::controller(VendorController::class)
        ->prefix('/vendor-endpoint/api/moysklad/vendor/{version}/apps/{appId}/{accountId}')
        ->group(function () {
            Route::put(
                '/',
                'store'
            );
            Route::delete(
                '/',
                'destroy'
            );
        });


    Route::get('/iframe', [IframeController::class, 'index'])->name('iframe');

    Route::prefix('widgets')->controller(WidgetController::class)
        ->group(function () {
            Route::get('customerorder-widget', 'customerOrderWidget')->name(
                'customerorder.widget'
            );
            Route::get('get-item', 'getItem')->name('demand.widget');
        });

    Route::get('update-settings', [SettingController::class, 'updateSettings'])
        ->name('update.settings');

    Route::post('update-settings', [SettingController::class, 'updateSettings'])
        ->name('update.settings');

    Route::post('config', [ConfigController::class, 'store'])
        ->name('config.store');

    Route::get('/', function () {
        return view('welcome');
    });
});

