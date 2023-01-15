<?php

use App\Http\Controllers\Telegram\BotController;
use App\Http\Controllers\Telegram\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/form/contact', [Form::class, 'send'])->name('form.contact');

Route::get('telegram-bot', [BotController::class, 'webHook']);
