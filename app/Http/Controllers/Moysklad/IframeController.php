<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Http\Requests\IframeIndexRequest;
use App\Services\VendorService;

class IframeController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(IframeIndexRequest $request,VendorService $vendorService)
    {

       $contextKey =  $request->input('contextKey');

      dd(  $vendorService->context($contextKey));

        return view('iframe');
    }
}
