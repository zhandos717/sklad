<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Resources\Moysklad\SaleStoreResource;
use App\Services\SaleService;
use Exception;
use Illuminate\Http\Request;

class SaleController
{
    /**
     * @throws Exception
     */
    public function store(
        Request $request,
        SaleService $saleService
    ) {
        $data = $saleService->fiscalize($request->get('accountId'));

        return new SaleStoreResource($data);
    }

    public function test()
    {
        return view('fiscal-receipt');
    }
}
