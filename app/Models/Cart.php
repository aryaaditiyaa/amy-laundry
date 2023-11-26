<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => 0,
        );
    }
}