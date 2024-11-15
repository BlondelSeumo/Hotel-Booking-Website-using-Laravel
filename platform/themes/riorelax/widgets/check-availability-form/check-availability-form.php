<?php

use Botble\Widget\AbstractWidget;

class CheckAvailabilityForm extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Check Availability'),
            'description' => __('Check Availability'),
            'title' => null,
        ]);
    }
}
