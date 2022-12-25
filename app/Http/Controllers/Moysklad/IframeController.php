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
    public function index(IframeIndexRequest $request, VendorService $vendorService)
    {
        $contextKey = $request->input('contextKey');

        $content = $vendorService->context($contextKey)->json();

       // dd($content);

        //if (isset($content['errors'])) {
          //  dump($content);
        //}

        return view('iframe', $content);
    }
}
