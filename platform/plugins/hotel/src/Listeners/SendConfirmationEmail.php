<?php

namespace Botble\Hotel\Listeners;

use Botble\Base\Facades\EmailHandler;
use Botble\Hotel\Events\BookingCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendConfirmationEmail implements ShouldQueue
{
    public function handle(BookingCreated $event): void
    {
        $booking = $event->booking;

        $address = '';

        if ($booking->address->id) {
            if ($booking->address->address) {
                $address .= $booking->address->address . ', ';
            }

            if ($booking->address->city) {
                $address .= $booking->address->city . ', ';
            }

            if ($booking->address->state) {
                $address .= $booking->address->state . ', ';
            }

            if ($booking->address->country) {
                $address .= $booking->address->country . ', ';
            }

            if ($booking->address->zip) {
                $address .= $booking->address->zip;
            }
        } else {
            $address = 'N/A';
        }

        $address = rtrim($address, ', ');

        EmailHandler::setModule(HOTEL_MODULE_SCREEN_NAME)
            ->setVariableValues([
                'booking_name' => $booking->address->first_name ? $booking->address->first_name . ' ' . $booking->address->last_name : 'N/A',
                'booking_email' => $booking->address->email ?? 'N/A',
                'booking_phone' => $booking->address->phone ?? 'N/A',
                'booking_address' => $address,
                'booking_request' => $booking->requests,
                'booking_link' => route('public.booking.information', $booking->transaction_id),
            ]);

        EmailHandler::sendUsingTemplate('booking-confirmation', $booking->address->email);
        EmailHandler::sendUsingTemplate('booking-notice-to-admin');
    }
}
