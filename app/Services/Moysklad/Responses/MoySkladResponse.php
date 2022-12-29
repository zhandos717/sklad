<?php

namespace App\Services\Moysklad\Responses;

interface MoySkladResponse
{
    public function parse(object $response);
}
