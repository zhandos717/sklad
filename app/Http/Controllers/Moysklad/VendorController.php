<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    public function endpoint(Request $request): Factory|View|Application
    {
        info('data', [
            'access_token' => $request->get('access.access_token'),
            'appUid' => $request->get('appUid')
        ]);


        //[2022-12-23 18:00:05] local.INFO: info
        // {"url":"/vendor-endpoint/api/moysklad/vendor/1.0/apps/7b9b82f5-4f27-4e25-bc55-6f8717ff66c7/e0be3639-7d4c-11ed-0a80-07f300006563",
        //"input":{"appUid":"tis.turmukhambetov","accountName":"zhan96",
        //"access":[
        //{"resource":"https://online.moysklad.ru/api/remap/1.2/",
        //"scope":["admin"],"permissions":null,
        //"access_token":"141d7f6c598ca22db658bf4e23a581e42d2b79f9"}],
        //"cause":"Install"}}

        info('end', request()->all());

        return view('descriptor-xml');
    }

}
