<?php

namespace App\Models;

use App\Actions\Others\{MoneyFormat, QR};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mutation extends Model
{
    use HasFactory,
        MoneyFormat,
        QR;

    protected $fillable = [
        'account_id',
        'name',
        'type',
        'amount',
        'status',
        'user_id',
    ],
    
    $appends = [
        'reference',
        'type_read',
        'qr',
        'amount_format',
        'balance_format',
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

    public function getReferenceAttribute(): ?string
    {
        return $this->id
        ? date('Ymd', strtotime($this->updated_at)).str_pad($this->id, 4, "0", STR_PAD_LEFT)
        : null;
    }

    public function getQrAttribute(): ?string
    {
        return $this->id ?
        $this->svg($this->getReferenceAttribute()) :
        null;
    }

    public function getAmountFormatAttribute(): string
    {
        return $this->formatter($this->amount);
    }

    public function getBalanceFormatAttribute(): string
    {
        return $this->formatter($this->balance);
    }
}