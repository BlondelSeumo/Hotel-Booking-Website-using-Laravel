<?php

namespace Botble\Hotel\Http\Requests;

use Botble\Base\Facades\BaseHelper;
use Botble\Hotel\Facades\HotelHelper;
use Botble\Support\Http\Requests\Request;

class CheckoutRequest extends Request
{
    public function rules(): array
    {
        $dateFormat = HotelHelper::getDateFormat();

        return [
            'room_id' => ['required', 'exists:ht_rooms,id'],
            'start_date' => ['required', 'string', 'date_format:' . $dateFormat, 'after_or_equal:today'],
            'end_date' => ['required', 'string', 'date_format:' . $dateFormat, 'after_or_equal:start_date'],
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:120'],
            'phone' => ['required', ...explode('|', BaseHelper::getPhoneValidationRule())],
            'number_of_guests' => [
                'nullable',
                'integer',
                'min:' . HotelHelper::getMinimumNumberOfGuests(),
                'max:' . HotelHelper::getMaximumNumberOfGuests(),
            ],
            'number_of_children' => ['nullable', 'integer', 'min:0'],
            'rooms' => ['nullable', 'integer', 'min:1'],
            'zip' => ['nullable', 'string', 'max:10'],
            'address' => ['nullable', 'string', 'max:400'],
            'arrival_time' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:60'],
            'state' => ['nullable', 'string', 'max:60'],
            'country' => ['nullable', 'string', 'max:60'],
            'requests' => ['nullable', 'string', 'max:10000'],
            'services' => ['nullable', 'array'],
            'terms_conditions' => ['accepted:1'],
            'register_customer' => ['nullable'],
            'password' => ['nullable', 'required_if:register_customer,1', 'min:6'],
            'password_confirm' => ['nullable', 'required_if:register_customer,1', 'same:password'],
        ];
    }
}
