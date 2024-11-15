<?php

namespace Botble\Hotel\PanelSections;

use Botble\Base\PanelSections\PanelSection;
use Botble\Base\PanelSections\PanelSectionItem;

class SettingHotelPanelSection extends PanelSection
{
    public function setup(): void
    {
        $this
            ->setId('settings.hotel')
            ->setTitle(trans('plugins/hotel::settings.hotel'))
            ->withPriority(1000)
            ->addItems([
                PanelSectionItem::make('general_settings')
                    ->setTitle(trans('plugins/hotel::settings.general.title'))
                    ->withIcon('ti ti-settings')
                    ->withDescription(trans('plugins/hotel::settings.general.description'))
                    ->withPriority(9)
                    ->withRoute('hotel.settings.general'),
                PanelSectionItem::make('review_settings')
                    ->setTitle(trans('plugins/hotel::settings.review.title'))
                    ->withIcon('ti ti-settings')
                    ->withDescription(trans('plugins/hotel::settings.review.description'))
                    ->withPriority(10)
                    ->withRoute('hotel.settings.review'),
                PanelSectionItem::make('currency_settings')
                    ->setTitle(trans('plugins/hotel::settings.currency.title'))
                    ->withIcon('ti ti-coin')
                    ->withPriority(20)
                    ->withDescription(trans('plugins/hotel::settings.currency.description'))
                    ->withRoute('hotel.settings.currencies'),
                PanelSectionItem::make('invoice_settings')
                    ->setTitle(trans('plugins/hotel::settings.invoice.title'))
                    ->withIcon('ti ti-file-invoice')
                    ->withPriority(30)
                    ->withDescription(trans('plugins/hotel::settings.invoice.description'))
                    ->withRoute('hotel.settings.invoice'),
                PanelSectionItem::make('invoice_template_settings')
                    ->setTitle(trans('plugins/hotel::settings.invoice_template.title'))
                    ->withIcon('ti ti-template')
                    ->withPriority(40)
                    ->withDescription(trans('plugins/hotel::settings.invoice_template.description'))
                    ->withRoute('hotel.settings.invoice-template'),
            ]);
    }
}
