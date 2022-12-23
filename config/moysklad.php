<?php

return [
    'secret_key' => env('MOY_SKLAD_TOKEN'),
    'app_id' => env('MOY_SKLAD_APPID'),
    'app_uid' => env('MOY_SKLAD_APPUID'),
    'app_base_url' => env('MOY_SKLAD_URL'),
    'vendor_api_endpoint_url'=>'https://online.moysklad.ru/api/vendor/1.0',
    'json_api_endpoint_url'=>'https://online.moysklad.ru/api/remap/1.2'
];
