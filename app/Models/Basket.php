<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Basket extends Model

{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'user_coment',
        'total',
        'deadline',
        'shift',

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'order');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}