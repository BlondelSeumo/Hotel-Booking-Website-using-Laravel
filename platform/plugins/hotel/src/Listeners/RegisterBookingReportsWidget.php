<?php

namespace Botble\Hotel\Listeners;

use Botble\Base\Events\RenderingAdminWidgetEvent;
use Botble\Hotel\Widgets\BookingCard;
use Botble\Hotel\Widgets\BookingChart;
use Botble\Hotel\Widgets\CustomerCard;
use Botble\Hotel\Widgets\CustomerChart;
use Botble\Hotel\Widgets\RecentBookingsTable;
use Botble\Hotel\Widgets\ReportGeneralHtml;
use Botble\Hotel\Widgets\RevenueCard;
use Botble\Hotel\Widgets\RoomCard;

class RegisterBookingReportsWidget
{
    public function handle(RenderingAdminWidgetEvent $event): void
    {
        $event->widget
            ->register([
                RevenueCard::class,
                RoomCard::class,
                CustomerCard::class,
                BookingCard::class,
                CustomerChart::class,
                BookingChart::class,
                ReportGeneralHtml::class,
                RecentBookingsTable::class,
            ], 'booking-reports');
    }
}
