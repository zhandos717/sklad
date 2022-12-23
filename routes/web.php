<?php

use App\Http\Controllers\Moysklad\VendorController;
use App\Http\Controllers\Moysklad\IframeController;
use App\Http\Controllers\Moysklad\WidgetController;
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
info('info',[
    'url'=>request()->getRequestUri(),
    'input'=>request()->all()
]);


Route::get('/', function () {
    return view('welcome');
});

//["/vendor-endpoint/api/moysklad/vendor/1.0/apps/7b9b82f5-4f27-4e25-bc55-6f8717ff66c7/e0be3639-7d4c-11ed-0a80-07f300006563"]


Route::get('/vendor-endpoint/api/moysklad/vendor/{version}/apps/{token}/{key}', [VendorController::class, 'endpoint'])->name('vendor.endpoint');

Route::get('/iframe', [IframeController::class, 'index'])->name('iframe');

Route::get('/widgets/counterparty-widget', [WidgetController::class, 'counterpartyWidget'])->name(
    'counterparty.widget'
);
Route::get('/widgets/customerorder-widget', [WidgetController::class, 'customerOrderWidget'])->name(
    'customerorder.widget'
);
Route::get('/widgets/demand-widget', [WidgetController::class, 'demandWidget'])->name('demand.widget');
