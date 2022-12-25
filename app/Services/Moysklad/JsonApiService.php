<?php

namespace App\Services\Moysklad;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class JsonApiService extends ClientService
{

    private $accessToken;

    function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    function stores()
    {
        return $this->send(
            'GET',
            '/entity/store',
            $this->accessToken
        );
    }

    function getObject($entity, $objectId)
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
