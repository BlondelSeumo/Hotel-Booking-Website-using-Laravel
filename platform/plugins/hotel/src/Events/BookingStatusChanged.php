<?php

namespace Botble\Hotel\Events;

use Botble\Base\Events\Event;
use Botble\Hotel\Models\Booking;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingStatusChanged extends Event
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public string $oldStatus, public Booking $booking)
    {
    }
}
