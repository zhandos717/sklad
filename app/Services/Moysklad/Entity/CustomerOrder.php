<?php

declare(strict_types = 1);

namespace App\Services\Moysklad\Entity;


use AllowDynamicProperties;
use App\Services\Moysklad\JsonApiService;

class CustomerOrder
{
    public string $entity = 'customerorder';

    public JsonApiService $client;

    public function __construct(JsonApiService $jsonApiService)
    {
        $this->client = $jsonApiService;
    }

    public function content(): object | array
    {
       return $this->client
            ->setEntity($this->entity)->get('positions')->object();
    }

    public function getSumm()
    {
        return $this->request()->object()->sum;
    }
}
