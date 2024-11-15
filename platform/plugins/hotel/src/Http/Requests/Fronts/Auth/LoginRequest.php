<?php

namespace Botble\Hotel\Http\Requests\Fronts\Auth;

use Botble\Base\Rules\EmailRule;
use Botble\Support\Http\Requests\Request;

class LoginRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'email' => ['required', new EmailRule()],
            'password' => ['required', 'min:6', 'max:255'],
        ];

        return apply_filters('hotel_customer_login_form_validation_rules', $rules);
    }

    public function attributes(): array
    {
        return apply_filters('hotel_customer_login_form_validation_attributes', [
            'email' => __('Email'),
            'password' => __('Password'),
        ]);
    }

    public function messages(): array
    {
        return apply_filters('hotel_customer_login_form_validation_messages', []);
    }
}
