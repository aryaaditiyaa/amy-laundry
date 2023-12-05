<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => 0,
        );
    }

    protected $fillable = [
        'user_id',
        'code',
        'status',
        'proof_of_payment',
        'payment_method',
        'payment_description',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }
}
