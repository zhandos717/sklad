<?php

use App\Http\Controllers\Telegram\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/form/contact', [Form::class, 'send'])->name('form.contact');
