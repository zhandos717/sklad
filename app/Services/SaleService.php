<?php

namespace App\Services;

use App\Models\Item;
use App\Models\MoySkladConfig;
use App\Models\Payment;
use App\Models\Sale;
use App\Services\Moysklad\Requests\CustomerOrderRequest;
use App\Services\Moysklad\Requests\ProductRequest;
use App\Services\WiponKassa\CashboxService;

class SaleService
{
    public function __construct(
        private CashboxService $cashboxService,
        private CustomerOrderRequest $customerOrder,
        private ProductRequest $product
    ) {
    }

    public function fiscalize(string $accountId): array|string
    {
        $moySklad = MoySkladConfig::whereAccountId($accountId)->first();

        $totalSum = collect($this->customerOrder->content()->rows)->sum(fn($row) => $row->price * $row->quantity / 100);

        $sale = Sale::create([
            'price'               => $totalSum,
            'type'                => CashboxService::RECEIPT_TYPE_SALE,
            'moy_sklad_config_id' => $moySklad->id
        ]);


        $items = collect($this->customerOrder->content()->rows)->map(function ($item) use ($sale) {
            $path = explode('/', $item->assortment->meta->href);
            $objectId = end($path);
            $item->product = $this->product->setObject($objectId)->content();

            Item::updateOrCreate([
                'name' => $item->product->name,
            ], [
                'quantity' => $item->quantity,
                'discount' => 0,
                'kgd_code' => 796,
                'sale_id'  => $sale->id,
            ]);

            return [
                "name"          => $item->product->name,
                "price"         => $item->price / 100,
                "quantity"      => $item->quantity,
                "discount"      => 0,
                "kgd_code"      => 796,
                "compare_field" => [
                    "type"  => 'barcode',
                    "value" => array_shift($item->product->barcodes)->ean13
                ]
            ];
        });

        Payment::create([
            'method'  => CashboxService::PAYMENT_TYPE_CASH,
            "sum"     => $totalSum,
            'sale_id' => $sale->id,
        ]);

        return $this->cashboxService->sale([
            'token'    => $moySklad->tis_token,
            'type'     => CashboxService::RECEIPT_TYPE_SALE,
            'items'    => $items->toArray(),
            'payments' => [
                [
                    "payment_method" => CashboxService::PAYMENT_TYPE_CASH,
                    "sum"            => $totalSum
                ]
            ]
        ]);
    }
}
