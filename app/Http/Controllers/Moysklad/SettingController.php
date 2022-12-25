<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Services\Moysklad\MoySkladService;
use App\Services\Moysklad\VendorService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function updateSettings(Request $request, VendorService $vendorService)
    {
        $accountId = $request->input('accountId');
        $infoMessage = $request->input('infoMessage');
        $store = $request->input('store');

        $app = MoySkladService::loadApp($accountId);
        $app->infoMessage = $infoMessage;
        $app->store = $store;

        $notify = $app->status != MoySkladService::ACTIVATED;

        $app->status = MoySkladService::ACTIVATED;

        $vendorService->updateAppStatus(
            config('moysklad.app_id'),
            $accountId,
            $app->getStatusName()
        );

        $app->persist();

        echo 'Настройки обновлены, перезагрузите приложение';
    }

}
