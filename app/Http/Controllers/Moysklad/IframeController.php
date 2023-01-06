<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Services\Moysklad\UserContextLoaderService;

class IframeController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(UserContextLoaderService $userContextLoaderService)
    {
        return view(
            'iframe',
            array_merge(
                collect($userContextLoaderService->employee)->toArray(),
                ['isAdmin' => $userContextLoaderService->isAdmin()]
            )
        );
    }
}
