<?php

declare(strict_types = 1);

namespace App\Http\Resources\Moysklad;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'message' => $this->message
        ];
    }
}
