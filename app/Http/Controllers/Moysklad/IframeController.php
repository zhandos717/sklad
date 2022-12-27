<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Http\Requests\IframeIndexRequest;
use App\Services\Moysklad\UserContextLoaderService;
use App\Services\Moysklad\VendorService;

class IframeController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(UserContextLoaderService $userContextLoaderService)
    {
        if (isset($userContextLoaderService->employee->errors)) {
            dump($userContextLoaderService->employee->errors);
        };

        return view('iframe', array_merge(
            collect($userContextLoaderService->employee)->toArray(),
            ['isAdmin' => $userContextLoaderService->isAdmin() ]
        ));
    }
}
