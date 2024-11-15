<?php

namespace Botble\Hotel\Events;

use Botble\Base\Events\Event;
use Botble\Hotel\Models\Booking;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingCreated extends Event
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public Booking $booking)
    {
    }
}
