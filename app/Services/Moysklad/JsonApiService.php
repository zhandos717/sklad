<?php

namespace App\Services\Moysklad;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

class JsonApiService extends ClientService
{
    private string $accessToken;

    private string $entity;
    private string $objectId;

    public PromiseInterface | Response $response;

    public function __construct(string $accessToken, $objectId)
    {
        $this->accessToken = $accessToken;
        $this->objectId = $objectId;
    }

    public function stores(): PromiseInterface | Response
    {
        return $this->send(
            'GET',
            '/entity/store',
            $this->accessToken
        );
    }

    public function setEntity(string $entity): self
    {
        $this->entity = $entity;

        return $this;
    }

    public function get(?string $options = null): PromiseInterface | Response
    {
        return $this->request($options);
    }

    private function request(?string $options, string $method = 'GET')
    {
        return $this->response = $this->send(
            $method,
            "/entity/$this->entity/$this->objectId".($options ? '/'.$options : ''),
            $this->accessToken
        );
    }


    public function setObject($objectId): self
    {
        $this->objectId = $objectId;

        return $this;
    }

    protected function baseUrl(): string
    {
        return config('moysklad.json_api_endpoint_url');
    }
}
