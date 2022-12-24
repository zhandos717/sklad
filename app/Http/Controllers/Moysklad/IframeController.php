<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Services\VendorService;
use Illuminate\Http\Request;

class IframeController extends Controller
{
    public function index(Request $request,VendorService $vendorService)
    {

        return view('iframe');
    }
}
