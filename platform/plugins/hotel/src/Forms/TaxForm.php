<?php

namespace Botble\Hotel\Forms;

use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\FormAbstract;
use Botble\Hotel\Http\Requests\TaxRequest;
use Botble\Hotel\Models\Tax;

class TaxForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setupModel(new Tax())
            ->setValidatorClass(TaxRequest::class)
            ->withCustomFields()
            ->add('title', 'text', [
                'label' => trans('plugins/hotel::tax.title'),
                'required' => true,
                'attr' => [
                    'placeholder' => trans('plugins/hotel::tax.title'),
                    'data-counter' => 120,
                ],
            ])
            ->add('percentage', 'number', [
                'label' => trans('plugins/hotel::tax.percentage'),
                'required' => true,
                'attr' => [
                    'placeholder' => trans('plugins/hotel::tax.percentage'),
                    'data-counter' => 120,
                ],
            ])
            ->add('priority', 'number', [
                'label' => trans('plugins/hotel::tax.priority'),
                'required' => true,
                'attr' => [
                    'placeholder' => trans('plugins/hotel::tax.priority'),
                    'data-counter' => 120,
                ],
            ])
            ->add('status', SelectField::class, StatusFieldOption::make()->toArray())
            ->setBreakFieldPoint('status');
    }
}
