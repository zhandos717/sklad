<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Services\VendorService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    public function endpoint(
        $version,
        $appId,
        $accountId,
        Request $request,
        VendorService $vendorService
    ): Factory|View|Application {

        dd($appId,$accountId);

        info('data', [
            'access_token' => $request->get('access'),
            'appUid' => $request->get('appUid'),
            'method' => $request->method()
        ]);

        return view('descriptor-xml');
    }

}
