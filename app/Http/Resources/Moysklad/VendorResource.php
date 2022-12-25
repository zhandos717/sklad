<?php

namespace App\Http\Resources\Moysklad;

use Illuminate\Http\Resources\Json\JsonResource;

class
VendorResource extends JsonResource
{

    public static $wrap = null;

    public function toArray($request): array|\JsonSerializable|\Illuminate\Contracts\Support\Arrayable
    {
        return parent::toArray($request);
    }
}
