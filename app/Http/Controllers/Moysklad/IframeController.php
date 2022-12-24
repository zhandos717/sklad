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

        if (isset($content['errors'])) {
            dd($content);
        }


        return view('iframe', $content)->withHeaders('X-Frame-Options', 'SAMEORIGIN');
    }
}
