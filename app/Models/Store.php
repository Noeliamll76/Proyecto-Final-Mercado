<?php

namespace App\Models;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Console\ViewClearCommand;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Store extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'owner',
        'location',
        'guild_id',
        'is_active',
        'image',
        'description',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function type(): BelongsToMany
    {
        return $this->belongsToMany(Type::class,'products');
    }
    
    public function guild(): BelongsTo
    {
        return $this->belongsTo(Guild::class);
    }
}