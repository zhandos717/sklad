<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperMoySkladConfig
 */
class MoySkladConfig extends Model
{

    public const UNKNOWN = 0;
    public const SETTINGS_REQUIRED = 1;
    public const DELETED = 2;
    public const ACTIVATED = 100;

    protected $fillable = [
        'app_id',
        'account_id',
        'info_message',
        'store',
        'access_token',
        'status',
        'prosklad_token'
    ];
}
