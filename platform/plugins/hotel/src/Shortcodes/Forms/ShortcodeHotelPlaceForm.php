<?php

namespace Botble\Hotel\Shortcodes\Forms;

use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Hotel\Models\Place;
use Botble\Shortcode\Forms\ShortcodeForm;

class ShortcodeHotelPlaceForm extends ShortcodeForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(trans('plugins/hotel::hotel.shortcodes.title'))
                    ->toArray()
            )
            ->add(
                'place_ids',
                SelectField::class,
                SelectFieldOption::make()
                    ->choices(
                        Place::query()
                        ->wherePublished()
                        ->pluck('name', 'id')
                        ->toArray()
                    )
                    ->label(trans('plugins/hotel::hotel.shortcodes.choose_places'))
                    ->searchable()
                    ->multiple()
                    ->toArray()
            );
    }
}
