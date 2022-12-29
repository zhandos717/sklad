<?php

declare(strict_types=1);

namespace App\Services\Moysklad\Requests;


use App\Services\Moysklad\JsonApiService;

class CustomerOrderRequest
{
    public string $entity = 'customerorder';

    public JsonApiService $client;

    public function __construct(JsonApiService $jsonApiService)
    {
        $this->client = $jsonApiService;
    }

    public function content(): object|array
    {
        return $this->client
            ->setEntity($this->entity)->get('positions')->object();
    }

    public function getSumm()
    {
        return $this->request()->object()->sum;
    }

    private function request()
    {

    }
}
