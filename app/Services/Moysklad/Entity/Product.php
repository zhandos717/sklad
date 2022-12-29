<?php

namespace App\Services\Moysklad\Entity;

class Product
{
    public string $name;

    public string $description;

    public string $code;
    public string $price;

    public function __construct($name, $description, $code, $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->code = $code;
        $this->price = $price;
    }
}

