<?php

namespace Botble\Hotel\Http\Requests\Settings;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;

class GeneralSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'hotel_enable_booking' => [new OnOffRule()],
            'hotel_minimum_number_of_guests' => ['nullable', 'integer', 'min:1', 'lt:hotel_maximum_number_of_guests'],
            'hotel_maximum_number_of_guests' => ['nullable', 'integer', 'min:1', 'gt:hotel_minimum_number_of_guests'],
            'hotel_booking_number_prefix' => ['nullable', 'string', 'max:120'],
            'hotel_booking_number_suffix' => ['nullable', 'string', 'max:120'],
        ];
    }
}
