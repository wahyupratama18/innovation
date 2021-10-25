<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id'
    ];

    /**
     * Get the user that owns the Account
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the mutations for the Account
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mutations(): HasMany
    {
        return $this->hasMany(Mutation::class);
    }
}
