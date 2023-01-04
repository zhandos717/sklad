<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperItem
 */
class Item extends Model
{

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'discount',
        'kgd_code',
        'sale_id',
        'compare_field',
    ];

    protected $casts = [
        'compare_field' => 'array',
    ];


    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
