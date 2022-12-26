<?php

namespace App\Services\Moysklad;

class UserContextLoaderService
{

    public $employee;
    /**
     * @throws \Exception
     */
    public function __construct($contextKey)
    {
       $this->employee = app(VendorService::class)->context($contextKey)->object();
    }

    public function isAdmin(){
        return $this->employee->permissions->admin->view ?? null;
    }

}
