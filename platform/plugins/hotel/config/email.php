<?php

return [
    'name' => 'plugins/hotel::booking.settings.email.title',
    'description' => 'plugins/hotel::booking.settings.email.description',
    'templates' => [
        'booking-notice-to-admin' => [
            'title' => 'plugins/hotel::booking.settings.email.templates.notice_title',
            'description' => 'plugins/hotel::booking.settings.email.templates.notice_description',
            'subject' => 'New Booking from {{ site_title }}',
            'can_off' => true,
        ],
        'booking-confirmation' => [
            'title' => 'plugins/hotel::booking.settings.email.templates.booking_success_title',
            'description' => 'plugins/hotel::booking.settings.email.templates.booking_success_description',
            'subject' => 'Booking Confirmation',
            'can_off' => true,
        ],
        'booking-status-changed' => [
            'title' => 'plugins/hotel::booking.settings.email.templates.booking_status_changed_title',
            'description' => 'plugins/hotel::booking.settings.email.templates.booking_status_changed_description',
            'subject' => 'Your Booking Has Been Updated!',
            'can_off' => true,
        ],
    ],
    'variables' => [
        'booking_name' => 'plugins/hotel::hotel.booking_name',
        'booking_email' => 'plugins/hotel::hotel.booking_email',
        'booking_phone' => 'plugins/hotel::hotel.booking_phone',
        'booking_address' => 'plugins/hotel::hotel.booking_address',
        'booking_request' => 'plugins/hotel::hotel.booking_request',
        'booking_link' => 'plugins/hotel::hotel.booking_link',
        'booking_date' => 'plugins/hotel::hotel.booking_date',
        'booking_status' => 'plugins/hotel::hotel.booking_status',
    ],
];
