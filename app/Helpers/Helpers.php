<?php

namespace App\Helpers;

use App\Models\CurrencyRate;

class Helpers
{
    /**
     * UZS narxni foydalanuvchi tanlagan valyutaga o‘giradi.
     *
     * @param  float|int  $priceUZS
     * @return float
     */
    public static function convertPrice($priceUZS): float
    {
        // Sessiyadan tanlangan valyutani olamiz, default UZS
        $currency = session('currency', 'UZS');

        // Agar tanlangan valyuta UZS bo‘lsa, konvertatsiya shart emas
        if ($currency === 'UZS') {
            return $priceUZS;
        }

        // So‘nggi kursni olamiz
        $rate = CurrencyRate::where('base', 'UZS')->latest()->first();
        $rates = $rate?->rates ?? [];

        // Agar kerakli valyuta kursi topilsa, ko‘paytirib qaytaramiz
        return isset($rates[$currency])
            ? $priceUZS * (float) $rates[$currency]
            : $priceUZS;
    }
}
