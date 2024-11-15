<?php

namespace Botble\Hotel\Http\Controllers\Settings;

use Botble\Base\Facades\Assets;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Hotel\Http\Requests\Settings\InvoiceTemplateSettingRequest;
use Botble\Hotel\Supports\InvoiceHelper;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class InvoiceTemplateSettingController extends BaseController
{
    public function edit(InvoiceHelper $invoiceHelper)
    {
        $this->pageTitle(trans('plugins/hotel::settings.invoice_template.title'));

        Assets::addScriptsDirectly('vendor/core/core/setting/js/email-template.js');

        $content = $invoiceHelper->getInvoiceTemplate();
        $variables = $invoiceHelper->getVariables();

        return view('plugins/hotel::invoices.template', compact('content', 'variables'));
    }

    public function update(InvoiceTemplateSettingRequest $request, BaseHttpResponse $response): BaseHttpResponse
    {
        BaseHelper::saveFileData(storage_path('app/templates/invoice.tpl'), $request->input('content'), false);

        return $response->withUpdatedSuccessMessage();
    }

    public function reset(BaseHttpResponse $response): BaseHttpResponse
    {
        File::delete(storage_path('app/templates/invoice.tpl'));

        return $response->setMessage(trans('core/setting::setting.email.reset_success'));
    }

    public function preview(InvoiceHelper $invoiceHelper): Response
    {
        $invoice = $invoiceHelper->getDataForPreview();

        return $invoiceHelper->streamInvoice($invoice);
    }
}
