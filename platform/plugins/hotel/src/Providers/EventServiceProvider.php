<?php

namespace Botble\Hotel\Providers;

use Botble\Base\Events\RenderingAdminWidgetEvent;
use Botble\Hotel\Events\BookingCreated;
use Botble\Hotel\Events\BookingStatusChanged;
use Botble\Hotel\Listeners\AddSitemapListener;
use Botble\Hotel\Listeners\GenerateInvoiceListener;
use Botble\Hotel\Listeners\RegisterBookingReportsWidget;
use Botble\Hotel\Listeners\SendConfirmationEmail;
use Botble\Hotel\Listeners\SendStatusChangedNotificationListener;
use Botble\Theme\Events\RenderingSiteMapEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        RenderingSiteMapEvent::class => [
            AddSitemapListener::class,
        ],
        BookingCreated::class => [
            GenerateInvoiceListener::class,
            SendConfirmationEmail::class,
        ],
        BookingStatusChanged::class => [
            SendStatusChangedNotificationListener::class,
        ],
        RenderingAdminWidgetEvent::class => [
            RegisterBookingReportsWidget::class,
        ],
     ];
}
