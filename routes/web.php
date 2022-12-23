<?php

use App\Http\Controllers\Moysklad\VendorController;
use App\Http\Controllers\Moysklad\IframeController;
use App\Http\Controllers\Moysklad\WidgetController;
use App\Http\Middleware\RequestLogger;
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


Route::middleware(RequestLogger::class)->group(function (){

    Route::put('/vendor-endpoint/api/moysklad/vendor/{version}/apps/{token}/{key}', [VendorController::class, 'endpoint'])
        ->name('vendor.endpoint');

    Route::get('/iframe', [IframeController::class, 'index'])->name('iframe');

    Route::get('/widgets/counterparty-widget', [WidgetController::class, 'counterpartyWidget'])->name(
        'counterparty.widget'
    );
    Route::get('/widgets/customerorder-widget', [WidgetController::class, 'customerOrderWidget'])->name(
        'customerorder.widget'
    );
    Route::get('/widgets/demand-widget', [WidgetController::class, 'demandWidget'])->name('demand.widget');

    Route::get('/', function () {
        return view('welcome');
    });
});

Route::get('logs', [LogViewerController::class, 'index']);
