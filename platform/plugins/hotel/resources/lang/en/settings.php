<?php

return [
    'hotel' => 'Hotel',
    'invoicing' => [
        'company_name' => 'Company name',
        'company_address' => 'Company address',
        'company_email' => 'Company email',
        'company_phone' => 'Company phone',
        'company_logo' => 'Company logo',
    ],
    'using_custom_font_for_invoice' => 'Using custom font for invoice?',
    'invoice_font_family' => 'Invoice font family (Only work for Latin language)',
    'enable_invoice_stamp' => 'Enable invoice stamp?',
    'invoice_support_arabic_language' => 'Support Arabic language in invoice?',
    'invoice_code_prefix' => 'Invoice code prefix',
    'invoice_settings' => 'Invoice',
    'invoice_settings_description' => 'Settings Invoice information for invoicing',
    'general' => [
        'title' => 'General',
        'description' => 'General settings for Hotel',
        'enable_booking' => 'Enable booking?',
        'maximum_number_of_guests' => 'Maximum number of guests',
        'minimum_number_of_guests' => 'Minimum number of guests',
        'booking_number_format' => [
            'title' => 'Booking Number Format (optional)',
            'description' => 'The default booking number starts at a specific number. You can customize the starting and ending numbers for the booking number. For example, the booking number will be displayed as #:format.',
            'start_with' => 'Starting Number',
            'end_with' => 'Ending Number',
        ],
    ],
    'review' => [
        'title' => 'Reviews',
        'description' => 'Review settings for Hotel',
        'enable_review_room' => 'Enable review?',
        'reviews_per_page' => 'Number of reviews per page?',
    ],
    'currency' => [
        'title' => 'Currencies',
        'description' => 'List of currencies using on website',
    ],
    'invoice' => [
        'title' => 'Invoices',
        'description' => 'Settings Invoice information for invoicing',
        'add_language_support' => 'Add language support',
        'only_latin_languages' => 'Only Latin languages',
        'confirm_reset' => 'Confirm reset invoice template?',
        'confirm_message' => 'Do you really want to reset this invoice template to default?',
        'continue' => 'Continue',
    ],
    'invoice_template' => [
        'title' => 'Invoice Template',
        'description' => 'Settings for Invoice template',
    ],
];
