<?php

namespace Botble\Hotel\Listeners;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\EmailHandler;
use Botble\Hotel\Events\BookingStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendStatusChangedNotificationListener implements ShouldQueue
{
    public function handle(BookingStatusChanged $event): void
    {
        $booking = $event->booking;

        EmailHandler::setModule(HOTEL_MODULE_SCREEN_NAME)
            ->setVariableValues([
                'booking_name' => $booking->address->first_name ? $booking->address->first_name . ' ' . $booking->address->last_name : 'N/A',
                'booking_date' => BaseHelper::formatDateTime($booking->created_at),
                'booking_status' => $booking->status->label(),
                'booking_link' => route('public.booking.information', $booking->transaction_id),
            ])
            ->sendUsingTemplate('booking-status-changed', $booking->address->email);
    }
}
