<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use App\Http\Requests\UpdateSettingsRequest;
use App\Http\Resources\Moysklad\MessageResource;
use App\Http\Resources\Moysklad\VendorResource;
use App\Models\MoySkladConfig;
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

    public function update(UpdateSettingsRequest $request, VendorService $vendorService)
    {
        $moySklad = MoySkladConfig::whereAccountId($request->input('account_id'))->first();

        if (is_null($moySklad)) {
            return new MessageResource(
                new class {
                    public string $type = 'error';
                    public string $message = 'Аккаунт не найден!';
                }
            );
        }

        $moySklad->tis_token = $request->input('tis_token');
        $moySklad->status = MoySkladConfig::ACTIVATED;

        $vendorService->updateAppStatus(
            config('moysklad.app_id'),
            $moySklad->account_id,
            $moySklad->status
        );

        return new MessageResource(
            new class {
                public string $type = 'success';
                public string $message = 'Настройки успешно обновлены!';
            }
        );
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
