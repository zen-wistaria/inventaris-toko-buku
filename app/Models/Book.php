<?php

namespace App\Models;

use Illuminate\Support\Number;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'author',
        'publisher',
        'price',
        'year',
        'synopsis',
        'stock',
        'updated_by',
    ];

    public function formatPrice()
    {
        return Number::currency($this->attributes['price'], in: 'IDR', locale: 'id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
