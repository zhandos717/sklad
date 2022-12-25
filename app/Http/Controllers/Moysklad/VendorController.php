<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Http\Resources\Moysklad\EndpointResource;
use App\Http\Resources\Moysklad\VendorResource;
use App\Models\MoySkladConfig;
use App\Services\Moysklad\MoySkladService;
use App\Services\Moysklad\VendorService;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    public function store(
        $version,
        $appId,
        $accountId,
        Request $request
    ): VendorResource {
        $moySklad = MoySkladConfig::updateOrCreate(
            [
                'access_token' => $request->get('access')[0]['access_token'],
                'status' => MoySkladConfig::SETTINGS_REQUIRED
            ], [
                'app_id' => $appId,
                'account_id' => $accountId,
            ]
        );

        return new VendorResource([
            'status' => $moySklad->status
        ]);
    }

    public function destroy(
        $version,
        $appId,
        $accountId
    ) {

        $moySklad = MoySkladConfig::updateOrCreate(
            [
                'status' => MoySkladConfig::DELETED
            ], [
                'app_id' => $appId,
                'account_id' => $accountId,
            ]
        );

        return new VendorResource([
            'status' => $moySklad->status
        ]);
    }
}
