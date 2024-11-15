<?php

namespace Botble\Hotel\Forms;

use Botble\Base\Facades\Assets;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\Hotel\Http\Requests\FoodRequest;
use Botble\Hotel\Models\Food;
use Botble\Hotel\Models\FoodType;

class FoodForm extends FormAbstract
{
    public function setup(): void
    {
        Assets::addScripts(['input-mask'])
            ->addStylesDirectly('vendor/core/plugins/hotel/css/hotel.css');

        $foodTypes = FoodType::query()->pluck('name', 'id')->all();

        $this
            ->setupModel(new Food())
            ->setValidatorClass(FoodRequest::class)
            ->withCustomFields()
            ->add('name', TextField::class, NameFieldOption::make()->required()->toArray())
            ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
            ->add('price', 'text', [
                'label' => trans('plugins/hotel::food.form.price'),
                'required' => true,
                'attr' => [
                    'id' => 'price-number',
                    'placeholder' => trans('plugins/hotel::food.form.price'),
                    'class' => 'form-control input-mask-number',
                ],
            ])
            ->add('status', SelectField::class, StatusFieldOption::make()->toArray())
            ->add('food_type_id', 'customSelect', [
                'label' => trans('plugins/hotel::food.form.food_type'),
                'required' => true,
                'choices' => $foodTypes,
            ])
            ->add('image', MediaImageField::class)
            ->setBreakFieldPoint('status');
    }
}
