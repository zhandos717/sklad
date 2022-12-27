<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Http\Resources\Moysklad\VendorResource;
use App\Models\MoySkladConfig;
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
                'app_id'     => $appId,
                'account_id' => $accountId,
            ],
            [
                'access_token' => $request->get('access')[0]['access_token'],
                'status'       => MoySkladConfig::SETTINGS_REQUIRED
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
                'app_id'     => $appId,
                'account_id' => $accountId,
            ],
            [
                'status' => MoySkladConfig::DELETED
            ]
        );

        return new VendorResource([
            'status' => $moySklad->status
        ]);
    }
}
