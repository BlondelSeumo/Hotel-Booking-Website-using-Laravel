<?php

namespace Botble\Hotel\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Hotel\Forms\ServiceForm;
use Botble\Hotel\Http\Requests\ServiceRequest;
use Botble\Hotel\Models\Service;
use Botble\Hotel\Tables\ServiceTable;

class ServiceController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans('plugins/hotel::hotel.name'))
            ->add(trans('plugins/hotel::service.name'), route('service.index'));
    }

    public function index(ServiceTable $table)
    {
        $this->pageTitle(trans('plugins/hotel::service.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/hotel::service.create'));

        return ServiceForm::create()->renderForm();
    }

    public function store(ServiceRequest $request)
    {
        $form = ServiceForm::create();
        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('service.index'))
            ->setNextUrl(route('service.edit', $form->getModel()->getKey()))
            ->withCreatedSuccessMessage();
    }

    public function edit(Service $service)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $service->name]));

        return ServiceForm::createFromModel($service)->renderForm();
    }

    public function update(Service $service, ServiceRequest $request)
    {
        ServiceForm::createFromModel($service)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('service.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Service $service)
    {
        return DeleteResourceAction::make($service);
    }
}
