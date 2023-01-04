<?php

namespace App\Http\Resources\Moysklad;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleStoreResource extends JsonResource
{
    public function toArray($request): array|\JsonSerializable|\Illuminate\Contracts\Support\Arrayable
    {
        return [
            'view' => $this->view,
        ];
    }
}
