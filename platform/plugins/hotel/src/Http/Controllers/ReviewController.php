<?php

namespace Botble\Hotel\Http\Controllers;

use Botble\Base\Facades\Assets;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Hotel\Models\Review;
use Botble\Hotel\Tables\ReviewTable;

class ReviewController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans('plugins/hotel::hotel.name'));
    }

    public function index(ReviewTable $dataTable)
    {
        $this->pageTitle(trans('plugins/hotel::review.name'));

        Assets::addStylesDirectly('vendor/core/plugins/hotel/css/review.css');

        return $dataTable->renderTable();
    }

    public function destroy(Review $review)
    {
        return DeleteResourceAction::make($review);
    }
}
