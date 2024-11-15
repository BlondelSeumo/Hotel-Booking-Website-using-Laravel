<?php

namespace Botble\Hotel\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Hotel\Enums\BookingStatusEnum;
use Botble\Hotel\Models\Booking;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingReportRecordController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
        ]);

        $bookingRecordsQuery = Booking::query();

        do_action('booking_reports_before_get_records', $request);
        do_action('booking_reports_before_query', $bookingRecordsQuery);

        $startDate = $request->date('start');
        $endDate = $request->date('end');

        $bookingRecordsQuery
            ->with(['room.room', 'address', 'services', 'payment', 'invoice'])
            ->whereHas('room', function (Builder $query) use ($startDate, $endDate) {
                $query
                    ->where(function (Builder $query) use ($startDate, $endDate) {
                        $query
                            ->whereDate('start_date', '>=', $startDate)
                            ->whereDate('start_date', '<=', $endDate);
                    })
                    ->orWhere(function (Builder $query) use ($startDate, $endDate) {
                        $query
                            ->whereDate('end_date', '>=', $startDate)
                            ->whereDate('end_date', '<=', $endDate);
                    });
            })
            ->whereNot('status', BookingStatusEnum::CANCELLED);

        do_action('booking_reports_after_query', $bookingRecordsQuery);

        $bookingRecords = apply_filters('booking_reports_records', $bookingRecordsQuery->get());

        do_action('booking_reports_after_get_records', $bookingRecords);

        $json = $bookingRecords->map(function (Booking $booking) {
            return [
                'id' => $booking->getKey(),
                'textColor' => match ($booking->status->getValue()) {
                    'pending' => '#715a00',
                    'completed' => '#effeff',
                    'cancelled' => '#ffe0e2',
                    default => '#e7f1ff',
                },
                'backgroundColor' => match ($booking->status->getValue()) {
                    'pending' => '#ffc300',
                    'completed' => '#36c6d3',
                    'cancelled' => '#ed6b75',
                    default => '#0d6efd',
                },
                'borderColor' => 'transparent',
                'title' => trans('plugins/hotel::booking.calendar_item_title', [
                    'room' => $booking->room->room_name,
                    'number_of_rooms' => $booking->room->number_of_rooms,
                    'number_of_guests' => $booking->number_of_guests,
                    'number_of_children' => $booking->number_of_children,
                ]),
                'detail' => apply_filters('booking_reports_detail_render', view('plugins/hotel::booking-info', [
                    'booking' => $booking,
                    'displayBookingStatus' => true,
                ])->render(), $booking),
                'detailUrl' => route('booking.edit', $booking),
                'start' => $booking->room->start_date,
                'end' => $booking->room->end_date,
            ];
        });

        return response()->json(
            apply_filters('booking_reports_records_json', $json)
        );
    }
}
