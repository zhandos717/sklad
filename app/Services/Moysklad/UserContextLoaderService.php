<?php

namespace App\Services\Moysklad;

use Exception;

class UserContextLoaderService
{

    public array|object $employee;

    /**
     * @param $contextKey
     * @throws Exception
     */
    public function __construct($contextKey)
    {
        $this->employee = app(VendorService::class)->context($contextKey)->object();
    }

    public function isAdmin()
    {
        return $this->employee->permissions->admin->view ?? null;
    }

}
