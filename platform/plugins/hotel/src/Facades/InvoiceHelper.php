<?php

namespace Botble\Hotel\Facades;

use Botble\Hotel\Supports\InvoiceHelper as BaseInvoiceHelper;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Botble\Hotel\Models\Invoice store(\Botble\Hotel\Models\Booking $booking)
 * @method static array getVariables()
 * @method static \Botble\Hotel\Models\Invoice getDataForPreview()
 * @method static \Illuminate\Http\Response downloadInvoice($invoice)
 * @method static \Illuminate\Http\Response streamInvoice(\Botble\Hotel\Models\Invoice $invoice)
 * @method static \Barryvdh\DomPDF\PDF makeInvoice(\Botble\Hotel\Models\Invoice $invoice)
 * @method static string getInvoiceTemplate()
 * @method static string getInvoiceTemplatePath()
 * @method static string getInvoiceTemplateCustomizedPath()
 * @method static string getLanguageSupport()
 *
 * @see \Botble\Hotel\Supports\InvoiceHelper
 */
class InvoiceHelper extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return BaseInvoiceHelper::class;
    }
}
