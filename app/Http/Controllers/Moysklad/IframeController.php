<?php

namespace App\Http\Controllers\Moysklad;

use App\Http\Controllers\Controller;

class IframeController extends Controller
{

    public function index(\Request $request,VendorService $vendorService)
    {

        info((string)$request->all());

        $contextKey = $request->get('contextKey');

        $employee = vendorApi()->context($contextKey);

        $uid = $employee->uid;
        $fio = $employee->shortFio;
        $accountId = $employee->accountId;

        $isAdmin = $employee->permissions->admin->view;

        return view('iframe');
    }

}
