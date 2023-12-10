<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'store_id',
        'caliber',
        'variety',
        'origin',
        'prince',
        'product_image',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function baskets(): BelongsToMany
    {
        return $this->belongsToMany(Basket::class,'order');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
