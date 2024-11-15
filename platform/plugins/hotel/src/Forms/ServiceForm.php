<?php

namespace Botble\Hotel\Forms;

use Botble\Base\Forms\FieldOptions\ContentFieldOption;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\EditorField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\Hotel\Enums\ServicePriceTypeEnum;
use Botble\Hotel\Http\Requests\ServiceRequest;
use Botble\Hotel\Models\Service;

class ServiceForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setupModel(new Service())
            ->setValidatorClass(ServiceRequest::class)
            ->withCustomFields()
            ->add('name', TextField::class, NameFieldOption::make()->required()->toArray())
            ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
            ->add('content', EditorField::class, ContentFieldOption::make()->toArray())
            ->add('status', SelectField::class, StatusFieldOption::make()->toArray())
            ->add('price', 'text', [
                'label' => trans('plugins/hotel::service.form.price'),
                'required' => true,
                'attr' => [
                    'id' => 'price-number',
                    'placeholder' => trans('plugins/hotel::service.form.price'),
                    'class' => 'form-control input-mask-number',
                ],
            ])
            ->add('price_type', 'customSelect', [
                'label' => trans('plugins/hotel::service.form.price_type'),
                'attr' => [
                    'class' => 'form-control select-full',
                ],
                'choices' => ServicePriceTypeEnum::labels(),
            ])
            ->add('image', MediaImageField::class)
            ->setBreakFieldPoint('status');
    }
}
