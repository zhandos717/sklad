<?php

use App\Http\Controllers\Moysklad\IframeController;
use App\Http\Controllers\Moysklad\VendorController;
use App\Http\Controllers\Moysklad\WidgetController;
use App\Http\Controllers\Moysklad\SaleController;
use Illuminate\Support\Facades\Route;


Route::post('/sale', [SaleController::class, 'store'])->name('sale');

Route::post('settings/update', [VendorController::class, 'update'])->name('settings.update');

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

Route::get('iframe', [IframeController::class, 'index'])->name('iframe');

Route::view('descriptor', 'moysklad.descriptor-xml');

Route::prefix('widgets')->controller(WidgetController::class)
    ->group(function () {
        Route::get('customerorder-widget', 'customerOrderWidget')->name(
            'customerorder.widget'
        );
        Route::get('get-item', 'getItem')->name('demand.widget');
    });

Route::view('/', 'landing.index');
