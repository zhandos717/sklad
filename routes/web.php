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

info('data', [
    'access_token' => request()->get('access') ?? null,
    'appUid' => request()->get('appUid') ?? null,
    'method' => request()->method()
]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vendor-endpoint/api/moysklad/vendor/{version}/apps/{token}/{key}', [VendorController::class, 'endpoint'])
    ->name('vendor.endpoint');

Route::get('/iframe', [IframeController::class, 'index'])->name('iframe');

Route::get('/widgets/counterparty-widget', [WidgetController::class, 'counterpartyWidget'])->name(
    'counterparty.widget'
);
Route::get('/widgets/customerorder-widget', [WidgetController::class, 'customerOrderWidget'])->name(
    'customerorder.widget'
);
Route::get('/widgets/demand-widget', [WidgetController::class, 'demandWidget'])->name('demand.widget');
