<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    const STATUS_UNPAID = 'unpaid';
    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    protected $fillable = [
        'user_id',
        'code',
        'status',
        'proof_of_payment',
        'payment_method',
        'payment_description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function history(): HasMany
    {
        return $this->hasMany(TransactionHistory::class)->latest();
    }

    public function latestHistory(): HasOne
    {
        return $this->hasOne(TransactionHistory::class)->latestOfMany();
    }
}
