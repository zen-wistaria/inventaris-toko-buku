<?php

namespace App\Models;

use Illuminate\Support\Number;
use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'code',
        'total_price',
        'status',
        'updatedBy',
    ];

    // protected $primaryKey = 'code';

    public function details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function formatPrice()
    {
        return Number::currency($this->attributes['total_price'], in: 'IDR', locale: 'id');
    }

    public function updateBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updatedBy', 'id');
    }
}
