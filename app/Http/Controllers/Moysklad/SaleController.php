<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Resources\Moysklad\SaleStoreResource;
use App\Models\MoySkladConfig;
use App\Services\Moysklad\JsonApiService;
use App\Services\Moysklad\Requests\CustomerOrderRequest;
use App\Services\Moysklad\Requests\ProductRequest;
use App\Services\WiponKassa\CashboxService;
use Exception;
use Illuminate\Http\Request;

class SaleController
{
    /**
     * @throws Exception
     */
    public function store(
        Request $request,
        CashboxService $cashboxService,
        CustomerOrderRequest $customerOrder,
        ProductRequest $product
    ) {
        $moySklad = MoySkladConfig::whereAccountId($request->input('accountId'))->first();

        $items = collect($customerOrder->content()->rows)->map(function ($item) use ($product) {
            $path = explode('/', $item->assortment->meta->href);
            $objectId = end($path);
            $item->product = $product->setObject($objectId)->content();

            return [
                "name"          => $item->product->name,
                "price"         => $item->price/100,
                "quantity"      => $item->quantity,
                "discount"      => 0,
                "kgd_code"      => 796,
                "compare_field" => [
                    "type"  => 'barcode',
                    "value" => array_shift($item->product->barcodes)->ean13
                ]
            ];
        });

        $response = $cashboxService->sale([
            'token'    => $moySklad->tis_token,
            'type'     => CashboxService::RECEIPT_TYPE_SALE,
            'items'    => $items->toArray(),
            'payments' => [
                [
                    "payment_method" => CashboxService::PAYMENT_TYPE_CASH,
                    "sum"            => $items->sum(function ($item) {
                        return $item['price'] * $item['quantity'];
                    })
                ]
            ]
        ]);

        return new SaleStoreResource($response);
    }
}
