<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mutation extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'name',
        'type',
        'amount',
        'status',
        'user_id',
    ],
    
    $appends = [
        'type_read'
    ];

    private const TYPES = ['Kredit', 'Debet'];

    /**
     * Get the account that owns the Mutation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Get the recorder that owns the Mutation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recorder(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTypeReadAttribute(): ?string
    {
        return $this->type ? self::TYPES[$this->type] : null;
    }
}
