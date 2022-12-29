<?php

namespace App\Services\Moysklad\Responses;

class CustomerOrderResponse implements MoySkladResponse
{
    public string $id;
    public string $quantity;
    public string $price;
    public string $vat;
    public string $discount;

    public object $assortment;

    public function parse(object $response)
    {
        $order = array_shift($response->rows);

        if ($order->id) {
            $this->id = $order->id;
            $this->quantity = $order->quantity;
            $this->price = $order->price;
            $this->discount = $order->discount;
            $this->vat = $order->vat;
            $this->assortment = $order->assortment->meta;
        }
    }

    public function success()
    {
        return isset($this->id);
    }

}

