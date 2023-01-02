<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use App\Http\Resources\Moysklad\SettingResource;
use App\Models\MoySkladConfig;
use App\Services\Moysklad\VendorService;

class SettingController extends Controller
{
    public function update(SettingsRequest $request, VendorService $vendorService)
    {
        MoySkladConfig::updateOrCreate(
            [
                'app_id'     => config('moysklad.app_id'),
                'account_id' => $request->input('account_id'),
                'tis_token'  => $request->input('tis_token'),
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

        $moySklad = MoySkladConfig::whereAccountId($request->input('account_id'))->first();

        $vendorService->updateAppStatus(
            config('moysklad.app_id'),
            $moySklad->account_id,
            $moySklad->status
        );

        return new SettingResource(
            new class {
                public string $message = 'Настройки успешно обновлены!';
            }
        );
    }
}
