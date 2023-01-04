<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Resources\Moysklad\SaleStoreResource;
use Illuminate\Http\Request;

class SaleController
{
    public function store(Request $request): SaleStoreResource
    {
//        dd(
//            $request->all()
//        );

        return SaleStoreResource::make(
            new class(view('fiscal-receipt')->render()) {
                public function __construct(public string $view)
                {
                }
            }
        );
    }
}
