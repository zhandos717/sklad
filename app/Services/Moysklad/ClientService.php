<?php

namespace App\Services\Moysklad;

use Exception;
use Firebase\JWT\JWT;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class ClientService
{

    protected function send(
        string $method,
        string $path,
        string $token,
        string|array $body = null
    ): PromiseInterface|Response {
        return Http::baseUrl(config('moysklad.vendor_api_endpoint_url'))
            ->contentType('application/json')
            ->withToken($token)
            ->send(
                $method,
                $path,
                [
                    'body' => json_encode($body)
                ]
            );
    }

    abstract protected function baseUrl();

    /**
     * @throws Exception
     */
    protected function buildJWT(): string
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
