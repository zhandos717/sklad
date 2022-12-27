<?php

namespace App\Services\Moysklad;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class JsonApiService extends ClientService
{
    private $accessToken;

    public function setToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    public function stores(): PromiseInterface | Response
    {
        return $this->send(
            'GET',
            '/entity/store',
            $this->accessToken
        );
    }

    public function getItem($entity, $objectId): PromiseInterface | Response
    {
        return $this->send(
            'GET',
            "/entity/$entity/$objectId",
            $this->accessToken
        );
    }

    protected function baseUrl(): string
    {
        return config('moysklad.json_api_endpoint_url');
    }
}
