<?php

namespace App\Services\Moysklad;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Symfony\Component\HttpFoundation\Request;

class VendorService extends ClientService
{
    /**
     * @throws Exception
     */
    public function context(string $contextKey): PromiseInterface | Response
    {
        return $this->send(Request::METHOD_POST, '/context/' . $contextKey, $this->buildJWT());
    }

    /**
     * @throws Exception
     */
    public function updateAppStatus(string $appId, string $accountId, string $status): PromiseInterface | Response
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
