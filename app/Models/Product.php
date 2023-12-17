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
        'category_id',
        'store_id',
        'name',
        'variety',
        'origin',
        'price',
        'image_id',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function image_product(): BelongsTo
    {
        return $this->belongsTo(Image_product::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'orders');
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
