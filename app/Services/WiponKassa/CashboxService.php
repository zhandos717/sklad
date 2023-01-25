<?php

namespace App\Services\WiponKassa;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Ramsey\Uuid\Uuid;


class CashboxService
{

    public const  RECEIPT_TYPE_SALE = 2;
    public const  RECEIPT_TYPE_RETURN = 3;

    public const PAYMENT_TYPE_CASH = 0;
    public const PAYMENT_TYPE_CARD = 1;
    
    public function sale(array $data): array
    {
        $response = $this->httpClient()->post('api/ticket/send', $data);

        if ($response->failed()) {
            throw new Exception('Ошибка интеграции с WIPON.');
        }

        return $response->json();
    }

    private function httpClient(): PendingRequest
    {
        return Http::baseUrl('https://dev.kassa.wipon.kz/')
            ->contentType('application/json')
            ->withHeaders(['Idempotency-Key' => Uuid::uuid4()->toString()]);
    }
}
