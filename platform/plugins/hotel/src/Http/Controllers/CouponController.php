<?php

namespace Botble\Hotel\Http\Controllers;

use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Facades\Assets;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Hotel\Http\Requests\CouponRequest;
use Botble\Hotel\Models\Coupon;
use Botble\Hotel\Tables\CouponTable;
use Botble\JsValidation\Facades\JsValidator;
use Illuminate\Support\Str;

class CouponController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans('plugins/hotel::coupon.name'), route('coupons.index'));
    }

    public function index(CouponTable $discountTable)
    {
        $this->pageTitle(trans('plugins/hotel::coupon.name'));

        return $discountTable->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/hotel::coupon.form.create'));

        Assets::usingVueJS()
            ->addStyles('timepicker')
            ->addScripts(['timepicker', 'form-validation'])
            ->addScriptsDirectly('vendor/core/plugins/hotel/js/coupon.js');

        $jsValidator = JsValidator::formRequest(CouponRequest::class);

        $coupon = new Coupon();

        return view('plugins/hotel::coupons.create', compact('jsValidator', 'coupon'));
    }

    public function store(CouponRequest $request)
    {
        $coupon = Coupon::query()->create(array_merge($request->validated(), $request->has('never_expired') ? [] : [
            'expires_date' => $request->date('expires_date')->setTimeFrom($request->input('expires_time')),
        ]));

        event(new CreatedContentEvent(COUPON_MODULE_SCREEN_NAME, $request, $coupon));

        return $this
            ->httpResponse()
            ->setMessage(trans('plugins/hotel::coupon.created_message'))
            ->setNextUrl(route('coupons.edit', $coupon));
    }

    public function edit(Coupon $coupon)
    {
        $this->pageTitle(trans('plugins/hotel::coupon.form.edit', ['name' => $coupon->code]));

        Assets::usingVueJS()
            ->addStyles('timepicker')
            ->addScripts(['timepicker', 'form-validation'])
            ->addScriptsDirectly('vendor/core/plugins/hotel/js/coupon.js');

        $jsValidator = JsValidator::formRequest(CouponRequest::class);

        return view('plugins/hotel::coupons.edit', compact('coupon', 'jsValidator'));
    }

    public function update(Coupon $coupon, CouponRequest $request)
    {
        $coupon->update(
            array_merge(
                $request->validated(),
                $request->has('never_expired')
                    ? ['expires_date' => null]
                    : ['expires_date' => $request->date('expires_date')->setTimeFrom($request->input('expires_time'))]
            )
        );

        event(new UpdatedContentEvent(COUPON_MODULE_SCREEN_NAME, $request, $coupon));

        return $this
            ->httpResponse()
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Coupon $coupon)
    {
        return DeleteResourceAction::make($coupon);
    }

    public function generateCouponCode()
    {
        do {
            $code = strtoupper(Str::random(12));
        } while (Coupon::query()->where('code', $code)->exists());

        return $this
            ->httpResponse()
            ->setData($code);
    }
}
