<?php
namespace App\Actions\Others;

/**
 * 
 */
trait MoneyFormat
{
    private function formatter($money): string
    {
        return 'Rp'.number_format($money, 2, ',', '.');
    }
}
