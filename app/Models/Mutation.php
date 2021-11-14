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
        if ($this->id) {
            $string = $this->getReferenceAttribute();

            return $this->svg(
                $string.$this->configureData('10', hash('crc32b', $string))
            );
        }
        
        return null;
    }

    public function getAmountFormatAttribute(): string
    {
        return $this->formatter($this->amount);
    }

    public function getBalanceFormatAttribute(): string
    {
        return $this->formatter($this->balance);
    }

    /* QR Attributes */
    private const VERSION = '01',
        TYPE_ID = [
            0 => '13', // credits
            1 => '14' // debits
        ], DYNAMIC = '12';

    public function plainQR(): string
    {
        return $this->configureData('00', self::VERSION)
        .$this->configureData('01', $this->status ? self::TYPE_ID[$this->type] : self::DYNAMIC)
        .$this->configureData('02', $this->id)
        .$this->configureData('03', $this->account->user->name)
        .$this->configureData('04', $this->amount);
    }
}