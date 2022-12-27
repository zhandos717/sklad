<?php

namespace App\Services\Moysklad;

use Exception;
use Firebase\JWT\JWT;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Request;

class VendorService extends ClientService
{
    /**
     * @throws Exception
     */
    function context(string $contextKey): PromiseInterface|Response
    {
        return $this->send(Request::METHOD_POST, '/context/' . $contextKey, $this->buildJWT());
    }

    /**
     * @throws Exception
     */
    function updateAppStatus(string $appId, string $accountId, string $status): PromiseInterface|Response
    {
        return $this->send(
            Request::METHOD_PUT,
            "/apps/$appId/$accountId/status",
            $this->buildJWT(),
            ['status' => $status]
        );
    }

    protected function baseUrl(): string
    {
        return config('moysklad.vendor_api_endpoint_url');
    }
}
