<?php

namespace App\Services;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class VendorService
{

    /**
     * @throws \Exception
     */
    function context(string $contextKey): PromiseInterface|Response
    {
        return $this->request('POST', '/context/' . $contextKey);
    }

    function updateAppStatus(string $appId, string $accountId, string $status): PromiseInterface|Response
    {
        return $this->request(
            'PUT',
            "/apps/$appId/$accountId/status",
            "{\"status\": \"$status\"}"
        );
    }

    /**
     * @throws \Exception
     */
    private function request(
        string $method,
        $path,
        $body = null
    ): PromiseInterface|Response {
        return Http::send(
            $method,
            config('moysklad.vendor_api_endpoint_url') . $path,
            [
                'header' => ['Authorization: Bearer ' . buildJWT(),
                    "Content-type: application/json"],
                'body' => $body
            ]
        );
    }

}
