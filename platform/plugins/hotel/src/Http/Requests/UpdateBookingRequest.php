<?php

namespace Botble\Hotel\Http\Requests;

use Botble\Hotel\Enums\BookingStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class UpdateBookingRequest extends Request
{
    public function rules(): array
    {
        return [
            'status' => Rule::in(BookingStatusEnum::values()),
        ];
    }
}
