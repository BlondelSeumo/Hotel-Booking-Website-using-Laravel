<?php

use Carbon\Carbon;

app()->booted(function () {
    theme_option()
        ->setField([
            'id' => 'breadcrumb_background_image',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'mediaImage',
            'label' => __('Breadcrumb background image'),
            'attributes' => [
                'name' => 'breadcrumb_background_image',
            ],
        ])
        ->setField([
            'id' => 'copyright',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'text',
            'label' => __('Copyright'),
            'attributes' => [
                'name' => 'copyright',
                'value' => __('© :year Your Company. All right reserved.', ['year' => Carbon::now()->format('Y')]),
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => __('Change copyright'),
                    'data-counter' => 250,
                ],
            ],
            'helper' => __('Copyright on footer of site'),
        ])
        ->setField([
            'id' => 'heading_font',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'googleFonts',
            'label' => __('Heading font'),
            'attributes' => [
                'name' => 'heading_font',
                'value' => 'Jost',
            ],
        ])
        ->setField([
            'id' => 'primary_font',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'googleFonts',
            'label' => __('Primary font'),
            'attributes' => [
                'name' => 'primary_font',
                'value' => 'Jost',
            ],
        ])
        ->setField([
            'id' => 'primary_color',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'customColor',
            'label' => __('Primary color'),
            'attributes' => [
                'name' => 'primary_color',
                'value' => '#644222',
            ],
        ])
        ->setField([
            'id' => 'secondary_color',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'customColor',
            'label' => __('Secondary color'),
            'attributes' => [
                'name' => 'secondary_color',
                'value' => '#be9874',
            ],
        ])
        ->setField([
            'id' => 'input_border_color',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'customColor',
            'label' => __('Input border color'),
            'attributes' => [
                'name' => 'input_border_color',
                'value' => '#d7cfc8',
            ],
        ])
        ->setField([
            'id' => 'primary_color_hover',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'customColor',
            'label' => __('Button hover color'),
            'attributes' => [
                'name' => 'primary_color_hover',
                'value' => '#2e1913',
            ],
        ])
        ->setField([
            'id' => 'button_text_color_hover',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'customColor',
            'label' => __('Button hover text color'),
            'attributes' => [
                'name' => 'button_text_color_hover',
                'value' => '#2e1913',
            ],
        ])
        ->setSection([
            'title' => __('Header'),
            'desc' => __('Header config'),
            'id' => 'opt-text-subsection-header',
            'subsection' => true,
            'icon' => 'ti ti-link',
        ])
        ->setField([
            'id' => 'header_top_enabled',
            'section_id' => 'opt-text-subsection-header',
            'type' => 'customSelect',
            'label' => __('Enable header top'),
            'attributes' => [
                'name' => 'header_top_enabled',
                'list' => [
                    0 => trans('core/base::base.no'),
                    1 => trans('core/base::base.yes'),
                ],
                'value' => 1,
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ])
        ->setField([
            'id' => 'header_button_label',
            'section_id' => 'opt-text-subsection-header',
            'type' => 'text',
            'label' => __('Header button label'),
            'attributes' => [
                'name' => 'header_button_label',
                'value' => __('Get a quote'),
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ])
        ->setField([
            'id' => 'header_button_url',
            'section_id' => 'opt-text-subsection-header',
            'type' => 'text',
            'label' => __('Header button URL'),
            'attributes' => [
                'name' => 'header_button_url',
                'value' => '/request-a-quote',
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ])
        ->setField([
            'id' => 'opening_hours',
            'section_id' => 'opt-text-subsection-header',
            'type' => 'text',
            'label' => __('Opening hours'),
            'attributes' => [
                'name' => 'opening_hours',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ])
        ->setSection([
            'title' => __('Contact'),
            'desc' => __('Contact information.'),
            'id' => 'opt-text-subsection-contact',
            'subsection' => true,
            'icon' => 'ti ti-mail',
            'fields' => [
                [
                    'id' => 'hotline',
                    'type' => 'text',
                    'label' => __('Phone number'),
                    'attributes' => [
                        'name' => 'hotline',
                        'value' => null,
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => __('Enter phone number'),
                        ],
                    ],
                ],
                [
                    'id' => 'contact_email',
                    'type' => 'email',
                    'label' => __('Email'),
                    'attributes' => [
                        'name' => 'email',
                        'value' => null,
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => __('Enter email address'),
                        ],
                    ],
                ],
                [
                    'id' => 'address',
                    'type' => 'textarea',
                    'label' => __('Address'),
                    'attributes' => [
                        'name' => 'address',
                        'value' => null,
                        'options' => [
                            'rows' => 2,
                            'class' => 'form-control',
                            'placeholder' => __('Enter location address'),
                        ],
                    ],
                ],
            ],
        ])
        ->setSection([
            'title' => __('Social Links'),
            'desc' => __('Social Links at the footer.'),
            'id' => 'opt-text-subsection-social-links',
            'subsection' => true,
            'icon' => 'ti ti-share',
            'fields' => [
                [
                    'id' => 'social_links',
                    'type' => 'repeater',
                    'label' => __('Social Links'),
                    'attributes' => [
                        'name' => 'social_links',
                        'value' => null,
                        'fields' => [
                            [
                                'type' => 'text',
                                'label' => __('Name'),
                                'attributes' => [
                                    'name' => 'name',
                                    'value' => null,
                                    'options' => [
                                        'class' => 'form-control',
                                    ],
                                ],
                            ],
                            [
                                'type' => 'themeIcon',
                                'label' => __('Icon'),
                                'attributes' => [
                                    'name' => 'social-icon',
                                    'value' => null,
                                    'options' => [
                                        'class' => 'form-control',
                                    ],
                                ],
                            ],
                            [
                                'type' => 'text',
                                'label' => __('URL'),
                                'attributes' => [
                                    'name' => 'url',
                                    'value' => null,
                                    'options' => [
                                        'class' => 'form-control',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ])
        ->setField([
            'id' => 'background_footer',
            'section_id' => 'opt-text-subsection-page',
            'type' => 'mediaImage',
            'label' => __('Background footer'),
            'attributes' => [
                'name' => 'background_footer',
            ],
        ])
        ->setSection([
            'title' => __('Galleries'),
            'desc' => __('Galleries config'),
            'id' => 'opt-text-subsection-galleries',
            'subsection' => true,
            'icon' => 'ti ti-camera',
        ])
        ->setField([
            'id' => 'galleries_limit_images',
            'section_id' => 'opt-text-subsection-galleries',
            'type' => 'number',
            'label' => __('Galleries limit images'),
            'attributes' => [
                'name' => 'galleries_limit_images',
                'value' => 1,
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ])
        ->setSection([
            'title' => __('Hotel'),
            'desc' => __('Hotel config'),
            'id' => 'opt-text-subsection-hotel',
            'subsection' => true,
            'icon' => 'ti ti-building',
        ])
        ->setField([
            'id' => 'authentication_login_background_image',
            'section_id' => 'opt-text-subsection-hotel',
            'type' => 'mediaImage',
            'label' => __('Authentication login background image'),
            'attributes' => [
                'name' => 'authentication_login_background_image',
            ],
        ])
        ->setField([
            'id' => 'authentication_register_background_image',
            'section_id' => 'opt-text-subsection-hotel',
            'type' => 'mediaImage',
            'label' => __('Authentication register background image'),
            'attributes' => [
                'name' => 'authentication_register_background_image',
            ],
        ])
        ->setField([
            'id' => 'authentication_forgot_password_background_image',
            'section_id' => 'opt-text-subsection-hotel',
            'type' => 'mediaImage',
            'label' => __('Authentication forgot background image'),
            'attributes' => [
                'name' => 'authentication_forgot_password_background_image',
            ],
        ])
        ->setField([
            'id' => 'authentication_reset_password_background_image',
            'section_id' => 'opt-text-subsection-hotel',
            'type' => 'mediaImage',
            'label' => __('Authentication reset background image'),
            'attributes' => [
                'name' => 'authentication_reset_password_background_image',
            ],
        ])
        ->setField([
            'id' => 'hotel_rules',
            'section_id' => 'opt-text-subsection-hotel',
            'type' => 'editor',
            'label' => __('Hotel rules'),
            'attributes' => [
                'name' => 'hotel_rules',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'rows' => 3,
                ],
            ],
        ])->setField([
            'id' => 'cancellation',
            'section_id' => 'opt-text-subsection-hotel',
            'type' => 'editor',
            'label' => __('Cancellation'),
            'attributes' => [
                'name' => 'cancellation',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'rows' => 3,
                ],
            ],
        ])
        ->setField([
            'id' => 'blog_sidebar_enabled',
            'section_id' => 'opt-text-subsection-blog',
            'type' => 'customSelect',
            'label' => __('Enable blog sidebar?'),
            'attributes' => [
                'name' => 'blog_sidebar_enabled',
                'list' => [
                    0 => trans('core/base::base.no'),
                    1 => trans('core/base::base.yes'),
                ],
                'value' => 1,
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ])
        ->setField([
            'id' => 'number_of_post_per_row',
            'section_id' => 'opt-text-subsection-blog',
            'type' => 'customSelect',
            'label' => __('Number of post pre row'),
            'attributes' => [
                'name' => 'number_of_post_per_row',
                'list' => [
                    1 => __(':number Item', ['number' => 1]),
                    2 => __(':number Items', ['number' => 2]),
                    3 => __(':number Items', ['number' => 3]),
                ],
                'value' => 2,
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ])
        ->setField([
            'id' => 'header_sticky_enabled',
            'section_id' => 'opt-text-subsection-header',
            'type' => 'customSelect',
            'label' => __('Enable header sticky?'),
            'attributes' => [
                'name' => 'header_sticky_enabled',
                'list' => [
                    'yes' => __('Yes'),
                    'no' => __('No'),
                ],
                'value' => 'yes',
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ])
        ->setField([
            'id' => '404_page_image',
            'section_id' => 'opt-text-subsection-page',
            'type' => 'mediaImage',
            'label' => __('404 page image'),
            'attributes' => [
                'name' => '404_page_image',
                'value' => '',
            ],
        ])
        ->setField([
            'id' => 'preloader_enabled',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'customSelect',
            'label' => __('Enable Preloader?'),
            'attributes' => [
                'name' => 'preloader_enabled',
                'list' => [
                    'yes' => trans('core/base::base.yes'),
                    'no' => trans('core/base::base.no'),
                ],
                'value' => 'yes',
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ])
        ->setField([
            'id' => 'preloader_version',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'customSelect',
            'label' => __('Preloader Version?'),
            'attributes' => [
                'name' => 'preloader_version',
                'list' => [
                    'v1' => 'V1',
                    'v2' => 'V2',
                ],
                'value' => 'v2',
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ]);
});
