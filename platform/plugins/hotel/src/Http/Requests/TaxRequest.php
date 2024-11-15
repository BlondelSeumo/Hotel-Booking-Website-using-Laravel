<?php

namespace Botble\Hotel\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class TaxRequest extends Request
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'percentage' => ['required', 'numeric', 'between:0,99.99'],
            'priority' => ['required', 'numeric', 'min:0'],
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
