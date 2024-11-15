<?php

namespace Botble\Hotel\Forms;

use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\FormAbstract;
use Botble\Hotel\Http\Requests\CustomerCreateRequest;
use Botble\Hotel\Models\Customer;

class CustomerForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setupModel(new Customer())
            ->setValidatorClass(CustomerCreateRequest::class)
            ->withCustomFields()
            ->add('first_name', 'text', [
                'label' => trans('plugins/hotel::customer.form.first_name'),
                'required' => true,
                'attr' => [
                    'placeholder' => trans('plugins/hotel::customer.form.first_name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('last_name', 'text', [
                'label' => trans('plugins/hotel::customer.form.last_name'),
                'required' => true,
                'attr' => [
                    'placeholder' => trans('plugins/hotel::customer.form.last_name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('email', 'text', [
                'label' => trans('plugins/hotel::customer.form.email'),
                'required' => true,
                'attr' => [
                    'placeholder' => trans('plugins/hotel::customer.form.email_placeholder'),
                    'data-counter' => 60,
                ],
            ])
            ->add('phone', 'text', [
                'label' => trans('plugins/hotel::customer.form.phone'),
                'attr' => [
                    'placeholder' => trans('plugins/hotel::customer.form.phone'),
                    'data-counter' => 20,
                ],
            ])
            ->add('is_change_password', 'onOff', [
                'label' => trans('plugins/hotel::customer.change_password'),
                'value' => 0,
                'attr' => [
                    'data-bb-toggle' => 'collapse',
                    'data-bb-target' => '#change-password',
                ],
                'wrapper' => [
                    'class' => $this->getModel()->id ? $this->formHelper->getConfig('defaults.wrapper_class') : 'd-none',
                ],
            ])
            ->add('openRow', 'html', [
                'html' => '<div id="change-password" class="row"' . ($this->getModel()->id ? ' style="display: none"' : null) . '>',
            ])
            ->add('password', 'password', [
                'label' => trans('plugins/hotel::customer.password'),
                'required' => true,
                'attr' => [
                    'data-counter' => 60,
                ],
                'wrapper' => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('password_confirmation', 'password', [
                'label' => trans('plugins/hotel::customer.password_confirmation'),
                'required' => true,
                'attr' => [
                    'data-counter' => 60,
                ],
                'wrapper' => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('closeRow', 'html', [
                'html' => '</div>',
            ])
            ->add('status', SelectField::class, StatusFieldOption::make()->toArray())
            ->add('avatar', MediaImageField::class)
            ->setBreakFieldPoint('status');
    }
}
