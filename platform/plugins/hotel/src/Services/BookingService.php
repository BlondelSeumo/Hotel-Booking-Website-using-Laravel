<?php

namespace Botble\Hotel\Services;

use Botble\Hotel\Enums\BookingStatusEnum;
use Botble\Hotel\Events\BookingCreated;
use Botble\Hotel\Models\Booking;
use Botble\Hotel\Models\Customer;
use Botble\Payment\Enums\PaymentStatusEnum;
use Botble\Payment\Models\Payment;

class BookingService
{
    public function processBooking(int $bookingId, ?string $chargeId = null): ?Booking
    {
        /**
         * @var Booking $booking
         */
        $booking = Booking::query()->find($bookingId);

        if (! $booking) {
            return null;
        }

        if ($chargeId && is_plugin_active('payment')) {
            $payment = Payment::query()->where(['charge_id' => $chargeId])->first();

            if ($payment) {
                $booking->payment_id = $payment->getKey();

                if ($payment->status == PaymentStatusEnum::COMPLETED) {
                    $booking->status = BookingStatusEnum::PROCESSING;
                }

                $booking->save();
            }
        }

        if (! Customer::query()->where('email', $booking->address->email)->exists()) {
            Customer::query()->create([
                'first_name' => $booking->address->first_name,
                'last_name' => $booking->address->last_name,
                'email' => $booking->address->email,
                'phone' => $booking->address->phone,
            ]);
        }

        BookingCreated::dispatch($booking);

        return $booking;
    }
}
