<?php

namespace Botble\Hotel\Http\Requests;

use Botble\Support\Http\Requests\Request;

class RoomUpdateOrderByRequest extends Request
{
    public function rules(): array
    {
        return [
            'value' => 'required|numeric',
        ];
    }
}
