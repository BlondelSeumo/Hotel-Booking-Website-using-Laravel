<?php

namespace Botble\Hotel\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Hotel\Forms\FoodTypeForm;
use Botble\Hotel\Http\Requests\FoodTypeRequest;
use Botble\Hotel\Models\FoodType;
use Botble\Hotel\Tables\FoodTypeTable;

class FoodTypeController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans('plugins/hotel::hotel.name'))
            ->add(trans('plugins/hotel::food-type.name'), route('food-type.index'));
    }

    public function index(FoodTypeTable $table)
    {
        $this->pageTitle(trans('plugins/hotel::food-type.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/hotel::food-type.create'));

        return FoodTypeForm::create()->renderForm();
    }

    public function store(FoodTypeRequest $request)
    {
        $form = FoodTypeForm::create();
        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('food-type.index'))
            ->setNextUrl(route('food-type.edit', $form->getModel()->getKey()))
            ->withCreatedSuccessMessage();
    }

    public function edit(FoodType $foodType)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $foodType->name]));

        return FoodTypeForm::createFromModel($foodType)->renderForm();
    }

    public function update(FoodType $foodType, FoodTypeRequest $request)
    {
        FoodTypeForm::createFromModel($foodType)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('food-type.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(FoodType $foodType)
    {
        return DeleteResourceAction::make($foodType);
    }
}
