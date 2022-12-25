<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Http\Requests\WidgetRequest;
use App\Models\MoySkladConfig;
use App\Services\Moysklad\MoySkladService;
use App\Services\Moysklad\UserContextLoaderService;
use App\Services\Moysklad\VendorService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function counterpartyWidget()
    {
    }

    public function customerOrderWidget(UserContextLoaderService $userContextLoaderService): Factory|View|Application
    {
        // $object = jsonApi()->getObject($entity, $objectId

        //dump(collect($userContextLoaderService->employee)->toArray());

        return view(
            'moysklad.widgets.demo',
            array_merge(
                collect($userContextLoaderService->employee)->toArray(),
                ['entity' => 'customerorder']
            )
        );
        //return view('moysklad.widgets.customer-order');
    }

    public function getItem(Request $request)
    {
        $accountId = $request->input('accountId');
        $entity = $request->input('entity');
        $objectId = $request->input('objectId');

        $app = MoySkladService::loadApp($accountId);


        dd(
            MoySkladConfig::all());

        dd($app);

       // $object = jsonApi()->getObject($entity, $objectId);


    }

    public function demandWidget()
    {
    }
}
