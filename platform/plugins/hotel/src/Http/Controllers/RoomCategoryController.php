<?php

namespace Botble\Hotel\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Hotel\Forms\RoomCategoryForm;
use Botble\Hotel\Http\Requests\RoomCategoryRequest;
use Botble\Hotel\Models\RoomCategory;
use Botble\Hotel\Tables\RoomCategoryTable;

class RoomCategoryController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans('plugins/hotel::hotel.name'))
            ->add(trans('plugins/hotel::room-category.name'), route('room-category.index'));
    }

    public function index(RoomCategoryTable $table)
    {
        $this->pageTitle(trans('plugins/hotel::room-category.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/hotel::room-category.create'));

        return RoomCategoryForm::create()->renderForm();
    }

    public function store(RoomCategoryRequest $request)
    {
        $form = RoomCategoryForm::create();
        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('room-category.index'))
            ->setNextUrl(route('room-category.edit', $form->getModel()->getKey()))
            ->withCreatedSuccessMessage();
    }

    public function edit(RoomCategory $roomCategory)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $roomCategory->name]));

        return RoomCategoryForm::createFromModel($roomCategory)->renderForm();
    }

    public function update(RoomCategory $roomCategory, RoomCategoryRequest $request)
    {
        RoomCategoryForm::createFromModel($roomCategory)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('room-category.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(RoomCategory $roomCategory)
    {
        return DeleteResourceAction::make($roomCategory);
    }
}
