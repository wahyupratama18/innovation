<?php

namespace App\Models;

use App\Actions\Others\{MoneyFormat, QR};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Support\Facades\Hash;

class Account extends Model
{
    use HasFactory,
        MoneyFormat,
        QR,
        SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'transaction_password'
    ],

    $casts = [
        'id' => 'string'
    ],

    $hidden = [
        'transaction_password'
    ],
    
    $appends = [
        'balance_format',
        'qr'
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

    public function getBalanceFormatAttribute(): string
    {
        return $this->formatter($this->balance);
    }

    public function getQrAttribute(): string
    {
        $string = $this->plainQR();

        return $this->svg(
            $string.$this->configureData('10', hash('crc32b', $string))
        );
    }
    
    /* QR Attributes */
    private const VERSION = '01',
        TYPE = [
            'static' => '11',
            'dynamic' => '12'
        ];

    private function plainQR(): string
    {
        return $this->configureData('00', self::VERSION)
        .$this->configureData('01', self::TYPE['static'])
        .$this->configureData('02', $this->id)
        .$this->configureData('03', $this->user->name);
    }

    public function updatePass(string $pass): void
    {
        $this->forceFill([
            'transaction_password' => Hash::make($pass)
        ])->save();
    }
}
