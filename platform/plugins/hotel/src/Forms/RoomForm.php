<?php

namespace Botble\Hotel\Forms;

use Botble\Base\Facades\Assets;
use Botble\Base\Forms\FieldOptions\ContentFieldOption;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\OnOffFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\EditorField;
use Botble\Base\Forms\Fields\OnOffField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\Hotel\Http\Requests\RoomRequest;
use Botble\Hotel\Models\Amenity;
use Botble\Hotel\Models\Room;
use Botble\Hotel\Models\RoomCategory;
use Botble\Hotel\Models\Tax;

class RoomForm extends FormAbstract
{
    public function setup(): void
    {
        Assets::usingVueJS()
            ->addScripts(['input-mask', 'moment'])
            ->addScriptsDirectly([
                'vendor/core/plugins/hotel/libraries/full-calendar-6.1.8/main.min.js',
                'vendor/core/plugins/hotel/js/room-availability.js',
            ])
            ->addStylesDirectly('vendor/core/plugins/hotel/css/hotel.css');

        $roomCategories = RoomCategory::query()->pluck('name', 'id')->all();
        $taxes = Tax::query()->pluck('title', 'id')->all();
        $amenities = Amenity::query()->select(['name', 'id'])->get();

        $selectedAmenities = [];
        if ($this->getModel()) {
            $selectedAmenities = $this->getModel()->amenities()->pluck('ht_amenities.id')->all();
        }

        $this
            ->setupModel(new Room())
            ->setValidatorClass(RoomRequest::class)
            ->withCustomFields()
            ->add('name', TextField::class, NameFieldOption::make()->required()->toArray())
            ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
            ->add(
                'is_featured',
                OnOffField::class,
                OnOffFieldOption::make()
                    ->label(trans('core/base::forms.is_featured'))
                    ->defaultValue(false)
                    ->toArray()
            )
            ->add('content', EditorField::class, ContentFieldOption::make()->allowedShortcodes()->toArray())
            ->add('rowOpen1', 'html', [
                'html' => '<div class="row">',
            ])
            ->add('order', 'number', [
                'label' => trans('core/base::forms.order'),
                'attr' => [
                    'placeholder' => trans('core/base::forms.order_by_placeholder'),
                ],
                'wrapper' => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
                'default_value' => 0,
            ])
            ->add('price', 'text', [
                'label' => trans('plugins/hotel::room.form.price'),
                'required' => true,
                'wrapper' => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
                'attr' => [
                    'id' => 'price-number',
                    'placeholder' => trans('plugins/hotel::room.form.price'),
                    'class' => 'form-control input-mask-number',
                ],
            ])
            ->add('rowClose1', 'html', [
                'html' => '</div>',
            ])
            ->add('rowOpen2', 'html', [
                'html' => '<div class="row">',
            ])
            ->add('number_of_rooms', 'text', [
                'label' => trans('plugins/hotel::room.form.number_of_rooms'),
                'wrapper' => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
                'attr' => [
                    'id' => 'number-of-rooms-number',
                    'placeholder' => trans('plugins/hotel::room.form.number_of_rooms'),
                    'class' => 'form-control input-mask-number',
                ],
                'default_value' => 1,
            ])
            ->add('number_of_beds', 'text', [
                'label' => trans('plugins/hotel::room.form.number_of_beds'),
                'wrapper' => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
                'attr' => [
                    'id' => 'number-of-beds-number',
                    'placeholder' => trans('plugins/hotel::room.form.number_of_beds'),
                    'class' => 'form-control input-mask-number',
                ],
                'default_value' => 0,
            ])
            ->add('rowClose2', 'html', [
                'html' => '</div>',
            ])
            ->add('rowOpen3', 'html', [
                'html' => '<div class="row">',
            ])
            ->add('max_adults', 'text', [
                'label' => trans('plugins/hotel::room.form.max_adults'),
                'wrapper' => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-4',
                ],
                'attr' => [
                    'id' => 'max-adults-number',
                    'placeholder' => trans('plugins/hotel::room.form.max_adults'),
                    'class' => 'form-control input-mask-number',
                ],
                'default_value' => 1,
            ])
            ->add('max_children', 'text', [
                'label' => trans('plugins/hotel::room.form.max_children'),
                'wrapper' => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-4',
                ],
                'attr' => [
                    'id' => 'max-children-number',
                    'placeholder' => trans('plugins/hotel::room.form.max_children'),
                    'class' => 'form-control input-mask-number',
                ],
                'default_value' => 0,
            ])
            ->add('size', 'text', [
                'label' => trans('plugins/hotel::room.form.size'),
                'wrapper' => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-4',
                ],
                'attr' => [
                    'id' => 'size-number',
                    'placeholder' => trans('plugins/hotel::room.form.size'),
                    'class' => 'form-control input-mask-number',
                ],
                'default_value' => 0,
            ])
            ->add('rowClose3', 'html', [
                'html' => '</div>',
            ])
            ->add('images[]', 'mediaImages', [
                'label' => trans('plugins/hotel::room.images'),
                'values' => $this->getModel()->id ? $this->getModel()->images : [],
            ])
            ->add('status', SelectField::class, StatusFieldOption::make()->toArray())
            ->add('room_category_id', 'customSelect', [
                'label' => trans('plugins/hotel::room.form.category'),
                'required' => true,
                'wrapper' => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-4',
                ],
                'attr' => [
                    'class' => 'form-control select-full',
                ],
                'choices' => $roomCategories,
            ])
            ->add('tax_id', 'customSelect', [
                'label' => trans('plugins/hotel::room.form.tax'),
                'required' => true,
                'wrapper' => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-4',
                ],
                'attr' => [
                    'class' => 'form-control select-full',
                ],
                'choices' => $taxes,
            ])
            ->addMetaBoxes([
                'amenities' => [
                    'title' => trans('plugins/hotel::room.amenities'),
                    'content' => view(
                        'plugins/hotel::forms.amenities',
                        compact('selectedAmenities', 'amenities')
                    )->render(),
                    'priority' => 1,
                ],
            ])
            ->setBreakFieldPoint('status');

        if ($this->getModel()->id) {
            $this->addMetaBoxes([
                'room-availability' => [
                    'title' => trans('plugins/hotel::room.form.room_availability'),
                    'content' => view(
                        'plugins/hotel::forms.room-availability',
                        ['object' => $this->getModel()]
                    )->render(),
                    'priority' => 2,
                ],
            ]);
        }
    }
}
