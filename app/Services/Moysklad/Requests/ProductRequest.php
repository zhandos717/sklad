<?php

declare(strict_types=1);

namespace App\Services\Moysklad\Requests;

use App\Services\Moysklad\JsonApiService;

#https://online.moysklad.ru/api/remap/1.2/entity/product/675b8231-805c-11ed-0a80-05d600116427
class ProductRequest
{
    private string $entity = 'product';

    private JsonApiService $client;

    private $objectId;

    public function __construct(JsonApiService $jsonApiService)
    {
        $this->client = $jsonApiService->setEntity($this->entity);
    }


    public function setObject($objectId)
    {
        $this->objectId = $objectId;
        return $this;
    }

    public function content(): object|array
    {
        return $this->client
            ->setObject($this->objectId)->get()->object();
    }

    public function setPath(string $path):self
    {
        return $this;
    }
}
