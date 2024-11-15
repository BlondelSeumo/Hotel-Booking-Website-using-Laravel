<?php

namespace Botble\Hotel\Forms\Fronts\Auth;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Forms\FieldOptions\HtmlFieldOption;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\FormAbstract;
use Botble\Theme\Facades\Theme;

abstract class AuthForm extends FormAbstract
{
    public function setup(): void
    {
        Theme::asset()->add('auth-css', 'vendor/core/plugins/hotel/css/front-auth.css');

        $this
            ->contentOnly()
            ->template('plugins/hotel::forms.auth');
    }

    public function submitButton(
        string $label,
        ?string $icon = null,
        string $iconPosition = 'append',
        bool $isWrapped = true,
        string $wrapperClass = 'd-grid',
        array $attributes = []
    ): static {
        $icon = $icon ? BaseHelper::renderIcon($icon) : '';
        $label = $icon ? ($iconPosition === 'prepend' ? $icon . ' ' . $label : $label . ' ' . $icon) : $label;

        return $this
            ->when(
                $isWrapped,
                fn ($form)
                => $form->add(
                    'openButtonWrap',
                    HtmlField::class,
                    HtmlFieldOption::make()
                        ->content(sprintf('<div class="%s">', $wrapperClass))
                        ->toArray()
                )
            )
            ->add('submit', 'submit', [
                'label' => $label,
                'attr' => [
                    'class' => 'btn btn-primary btn-auth-submit',
                    ...$attributes,
                ],
            ])
            ->when(
                $isWrapped,
                fn ($form)
                => $form->add(
                    'closeButtonWrap',
                    HtmlField::class,
                    HtmlFieldOption::make()
                        ->content('</div>')
                        ->toArray()
                )
            );
    }

    public function banner(string $banner): static
    {
        return $this->setFormOption('banner', $banner);
    }

    public function icon(string $icon): static
    {
        return $this->setFormOption('icon', $icon);
    }

    public function heading(string $heading): static
    {
        return $this->setFormOption('heading', $heading);
    }

    public function description(string $description): static
    {
        return $this->setFormOption('description', $description);
    }
}
