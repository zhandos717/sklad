<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPayment
 */
class Payment extends Model
{

    protected $fillable = [
        'method',
        'sum',
        'sale_id',
    ];

    public function sale()
    {
        return $this->hasOne(Sale::class);
    }
}
