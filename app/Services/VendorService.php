<?php

namespace App\Services;

use Exception;
use Firebase\JWT\JWT;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class VendorService
{

    /**
     * @throws Exception
     */
    function context(string $contextKey): PromiseInterface|Response
    {
        return $this->send('POST', '/context/' . $contextKey);
    }

    function updateAppStatus(string $appId, string $accountId, string $status): PromiseInterface|Response
    {
        return $this->send(
            'PUT',
            "/apps/$appId/$accountId/status",
            "{\"status\": \"$status\"}"
        );
    }

    /**
     * @throws Exception
     */
    private function send(
        string $method,
        $path,
        $body = null
    ): PromiseInterface|Response {
        return Http::baseUrl(config('moysklad.vendor_api_endpoint_url'))
            ->contentType('application/json')
            ->withToken($this->buildJWT())
            ->send(
                $method,
                $path,
                [
                    'body' => $body
                ]
            );
    }

    /**
     * @throws Exception
     */
    private function buildJWT(): string
    {
        $token = [
            "sub" => config('moysklad.app_uid'),
            "iat" => time(),
            "exp" => time() + 300,
            "jti" => bin2hex(random_bytes(32))
        ];

        return JWT::encode($token, config('moysklad.secret_key'), 'HS256');
    }

}
