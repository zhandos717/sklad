<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingsRequest;
use App\Http\Resources\Moysklad\SettingResource;
use App\Models\MoySkladConfig;
use App\Services\Moysklad\VendorService;

class SettingController extends Controller
{
    public function update(UpdateSettingsRequest $request, VendorService $vendorService)
    {

        $moySklad = MoySkladConfig::updateOrCreate(
            [
                'app_id'     => $request->input('appId'),
                'account_id' => $request->input('accountId'),
                'prosklad_token' => $request->input('tis_token'),
            ],
            [
                'access_token' => isset($request->get('access')[0]['access_token']) ? $request->get(
                    'access'
                )[0]['access_token'] : null,

                'status'       => MoySkladConfig::ACTIVATED,
                'info_message' => $request->input('infoMessage'),
                'store'        => $request->input('store')
            ],
        );

        $vendorService->updateAppStatus(config('moysklad.app_id'), $moySklad->account_id,
            $moySklad->status
        );

        return new SettingResource(new class{
            public string $message = 'Настройки успешно обновлены!';
        });
    }
}
