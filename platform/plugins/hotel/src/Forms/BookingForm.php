<?php

namespace Botble\Hotel\Forms;

use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\FormAbstract;
use Botble\Hotel\Enums\BookingStatusEnum;
use Botble\Hotel\Http\Requests\UpdateBookingRequest;
use Botble\Hotel\Models\Booking;

class BookingForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setupModel(new Booking())
            ->setValidatorClass(UpdateBookingRequest::class)
            ->withCustomFields()
            ->add('status', SelectField::class, StatusFieldOption::make()->choices(BookingStatusEnum::labels())->toArray())
            ->setBreakFieldPoint('status')
            ->addMetaBoxes([
                'information' => [
                    'title' => trans('plugins/hotel::booking.booking_information'),
                    'content' => view('plugins/hotel::booking-info', ['booking' => $this->getModel()])->render(),
                    'attributes' => [
                        'style' => 'margin-top: 0',
                    ],
                ],
            ]);
    }
}
