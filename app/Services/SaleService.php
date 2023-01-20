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
    ){
    }

    /**
     * @throws \Exception
     */
    public function fiscalize(string $accountId, string $objectId): array | string
    {
        $moySklad = MoySkladConfig::whereAccountId($accountId)->first();

        $rows = collect($this->customerOrder->content()->rows);

        $totalSum = $rows->sum(fn($row) => $row->price * $row->quantity / 100);

        $sale = Sale::firstOrCreate(['order_id' => $objectId],
            [
                'price'               => $totalSum,
                'type'                => CashboxService::RECEIPT_TYPE_SALE,
                'moy_sklad_config_id' => $moySklad->id
            ]);

        if (isset($sale->fiscal_receipt)) {
            return [
                'view'           => isset($sale->fiscal_receipt['data']['link']) ? file_get_contents(
                    $sale->fiscal_receipt['data']['link']
                ) : '<p>Не удалось фискализировать продажу</p>',
                'link'           => $sale->fiscal_receipt['data']['link'] ?? null,
                'receipt_number' => $sale->fiscal_receipt['data']['receipt_number'] ?? null,
            ];
        }


        $items = $rows->map(function ($item) use ($sale){
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

        $sale->update([
            'fiscal_receipt' =>
                $this->cashboxService->sale([
                    'token'    => $moySklad->tis_token,
                    'type'     => CashboxService::RECEIPT_TYPE_SALE,
                    'items'    => $items->toArray(),
                    'payments' => [
                        [
                            "payment_method" => CashboxService::PAYMENT_TYPE_CASH,
                            "sum"            => $totalSum
                        ]
                    ]
                ])
        ]);

        return [
            'view'           => file_get_contents($sale->fiscal_receipt['data']['link']),
            'link'           => $sale->fiscal_receipt['data']['link'],
            'receipt_number' => $sale->fiscal_receipt['data']['receipt_number'],
        ];
    }
}
