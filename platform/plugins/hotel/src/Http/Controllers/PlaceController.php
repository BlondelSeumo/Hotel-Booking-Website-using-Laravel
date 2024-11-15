<?php

namespace Botble\Hotel\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Hotel\Forms\PlaceForm;
use Botble\Hotel\Http\Requests\PlaceRequest;
use Botble\Hotel\Models\Place;
use Botble\Hotel\Tables\PlaceTable;

class PlaceController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans('plugins/hotel::hotel.name'))
            ->add(trans('plugins/hotel::place.name'), route('place.index'));
    }

    public function index(PlaceTable $table)
    {
        $this->pageTitle(trans('plugins/hotel::place.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/hotel::place.create'));

        return PlaceForm::create()->renderForm();
    }

    public function store(PlaceRequest $request)
    {
        $form = PlaceForm::create();
        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('place.index'))
            ->setNextUrl(route('place.edit', $form->getModel()->getKey()))
            ->withCreatedSuccessMessage();
    }

    public function edit(Place $place)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $place->name]));

        return PlaceForm::createFromModel($place)->renderForm();
    }

    public function update(Place $place, PlaceRequest $request)
    {
        PlaceForm::createFromModel($place)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('place.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Place $place)
    {
        return DeleteResourceAction::make($place);
    }
}
