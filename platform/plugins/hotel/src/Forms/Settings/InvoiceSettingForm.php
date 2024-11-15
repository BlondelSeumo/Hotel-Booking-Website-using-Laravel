<?php

namespace Botble\Hotel\Forms\Settings;

use Botble\Base\Forms\FieldOptions\RadioFieldOption;
use Botble\Base\Forms\Fields\GoogleFontsField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\RadioField;
use Botble\Hotel\Http\Requests\Settings\InvoiceSettingRequest;
use Botble\Hotel\Supports\InvoiceHelper;
use Botble\Setting\Forms\SettingForm;

class InvoiceSettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->setSectionTitle(trans('plugins/hotel::settings.invoice_template.title'))
            ->setSectionDescription(trans('plugins/hotel::settings.invoice_template.description'))
            ->setValidatorClass(InvoiceSettingRequest::class)
            ->addCustomField('googleFonts', GoogleFontsField::class)
            ->add('hotel_company_name_for_invoicing', 'text', [
                'label' => trans('plugins/hotel::settings.invoicing.company_name'),
                'value' => setting('hotel_company_name_for_invoicing', theme_option('site_title')),
            ])
            ->add('hotel_company_address_for_invoicing', 'text', [
                'label' => trans('plugins/hotel::settings.invoicing.company_address'),
                'value' => setting('hotel_company_address_for_invoicing'),
            ])
            ->add('hotel_company_email_for_invoicing', 'text', [
                'label' => trans('plugins/hotel::settings.invoicing.company_email'),
                'value' => setting('hotel_company_email_for_invoicing', get_admin_email()->first()),
            ])
            ->add('hotel_company_phone_for_invoicing', 'text', [
                'label' => trans('plugins/hotel::settings.invoicing.company_phone'),
                'value' => setting('hotel_company_phone_for_invoicing'),
            ])
            ->add('hotel_company_logo_for_invoicing', MediaImageField::class, [
                'label' => trans('plugins/hotel::settings.invoicing.company_logo'),
                'value' => setting('hotel_company_logo_for_invoicing') ?: theme_option('logo'),
                'allow_thumb' => false,
            ])
            ->add('hotel_using_custom_font_for_invoice', 'onOffCheckbox', [
                'label' => trans('plugins/hotel::settings.using_custom_font_for_invoice'),
                'value' => setting('hotel_using_custom_font_for_invoice', false),
                'attr' => [
                    'data-bb-toggle' => 'collapse',
                    'data-bb-target' => '.custom-font-settings',
                ],
            ])
            ->add('open_fieldset_custom_font_settings', 'html', [
                'html' => sprintf(
                    '<fieldset class="form-fieldset custom-font-settings" style="display: %s;" data-bb-value="1">',
                    setting('hotel_using_custom_font_for_invoice', false) ? 'block' : 'none'
                ),
            ])
            ->add('hotel_invoice_font_family', 'googleFonts', [
                'label' => trans('plugins/hotel::settings.invoice_font_family'),
                'selected' => setting('hotel_invoice_font_family'),
            ])
            ->add('close_fieldset_custom_font_settings', 'html', [
                'html' => '</fieldset>',
            ])
            ->add('hotel_invoice_support_arabic_language', 'onOffCheckbox', [
                'label' => trans('plugins/hotel::settings.invoice_support_arabic_language'),
                'value' => setting('hotel_invoice_support_arabic_language', false),
            ])
            ->add('hotel_enable_invoice_stamp', 'onOffCheckbox', [
                'label' => trans('plugins/hotel::settings.enable_invoice_stamp'),
                'value' => setting('hotel_enable_invoice_stamp', true),
            ])
            ->add('hotel_invoice_code_prefix', 'text', [
                'label' => trans('plugins/hotel::settings.invoice_code_prefix'),
                'value' => setting('hotel_invoice_code_prefix', 'INV-'),
            ])
            ->add(
                'invoice_language_support',
                RadioField::class,
                RadioFieldOption::make()
                    ->label(trans('plugins/hotel::settings.invoice.add_language_support'))
                    ->choices([
                        'default' => trans('plugins/hotel::settings.invoice.only_latin_languages'),
                        'arabic' => 'Arabic',
                        'bangladesh' => 'Bangladesh',
                        'chinese' => 'Chinese',
                    ])
                    ->defaultValue('default')
                    ->when(
                        (new InvoiceHelper())->getLanguageSupport(),
                        function (RadioFieldOption $option, string $language) {
                            $option->selected($language);
                        }
                    )
                    ->colspan(6)
                    ->toArray()
            );
    }
}
