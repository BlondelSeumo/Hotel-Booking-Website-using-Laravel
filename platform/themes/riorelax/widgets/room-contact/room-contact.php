<?php

use Botble\Widget\AbstractWidget;

class RoomContactWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Room contact.'),
            'description' => __('Room contact'),
            'title' => __('Room contact'),
            'phone' => __('Phone number'),
        ]);
    }
}
