<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Http\Resources\Moysklad\ItemResource;
use App\Models\MoySkladConfig;
use App\Services\Moysklad\Entity\CustomerOrder;
use App\Services\Moysklad\Entity\Product;
use App\Services\Moysklad\JsonApiService;
use App\Services\Moysklad\UserContextLoaderService;
use Doctrine\DBAL\Exception;
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
        return view(
            'moysklad.widgets.demo',
            array_merge(
                collect($userContextLoaderService->employee)->toArray(),
                ['entity' => 'customerorder']
            )
        );
    }

    public function getItem(Request $request, CustomerOrder $customerOrder, Product $product)
    {
        dd($customerOrder->content());

       dd($product->setObject($customerOrder->ge);

        return view(
            'moysklad.widgets.cashbox',
         [
             'summ'=>$order->response->object()->sum
         ]
        );
    }
}
