<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingsRequest;
use App\Models\MoySkladConfig;
use App\Services\Moysklad\VendorService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function updateSettings(UpdateSettingsRequest $request, VendorService $vendorService)
    {

        $moySklad = MoySkladConfig::updateOrCreate(
            [
                'access_token' => isset($request->get('access')[0]['access_token']) ? $request->get(
                    'access'
                )[0]['access_token'] : null,

                'status'       => MoySkladConfig::ACTIVATED,
                'info_message' => $request->input('infoMessage'),
                'store'        => $request->input('store')
            ], [
                'app_id'     => $request->input('appId'),
                'account_id' => $request->input('accountId'),
            ]
        );

        $vendorService->updateAppStatus(
            config('moysklad.app_id'),
            $moySklad->account_id,
            $moySklad->status
        );

        echo 'Настройки обновлены, перезагрузите приложение';
    }

}
