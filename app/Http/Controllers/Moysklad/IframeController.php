<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;
use App\Services\VendorService;
use Illuminate\Http\Request;

class IframeController extends Controller
{

    public function index(Request $request,VendorService $vendorService)
    {

        dd(1);
//        $contextKey = $request->get('contextKey');
//
//        $employee = vendorApi()->context($contextKey);
//
//        $uid = $employee->uid;
//        $fio = $employee->shortFio;
//        $accountId = $employee->accountId;
//
//        $isAdmin = $employee->permissions->admin->view;

        return view('iframe');
    }

}
