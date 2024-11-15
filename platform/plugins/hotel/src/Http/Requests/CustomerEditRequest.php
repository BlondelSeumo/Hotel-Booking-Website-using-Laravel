<?php

namespace Botble\Hotel\Http\Requests;

use Botble\Base\Facades\BaseHelper;
use Botble\Support\Http\Requests\Request;

class CustomerEditRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'first_name' => ['required', 'max:60', 'min:2'],
            'last_name' => ['required', 'max:60', 'min:2'],
            'email' => 'required|max:60|min:6|email|unique:ht_customers,email,' . $this->route('customer.id'),
            'phone' => ['nullable', 'string', ...explode('|', BaseHelper::getPhoneValidationRule())],
        ];

        if ($this->boolean('is_change_password')) {
            $rules['password'] = 'required|string|min:6';
            $rules['password_confirmation'] = 'required|same:password';
        }

        return $rules;
    }
}
