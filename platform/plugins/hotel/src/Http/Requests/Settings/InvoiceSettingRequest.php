<?php

namespace Botble\Hotel\Http\Requests\Settings;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Rules\EmailRule;
use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class InvoiceSettingRequest extends Request
{
    public function rules(): array
    {
        $googleFonts = config('core.base.general.google_fonts', []);

        $customGoogleFonts = config('core.base.general.custom_google_fonts');

        if ($customGoogleFonts) {
            $googleFonts = array_merge($googleFonts, explode(',', $customGoogleFonts));
        }

        return [
            'hotel_company_name_for_invoicing' => ['nullable', 'string', 'max:255'],
            'hotel_company_address_for_invoicing' => ['nullable', 'string', 'max:255'],
            'hotel_company_email_for_invoicing' => ['nullable', 'max:60', 'min:6', new EmailRule()],
            'hotel_company_phone_for_invoicing' => 'sometimes|' . BaseHelper::getPhoneValidationRule(),
            'hotel_company_logo_for_invoicing' => ['nullable', 'string', 'max:255'],
            'hotel_using_custom_font_for_invoice' => [new OnOffRule()],
            'hotel_invoice_support_arabic_language' => [new OnOffRule()],
            'hotel_invoice_code_prefix' => ['nullable', 'string', 'max:255'],
            'hotel_invoice_font_family' => ['nullable', 'required_if:hotel_using_custom_font_for_invoice,1', 'string', Rule::in($googleFonts)],
            'hotel_enable_invoice_stamp' => [new OnOffRule()],
        ];
    }
}
