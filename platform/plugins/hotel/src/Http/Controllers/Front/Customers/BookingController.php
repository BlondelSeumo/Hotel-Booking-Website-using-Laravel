<?php

namespace Botble\Hotel\Http\Controllers\Front\Customers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Hotel\Facades\InvoiceHelper;
use Botble\Hotel\Models\Booking;
use Botble\Hotel\Models\Invoice;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Http\Request;

class BookingController extends BaseController
{
    public function __construct()
    {
        Theme::asset()
            ->add('customer-style', 'vendor/core/plugins/hotel/css/customer.css');

        Theme::asset()
            ->container('footer')
            ->add('utilities-js', 'vendor/core/plugins/hotel/js/utilities.js', ['jquery'])
            ->add('cropper-js', 'vendor/core/core/base/libraries/cropper.min.js', ['jquery'])
            ->add('avatar-js', 'vendor/core/plugins/hotel/js/avatar.js', ['jquery']);
    }

    public function index()
    {
        SeoHelper::setTitle(__('Bookings'));

        $bookings = Booking::query()
            ->where([
                'customer_id' => auth('customer')->id(),
            ])
            ->with('room')
            ->orderByDesc('created_at')
            ->paginate(5);

        Theme::breadcrumb()
            ->add(__('Bookings'), route('customer.bookings'));

        return Theme::scope(
            'hotel.customers.bookings.list',
            compact('bookings'),
            'plugins/hotel::themes.customers.bookings.list'
        )->render();
    }

    public function show(int|string $id)
    {
        $booking = Booking::query()
            ->with('invoice')
            ->where([
                'transaction_id' => $id,
                'customer_id' => auth('customer')->id(),
            ])
            ->firstOrFail();

        SeoHelper::setTitle(__('Booking Information'));

        Theme::breadcrumb()
            ->add(
                __('Booking Information'),
                route('customer.bookings.show', $id)
            );

        return Theme::scope(
            'hotel.customers.bookings.detail',
            compact('booking'),
            'plugins/hotel::themes.customers.bookings.detail'
        )->render();
    }

    public function getGenerateInvoice(int|string $invoiceId, Request $request)
    {
        $invoice = Invoice::query()->findOrFail($invoiceId);

        abort_unless($this->canViewInvoice($invoice), 404);

        if ($request->input('type') === 'print') {
            return InvoiceHelper::streamInvoice($invoice);
        }

        return InvoiceHelper::downloadInvoice($invoice);
    }

    protected function canViewInvoice(Invoice $invoice): bool
    {
        return auth('customer')->id() == $invoice->payment->customer_id;
    }
}
