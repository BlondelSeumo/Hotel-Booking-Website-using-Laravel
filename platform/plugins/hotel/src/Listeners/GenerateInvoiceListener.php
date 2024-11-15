<?php

namespace Botble\Hotel\Listeners;

use Botble\Hotel\Events\BookingCreated;
use Botble\Hotel\Supports\InvoiceHelper;

class GenerateInvoiceListener
{
    public function handle(BookingCreated $event): void
    {
        (new InvoiceHelper())->store($event->booking);
    }
}
