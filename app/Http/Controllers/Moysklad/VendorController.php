<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Http\Resources\Moysklad\EndpointResource;
use App\Services\MoySkladService;
use App\Services\VendorService;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    public function endpoint(
        $version,
        $appId,
        $accountId,
        Request $request,
        VendorService $vendorService
    ) {

        info('data', [
            'access_token' => $request->get('access'),
            'appUid' => $request->get('appUid'),
            'method' => $request->method()
        ]);

        $app = MoySkladService::load($appId, $accountId);

        if (!$app->getStatusName()) {
            $app->accessToken = $request->get('access')[0]['access_token'];
            $app->status = MoySkladService::SETTINGS_REQUIRED;
            $app->persist();
        }

        return new EndpointResource([
            'status' => $app->getStatusName()
        ]);
    }

}
