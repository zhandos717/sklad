<?php

declare(strict_types = 1);

namespace App\Services\Moysklad\Entity;

use App\Services\Moysklad\JsonApiService;

class Product
{
    private string $entity = 'product';

    private JsonApiService $client;
    private $objectId;

    public function __construct(JsonApiService $jsonApiService)
    {
        $this->client = $jsonApiService->setEntity($this->entity);
    }

    public function content(): object | array
    {
        return $this->client
            ->setObject($this->objectId)->get()->object();
    }

    public function setObject($objectId)
    {
        $this->objectId = $objectId;
        return $this;
    }

}
