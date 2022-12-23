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
            'appUid' => $request->get('appUid'),
            'method' => $request->method()
        ]);

        //"input":{"appUid":"tis.turmukhambetov","accountName":"zhan96",
        //"access":[
        //{"resource":"https://online.moysklad.ru/api/remap/1.2/",
        //"scope":["admin"],"permissions":null,
        //"access_token":"141d7f6c598ca22db658bf4e23a581e42d2b79f9"}],
        //"cause":"Install"}}

//        info('end', request()->all());

        return view('descriptor-xml');
    }

}
