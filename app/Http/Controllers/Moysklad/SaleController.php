<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Resources\Moysklad\SaleStoreResource;
use App\Models\MoySkladConfig;
use App\Services\WiponKassa\CashboxService;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class SaleController
{
    /**
     * @throws \Exception
     */
    public function store(Request $request): SaleStoreResource
    {

        dd(11);

        $moySklad = MoySkladConfig::whereAccountId($request->input('accountId'))->first();

//        $response = $cashboxService->sale([
//            'token'    => $moySklad->tis_token,
//            'type'     => 2,
//            'items'    => [
//                [
//                    "name"          => "Яблочный сок",
//                    "price"         => 950,
//                    "quantity"      => 1,
//                    "discount"      => 50,
//                    "kgd_code"      => 796,
//                    "compare_field" => [
//                        "type"  => "barcode",
//                        "value" => "apple-juice"
//                    ]
//                ]
//            ],
//            'payments' => [
//                [
//                    "payment_method" => 0,
//                    "sum"            => 1000
//                ]
//            ]
//        ]);

        return SaleStoreResource::make(
            new class(view('fiscal-receipt')->render()) {
                public function __construct(public string $view)
                {
                }
            }
        );
    }
}
