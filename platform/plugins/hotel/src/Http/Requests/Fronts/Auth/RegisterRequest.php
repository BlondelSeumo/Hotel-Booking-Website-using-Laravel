<?php

namespace Botble\Hotel\Http\Requests\Fronts\Auth;

use Botble\Support\Http\Requests\Request;

class RegisterRequest extends Request
{
    public function rules(): array
    {
        return apply_filters('hotel_customer_registration_form_validation_rules', [
            'first_name' => 'required|string|max:60|min:2',
            'last_name' => 'required|string|max:60|min:2',
            'email' => 'required|max:120|min:6|email|unique:ht_customers',
            'password' => 'required|string|min:6|confirmed',
            'agree_terms_and_policy' => ['sometimes', 'accepted:1'],
        ]);
    }

    public function attributes(): array
    {
        return apply_filters('hotel_customer_registration_form_validation_attributes', [
            'first_name' => __('First name'),
            'last_name' => __('Last name'),
            'email' => __('Email'),
            'password' => __('Password'),
            'agree_terms_and_policy' => __('Term and Policy'),
        ]);
    }

    public function messages(): array
    {
        return apply_filters('hotel_customer_registration_form_validation_messages', []);
    }
}
