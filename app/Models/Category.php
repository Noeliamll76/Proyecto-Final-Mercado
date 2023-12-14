<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'guild_id',
        'description',
        'image',
    ];

   
    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function store(): BelongsToMany
    {
        return $this->belongsToMany(Store::class, 'products');
    }

    public function guild(): BelongsTo
    {
        return $this->belongsTo(Guild::class);
    }
}
