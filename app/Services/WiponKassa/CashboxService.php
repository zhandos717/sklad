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

    /**
     * https://gist.github.com/Dualse/ae7757a82a20e3429b78b2a46be44832
     * @param array $data {
     * "token": "Fzwrt1llIt977svFjL3GGa9lVlUq8c",
     * "type": 2,
     * "items": [
     * {
     * "name": "Яблочный сок",
     * "price": 950,
     * "quantity": 1,
     * "discount": 50,
     * "kgd_code": 796,
     * "compare_field": {
     * "type": "barcode",
     * "value": "apple-juice"
     * }
     * }
     * ],
     * "payments": [
     * {
     * "payment_method": 0,
     * "sum": 1000
     * }
     * ]
     * }
     * @return string {
     * "data": {
     * "id": 666,
     * "created_at": "2022-07-30T14:37:29.000000Z",
     * "ticket_type": "Продажа",
     * "receipt_number": "1659191849",
     * "total_sum": 900,
     * "change": 50,
     * "link": "http://localhost/links/check/dac7ad15-197f-48e1-894a-41c91f7731e7",
     * "items": [
     * {
     * "name": "Яблочный сок",
     * "price": 950,
     * "quantity": "1.000",
     * "discount": 50,
     * "sum": 900
     * }
     * ],
     * "payments": [
     * {
     * "payment_method": 0,
     * "sum": 1520
     * }
     * ]
     * }
     * }
     *
     * @throws Exception
     */
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
