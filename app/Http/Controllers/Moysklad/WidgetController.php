<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Http\Resources\Moysklad\ItemResource;
use App\Models\MoySkladConfig;
use App\Services\Moysklad\JsonApiService;
use App\Services\Moysklad\UserContextLoaderService;
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

    public function getItem(Request $request, JsonApiService $jsonApiService)
    {
        $accountId = $request->input('accountId');
        $entity = $request->input('entity');
        $objectId = $request->input('objectId');

        $moySklad = MoySkladConfig::where('account_id', $accountId)->first();

        $item = $jsonApiService
            ->setToken($moySklad->access_token)
            ->getItem($entity, $objectId);

        return new ItemResource($item);
    }

}
