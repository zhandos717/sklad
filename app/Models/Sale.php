<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSale
 */
class Sale extends Model
{

    protected $fillable = [
        'price',
        'type',
        'fiscal_receipt',
        'moy_sklad_config_id'
    ];

    public function items()
    {
        return $this->hasOne(Item::class);
    }
    public function moySkladConfig()
    {
        return $this->hasOne(Item::class);
    }
}
