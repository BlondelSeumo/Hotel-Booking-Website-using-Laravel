<?php

namespace Botble\Razorpay\Http\Controllers;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Ecommerce\Models\Order;
use Botble\Payment\Enums\PaymentStatusEnum;
use Botble\Payment\Models\Payment;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\BadRequestError;

class RazorpayController extends BaseController
{
    public function webhook(Request $request)
    {
        if (
            $request->input('event') === 'order.paid'
            && $request->input('payload.order.entity.status') === 'paid'
        ) {
            $api = new Api(
                get_payment_setting('key', RAZORPAY_PAYMENT_METHOD_NAME),
                get_payment_setting('secret', RAZORPAY_PAYMENT_METHOD_NAME)
            );

            try {
                $orderId = $request->input('payload.payment.entity.order_id');

                do_action('payment_before_making_api_request', RAZORPAY_PAYMENT_METHOD_NAME, ['order_id' => $orderId]);

                // @phpstan-ignore-next-line
                $order = $api->order->fetch($orderId);

                do_action('payment_after_api_response', RAZORPAY_PAYMENT_METHOD_NAME, ['order_id' => $orderId], $order->toArray());

                $status = PaymentStatusEnum::PENDING;

                if ($order['status'] === 'paid') {
                    $status = PaymentStatusEnum::COMPLETED;
                }

                $chargeId = $request->input('payload.payment.entity.id');

                $payment = Payment::query()
                    ->where('charge_id', $chargeId)
                    ->first();

                if ($payment) {
                    $payment->status = $status;
                    $payment->save();

                    $orderId = $payment->order_id;
                } elseif (class_exists(Order::class)) {
                    $orderId = Order::query()->where('token', $order['receipt'])->pluck('id')->all();
                }

                if ($orderId) {
                    do_action(PAYMENT_ACTION_PAYMENT_PROCESSED, [
                        'charge_id' => $chargeId,
                        'order_id' => $orderId,
                        'status' => $status,
                        'payment_channel' => RAZORPAY_PAYMENT_METHOD_NAME,
                    ]);

                    return response('ok');
                }
            } catch (BadRequestError $exception) {
                BaseHelper::logError($exception);

                return response('invalid payload.', 400);
            }
        }
    }
}
