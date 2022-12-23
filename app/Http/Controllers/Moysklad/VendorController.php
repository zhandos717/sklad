<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;

class VendorController extends Controller
{

    public function endpoint()
    {

        info('end',request()->all());

        return view('descriptor-xml');
    }

}
