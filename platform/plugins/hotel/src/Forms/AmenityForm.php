<?php

namespace Botble\Hotel\Forms;

use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\Hotel\Http\Requests\AmenityRequest;
use Botble\Hotel\Models\Amenity;

class AmenityForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setupModel(new Amenity())
            ->setValidatorClass(AmenityRequest::class)
            ->withCustomFields()
            ->add('name', TextField::class, NameFieldOption::make()->required()->toArray())
            ->add('icon', 'themeIcon', [
                'label' => trans('plugins/hotel::amenity.icon'),
                'default_value' => 'fa fa-check',
            ])
            ->add('status', SelectField::class, StatusFieldOption::make()->toArray())
            ->setBreakFieldPoint('status');
    }
}
