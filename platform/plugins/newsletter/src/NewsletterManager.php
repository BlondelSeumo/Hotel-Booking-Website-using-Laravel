<?php

namespace Botble\Newsletter;

use Botble\Base\Facades\AdminHelper;
use Botble\Base\Forms\FieldOptions\CheckboxFieldOption;
use Botble\Base\Forms\FieldOptions\EmailFieldOption;
use Botble\Base\Forms\Fields\CheckboxField;
use Botble\Base\Forms\Fields\EmailField;
use Botble\Newsletter\Contracts\Factory;
use Botble\Newsletter\Drivers\MailChimp;
use Botble\Newsletter\Drivers\SendGrid;
use Botble\Newsletter\Forms\Fronts\NewsletterForm;
use Botble\Theme\Events\RenderingThemeOptionSettings;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Facades\ThemeOption;
use Botble\Theme\ThemeOption\Fields\MediaImageField;
use Botble\Theme\ThemeOption\Fields\MultiCheckListField;
use Botble\Theme\ThemeOption\Fields\NumberField;
use Botble\Theme\ThemeOption\Fields\TextareaField;
use Botble\Theme\ThemeOption\Fields\TextField;
use Botble\Theme\ThemeOption\Fields\ToggleField;
use Botble\Theme\ThemeOption\ThemeOptionSection;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Manager;
use InvalidArgumentException;

class NewsletterManager extends Manager implements Factory
{
    protected function createMailChimpDriver(): MailChimp
    {
        return new MailChimp(
            setting('newsletter_mailchimp_api_key'),
            setting('newsletter_mailchimp_list_id')
        );
    }

    protected function createSendGridDriver(): SendGrid
    {
        return new SendGrid(
            setting('newsletter_sendgrid_api_key'),
            setting('newsletter_sendgrid_list_id')
        );
    }

    public function getDefaultDriver(): string
    {
        throw new InvalidArgumentException('No email marketing provider was specified.');
    }

    public function registerNewsletterPopup(bool $keepHtmlDomOnClose = false): void
    {
        app('events')->listen(RenderingThemeOptionSettings::class, function () {
            ThemeOption::setSection(
                ThemeOptionSection::make('opt-text-subsection-newsletter-popup')
                    ->title(__('Newsletter Popup'))
                    ->icon('ti ti-mail-opened')
                    ->fields([
                        ToggleField::make()
                            ->name('newsletter_popup_enable')
                            ->label(__('Enable Newsletter Popup')),
                        MediaImageField::make()
                            ->name('newsletter_popup_image')
                            ->label(__('Popup Image')),
                        TextField::make()
                            ->name('newsletter_popup_title')
                            ->label(__('Popup Title')),
                        TextField::make()
                            ->name('newsletter_popup_subtitle')
                            ->label(__('Popup Subtitle')),
                        TextareaField::make()
                            ->name('newsletter_popup_description')
                            ->label(__('Popup Description')),
                        NumberField::make()
                            ->name('newsletter_popup_delay')
                            ->label(__('Popup Delay (seconds)'))
                            ->defaultValue(5)
                            ->helperText(__('Set the delay time to show the popup after the page is loaded. Set 0 to show the popup immediately.'))
                            ->attributes([
                                'min' => 0,
                            ]),
                        MultiCheckListField::make()
                            ->name('newsletter_popup_display_pages')
                            ->label(__('Display on pages'))
                            ->inline()
                            ->defaultValue(['homepage'])
                            ->options(apply_filters('newsletter_popup_display_pages', [
                                'public.index' => __('Homepage'),
                                'all' => __('All Pages'),
                            ])),
                    ])
            );
        });

        app('events')->listen(RouteMatched::class, function () use ($keepHtmlDomOnClose) {
            if (
                is_plugin_active('newsletter')
                && theme_option('newsletter_popup_enable', false)
                && ($keepHtmlDomOnClose || ! isset($_COOKIE['newsletter_popup']))
                && ! AdminHelper::isInAdmin()
            ) {
                $displayPages = json_decode(theme_option('newsletter_popup_display_pages', '[]'), true) ?: ['public.index'];

                if (
                    ! in_array('all', $displayPages)
                    && ! in_array(Route::currentRouteName(), $displayPages)
                ) {
                    return;
                }

                $ignoredBots = [
                    'googlebot', // Googlebot
                    'bingbot', // Microsoft Bingbot
                    'slurp', // Yahoo! Slurp
                    'ia_archiver', // Alexa
                    'Chrome-Lighthouse', // Google Lighthouse
                ];

                if (in_array(strtolower(request()->userAgent()), $ignoredBots)) {
                    return;
                }

                Theme::asset()
                    ->add('newsletter', asset('vendor/core/plugins/newsletter/css/newsletter.css'));

                Theme::asset()
                    ->container('footer')
                    ->add('newsletter', asset('vendor/core/plugins/newsletter/js/newsletter.js'), ['jquery']);

                add_filter(THEME_FRONT_BODY, function (?string $html): string {
                    $newsletterForm = NewsletterForm::create()
                        ->remove(['wrapper_before', 'wrapper_after', 'email'])
                        ->addBefore(
                            'submit',
                            'email',
                            EmailField::class,
                            EmailFieldOption::make()
                                ->label(__('Email Address'))
                                ->maxLength(-1)
                                ->placeholder(__('Enter Your Email'))
                                ->required()
                        )
                        ->addAfter(
                            'submit',
                            'dont_show_again',
                            CheckboxField::class,
                            CheckboxFieldOption::make()
                                ->label(__("Don't show this popup again"))
                                ->value(false)
                        );

                    return $html . view('plugins/newsletter::partials.newsletter-popup', compact('newsletterForm'));
                });
            }
        });
    }
}
