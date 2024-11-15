<?php

namespace Botble\Hotel\Http\Requests\Settings;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;

class ReviewSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'hotel_enable_review_room' => [new OnOffRule()],
            'hotel_reviews_per_page' => ['required', 'numeric', 'min:1', 'max:100'],
        ];
    }
}
