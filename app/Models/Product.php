<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'image',
        'unit',
        'price',
        'description',
    ];

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
