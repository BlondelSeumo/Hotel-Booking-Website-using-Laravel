<?php

use Botble\Base\Forms\FieldOptions\ButtonFieldOption;
use Botble\Newsletter\Forms\Fronts\NewsletterForm;
use Botble\Widget\AbstractWidget;

class NewsletterWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Subscribe to Newsletter.'),
            'description' => __('Subscribe to get latest updates and information.'),
            'title' => __('Subscribe To Our Newsletter'),
        ]);
    }

    public function data(): array
    {
        if (! is_plugin_active('newsletter')) {
            return [];
        }

        $form = NewsletterForm::create()
            ->remove('submit')
            ->add(
                'submit',
                'submit',
                ButtonFieldOption::make()
                    ->label('<i class="fas fa-location-arrow"></i>')
                    ->cssClass('btn header-btn')
                    ->toArray(),
            );

        return compact('form');
    }
}
