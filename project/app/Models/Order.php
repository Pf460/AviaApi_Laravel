<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['id', 'user_id', 'total_price', 'created_at'])]
class Order extends Model
{
    protected $casts = [
        'created_at' => 'datetime',
        'total_price' => 'float'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
