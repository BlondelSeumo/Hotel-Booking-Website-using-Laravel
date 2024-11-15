<?php

namespace Botble\Hotel\Widgets;

use Botble\Base\Widgets\Table;
use Botble\Hotel\Tables\Reports\RecentBookingTable as BaseRecentBookingTable;

class RecentBookingsTable extends Table
{
    protected string $table = BaseRecentBookingTable::class;

    protected string $route = 'booking.reports.recent-bookings';

    public function getLabel(): string
    {
        return trans('plugins/hotel::booking-reports.recent_bookings');
    }
}
