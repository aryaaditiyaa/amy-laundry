<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionItem extends Model
{
    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => 0,
        );
    }

    protected $fillable = [
        'transaction_id',
        'product_id',
        'qty',
        'price',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
