<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Services\Moysklad\Requests\CustomerOrderRequest;
use App\Services\Moysklad\Requests\ProductRequest;
use App\Services\Moysklad\UserContextLoaderService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function customerOrderWidget(UserContextLoaderService $userContextLoaderService): Factory|View|Application
    {
        return view(
            'moysklad.widgets.demo',
            array_merge(
                collect($userContextLoaderService->employee)->toArray(),
                ['entity' => 'customerorder']
            )
        );
    }

    public function getItem(Request $request, CustomerOrderRequest $customerOrder, ProductRequest $product)
    {
        $items = collect($customerOrder->content()->rows)->map(function ($item) use ($product) {
            $path = explode('/', $item->assortment->meta->href);
            $objectId = end($path);
            $item->product = $product->setObject($objectId)->content();
            $item->total = ($item->quantity * $item->price) / 100;
            $item->price = $item->price / 100;
            return $item;
        });

        return view(
            'moysklad.widgets.cashbox',
            [
                'sale'      => Sale::whereOrderId($request->objectId)->first(),
                'items'     => $items,
                'accountId' => $request->accountId,
                'objectId'  => $request->objectId,
            ]
        );
    }
}
