<?php

namespace Botble\Hotel\Facades;

use Botble\Hotel\Supports\HotelSupport;
use Illuminate\Support\Facades\Facade;

/**
 * @method static bool isEnableEmailVerification()
 * @method static string|null getSettingPrefix()
 * @method static bool isReviewEnabled()
 * @method static bool isBookingEnabled()
 * @method static array getReviewExtraData()
 * @method static array|string|int|null getSetting(string $key, string|int|bool|null $default = '')
 * @method static bool loadCountriesStatesCitiesFromPluginLocation()
 * @method static string viewPath(string $view)
 * @method static array getRoomFilters(\Illuminate\Http\Request|array $request)
 * @method static array getRoomBookingParams()
 * @method static mixed|null getCheckoutData(string|null $key = null)
 * @method static void saveCheckoutData(array $data)
 * @method static string getDateFormat()
 * @method static string getBookingFormDateFormat()
 * @method static \Carbon\Carbon|false dateFromRequest(string $date)
 * @method static array getDateRangeInReport(\Illuminate\Http\Request $request)
 * @method static int getMinimumNumberOfGuests()
 * @method static int getMaximumNumberOfGuests()
 * @method static string getBookingNumber(string|int $id)
 *
 * @see \Botble\Hotel\Supports\HotelSupport
 */
class HotelHelper extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return HotelSupport::class;
    }
}
