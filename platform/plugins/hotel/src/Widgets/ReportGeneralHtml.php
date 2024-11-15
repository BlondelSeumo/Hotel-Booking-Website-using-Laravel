<?php

namespace Botble\Hotel\Widgets;

use Botble\Base\Widgets\Html;
use Botble\Hotel\Models\Booking;
use Botble\Payment\Enums\PaymentStatusEnum;
use Carbon\CarbonPeriod;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ReportGeneralHtml extends Html
{
    public function getContent(): string
    {
        if (! is_plugin_active('payment')) {
            return '';
        }

        $count = [
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ];

        $revenues = Booking::query()
            ->select([
                DB::raw('SUM(COALESCE(payments.amount, 0) - COALESCE(payments.refunded_amount, 0)) as revenue'),
                'payments.status',
            ])
            ->join('payments', 'payments.id', '=', 'ht_bookings.payment_id')
            ->whereIn('payments.status', [PaymentStatusEnum::COMPLETED, PaymentStatusEnum::PENDING])
            ->whereDate('payments.created_at', '>=', $this->startDate)
            ->whereDate('payments.created_at', '<=', $this->endDate)
            ->groupBy('payments.status')
            ->get();

        $revenueCompleted = $revenues->firstWhere('status', PaymentStatusEnum::COMPLETED);
        $revenuePending = $revenues->firstWhere('status', PaymentStatusEnum::PENDING);

        $count['revenues'] = [
            [
                'label' => PaymentStatusEnum::COMPLETED()->label(),
                'value' => $revenueCompleted ? (int) $revenueCompleted->revenue : 0,
                'status' => true,
                'color' => '#80bc00',
            ],
            [
                'label' => PaymentStatusEnum::PENDING()->label(),
                'value' => $revenuePending ? (int) $revenuePending->revenue : 0,
                'status' => false,
                'color' => '#E91E63',
            ],
        ];

        $revenues = Booking::getRevenueData($this->startDate, $this->endDate);

        $series = [];
        $dates = [];
        $earningBookings = collect();
        $period = CarbonPeriod::create($this->startDate->startOfDay(), $this->endDate->endOfDay());

        $colors = ['#fcb800', '#80bc00'];

        $data = [
            'name' => get_application_currency()->title,
            'data' => [],
        ];

        foreach ($period as $date) {
            $value = $revenues
                ->where('date', $date->toDateString())
                ->sum('revenue');

            $data['data'][] = (float) $value;
        }

        $earningBookings[] = [
            'text' => trans('plugins/hotel::booking-reports.items_earning_bookings', [
                'value' => format_price(collect($data['data'])->sum()),
            ]),
            'color' => Arr::get($colors, $earningBookings->count(), Arr::first($colors)),
        ];

        $series[] = $data;

        foreach ($period as $date) {
            $dates[] = $date->toDateString();
        }

        $colors = $earningBookings->pluck('color');

        $bookingsReport = compact('dates', 'series', 'earningBookings', 'colors');

        $revenues = fn (string $key): array => collect($count['revenues'])->pluck($key)->toArray();

        return view('plugins/hotel::reports.widgets.revenues', compact('count', 'bookingsReport', 'revenues'))->render();
    }
}
