<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Http\Requests\WidgetRequest;
use App\Services\Moysklad\UserContextLoaderService;
use App\Services\Moysklad\VendorService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class WidgetController extends Controller
{
    public function counterpartyWidget()
    {
    }

    public function customerOrderWidget(UserContextLoaderService $userContextLoaderService): Factory|View|Application
    {
        // $object = jsonApi()->getObject($entity, $objectId

        dump(collect($userContextLoaderService->employee)->toArray());

        return view('moysklad.widgets.demo', collect($userContextLoaderService->employee)->toArray());
        //return view('moysklad.widgets.customer-order');
    }

    public function demandWidget()
    {
    }
}
