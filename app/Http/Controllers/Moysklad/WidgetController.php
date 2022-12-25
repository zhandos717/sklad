<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Http\Requests\WidgetRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class WidgetController extends Controller
{
    public function counterpartyWidget()
    {

    }

    public function customerOrderWidget(WidgetRequest $request): Factory|View|Application
    {



        return view('moysklad.widgets.customer-order');
    }

    public function demandWidget()
    {

    }
}
