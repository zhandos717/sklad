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


    public const STATUS_TYPES = [
        1 => 'SettingsRequired',
        100 => 'Activated',
    ];

    protected $fillable = [
        'app_id',
        'account_id',
        'info_message',
        'store',
        'access_token',
        'status',
        'tis_token'
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
