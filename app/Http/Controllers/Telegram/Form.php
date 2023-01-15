<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Http\Requests\Telegram\Form\SendRequest;
use DefStudio\Telegraph\Facades\Telegraph;

class Form extends Controller
{
    public function send(SendRequest $request)
    {
        // dd($request->all());

        $email = $request->get('email');
        $phone = $request->get('phone');
        $message = $request->get('message');
        $name = $request->get('name');

        Telegraph::html(
            view(
                'telegram.notification',
                compact('email', 'phone', 'message', 'name')
            )->render()
        )->send();

        return 'OK';
    }
}
