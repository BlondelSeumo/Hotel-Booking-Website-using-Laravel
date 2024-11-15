<?php

namespace Botble\Hotel\Http\Controllers;

use Botble\Base\Facades\Assets;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Widgets\AdminWidget;
use Botble\Hotel\Facades\HotelHelper;
use Botble\Hotel\Tables\Reports\RecentBookingTable;
use Illuminate\Http\Request;

class BookingReportController extends BaseController
{
    public function index(Request $request, AdminWidget $widget)
    {
        $this->pageTitle(trans('plugins/hotel::booking.reports'));

        Assets::addScriptsDirectly([
            'vendor/core/plugins/hotel/libraries/daterangepicker/daterangepicker.js',
            'vendor/core/plugins/hotel/js/report.js',
        ])
            ->addStylesDirectly([
                'vendor/core/plugins/hotel/libraries/daterangepicker/daterangepicker.css',
                'vendor/core/plugins/hotel/css/report.css',
            ])
            ->addScripts(['moment']);

        Assets::usingVueJS();

        [$startDate, $endDate] = HotelHelper::getDateRangeInReport($request);

        if ($request->ajax()) {
            return $this
                ->httpResponse()->setData(view('plugins/hotel::reports.ajax', compact('widget'))->render());
        }

        return view(
            'plugins/hotel::reports.index',
            compact('startDate', 'endDate', 'widget')
        );
    }

    public function getRecentBookings(RecentBookingTable $table)
    {
        return $table->renderTable();
    }
}
