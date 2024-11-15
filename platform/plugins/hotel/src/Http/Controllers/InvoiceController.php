<?php

namespace Botble\Hotel\Http\Controllers;

use Botble\Base\Facades\Assets;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Hotel\Facades\InvoiceHelper;
use Botble\Hotel\Models\Invoice;
use Botble\Hotel\Tables\InvoiceTable;
use Illuminate\Http\Request;

class InvoiceController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans('plugins/hotel::booking.name'))
            ->add(trans('plugins/hotel::invoice.name'), route('invoices.index'));
    }

    public function index(InvoiceTable $table)
    {
        $this->pageTitle(trans('plugins/hotel::invoice.name'));

        Assets::addScripts(['bootstrap-editable'])
            ->addStyles(['bootstrap-editable']);

        return $table->renderTable();
    }

    public function show(Invoice $invoice)
    {
        $this->pageTitle(trans('plugins/hotel::invoice.show', ['code' => $invoice->code]));

        return view('plugins/hotel::invoices.show', compact('invoice'));
    }

    public function destroy(Invoice $invoice)
    {
        return DeleteResourceAction::make($invoice);
    }

    public function getGenerateInvoice(int|string $id, Request $request)
    {
        $invoice = Invoice::query()->findOrFail($id);

        if ($request->input('type') === 'print') {
            return InvoiceHelper::streamInvoice($invoice);
        }

        return InvoiceHelper::downloadInvoice($invoice);
    }
}
