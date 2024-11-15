<?php

use Botble\Hotel\Facades\HotelHelper;

if (! function_exists('get_hotel_setting')) {
    /**
     * @deprecated Use HotelHelper::getSetting() instead.
     */
    function get_hotel_setting(string $key, bool|int|string|null $default = ''): array|int|string|null
    {
        return HotelHelper::getSetting($key, $default);
    }
}
