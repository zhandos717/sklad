<?php

use App\Http\Controllers\Moysklad\VendorController;
use App\Http\Controllers\Moysklad\IframeController;
use App\Http\Controllers\Moysklad\WidgetController;
use App\Http\Controllers\Moysklad\SettingController;
use App\Http\Middleware\FrameHeadersMiddleware;
use App\Http\Middleware\RequestLogger;
use App\Services\VendorService;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

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
    Route::put(
        '/vendor-endpoint/api/moysklad/vendor/{version}/apps/{appId}/{accountId}',
        [VendorController::class, 'endpoint']
    );

    Route::get('/iframe', [IframeController::class, 'index'])->name('iframe')
        ->middleware(FrameHeadersMiddleware::class);

    Route::prefix('widgets')->controller(WidgetController::class)->group(function () {
        Route::get('counterparty-widget', 'counterpartyWidget')->name(
            'counterparty.widget'
        );
        Route::get('customerorder-widget', 'customerOrderWidget')->name(
            'customerorder.widget'
        );
        Route::get('demand-widget', 'demandWidget')->name('demand.widget');
    });


    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('logs', [LogViewerController::class, 'index']);


    Route::get('context', function () {
        $contextKey = request()->input('contextKey');
        $content = app(VendorService::class)->context($contextKey)->json();

        dd($content);
    });

    Route::post('update-settings', [SettingController::class, 'updateSettings'])
        ->name('update.settings');
});

