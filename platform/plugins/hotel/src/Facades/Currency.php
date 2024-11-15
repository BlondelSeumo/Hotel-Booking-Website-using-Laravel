<?php

namespace Botble\Hotel\Facades;

use Botble\Hotel\Supports\CurrencySupport;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void setApplicationCurrency(\Botble\Hotel\Models\Currency $currency)
 * @method static \Botble\Hotel\Models\Currency|null getApplicationCurrency()
 * @method static \Botble\Hotel\Models\Currency|null getDefaultCurrency()
 * @method static \Illuminate\Support\Collection currencies()
 * @method static string|null detectedCurrencyCode()
 * @method static array countryCurrencies()
 * @method static array currencyCodes()
 *
 * @see \Botble\Hotel\Supports\CurrencySupport
 */
class Currency extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CurrencySupport::class;
    }
}
