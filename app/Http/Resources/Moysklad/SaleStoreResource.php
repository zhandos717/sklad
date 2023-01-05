<?php

namespace App\Http\Resources\Moysklad;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleStoreResource extends JsonResource
{
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return [
            'view' => $this->resource['view']
        ];
    }
}
