<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Hotel\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('customers');

        Customer::query()->truncate();

        for ($i = 0; $i < 10; $i++) {
            $customers[] = [
                'first_name' => $this->fake()->firstName(),
                'last_name' => $this->fake()->lastName(),
                'email' => $this->fake()->safeEmail(),
                'phone' => $this->fake()->e164PhoneNumber(),
                'password' => Hash::make('12345678'),
                'avatar' => sprintf('customers/%d.jpg', $i + 1),
            ];
        }

        $customers[] = [
            'first_name' => $this->fake()->firstName(),
            'last_name' => $this->fake()->lastName(),
            'email' => 'customer@archielite.com',
            'phone' => $this->fake()->e164PhoneNumber(),
            'password' => Hash::make('12345678'),
            'avatar' => sprintf('customers/%d.jpg', rand(1, 10)),
        ];

        foreach ($customers as $customer) {
            Customer::query()->create($customer);
        }
    }
}
