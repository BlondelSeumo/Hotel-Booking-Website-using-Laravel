<?php

namespace Botble\Hotel\Http\Requests\Settings;

use Botble\Base\Rules\OnOffRule;
use Botble\Hotel\Facades\Currency;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class CurrencySettingRequest extends Request
{
    public function prepareForValidation(): void
    {
        $this->merge([
            'currencies_data' => json_decode($this->input('currencies'), true),
        ]);
    }

    public function rules(): array
    {
        return [
            'currencies' => ['nullable', 'string', 'max:10000'],
            'deleted_currencies' => ['nullable', 'string', 'max:10000'],
            'currencies_data.*.title' => ['required', 'string', Rule::in(Currency::currencyCodes())],
            'currencies_data.*.symbol' => ['required', 'string'],
            'hotel_enable_auto_detect_visitor_currency' => [new OnOffRule()],
            'hotel_add_space_between_price_and_currency' => [new OnOffRule()],
            'hotel_thousands_separator' => ['required', 'string', Rule::in([',', '.', 'space'])],
        ];
    }

    public function messages(): array
    {
        return [
            'currencies_data.*.title.in' => trans('plugins/hotel::currency.invalid_currency_name', [
                'currencies' => implode(', ', Currency::currencyCodes()),
            ]),
        ];
    }

    public function attributes(): array
    {
        return [
            'currencies_data.*.title' => trans('plugins/hotel::currency.invalid_currency_name'),
            'currencies_data.*.symbol' => trans('plugins/hotel::currency.symbol'),
        ];
    }
}
