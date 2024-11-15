<?php

use Botble\Widget\AbstractWidget;
use Illuminate\Support\Arr;

class ContactInformationMenuWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Contact information'),
            'description' => __('Contact information'),
            'phone_number' => null,
            'email' => null,
            'address' => null,
        ]);
    }

    protected function data(): array
    {
        $config = $this->getConfig();

        $phoneNumber =  nl2br(Arr::get($config, 'phone_number'));
        $email = nl2br(Arr::get($config, 'email'));
        $address = nl2br(Arr::get($config, 'address'));

        return compact('phoneNumber', 'email', 'address');
    }
}
