<?php

namespace App\Services\Moysklad;

use Exception;
use Firebase\JWT\JWT;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class ClientService
{
    /**
     * @param string $method
     * @param string $path
     * @param string $token
     * @param string|array|null $body
     * @return PromiseInterface|Response
     * @throws Exception
     */
    protected function send(
        string $method,
        string $path,
        string $token,
        string|array $body = null
    ) {
        try {
            $response =  Http::baseUrl($this->baseUrl())
                ->contentType('application/json')
                ->withToken($token)
                ->send(
                    $method,
                    $path,
                    [
                        'body' => json_encode($body)
                    ]
                );

            if($response->failed()){
                throw new Exception('Ошибка авторизации');
            }

            return $response;

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }


    }

    abstract protected function baseUrl();

    /**
     * @return string
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
