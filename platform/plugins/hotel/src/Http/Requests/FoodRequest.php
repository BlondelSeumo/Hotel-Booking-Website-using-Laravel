<?php

namespace Botble\Hotel\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class FoodRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:120',
            'food_type_id' => 'required|exists:ht_food_types,id',
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
