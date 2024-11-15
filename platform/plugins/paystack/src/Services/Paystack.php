<?php

namespace Botble\Paystack\Services;

use Exception;
use Unicodeveloper\Paystack\Paystack as BasePaystack;

class Paystack extends BasePaystack
{
    public function refundOrder($paymentId, $amount)
    {
        $relativeUrl = '/refund';

        $data = [
            'body' => json_encode([
                'transaction' => $paymentId,
                'amount' => $amount * 100,
            ]),
        ];

        do_action('payment_before_making_api_request', PAYSTACK_PAYMENT_METHOD_NAME, $data);

        $this->response = $this->client->post($this->baseUrl . $relativeUrl, $data);

        do_action('payment_after_api_response', PAYSTACK_PAYMENT_METHOD_NAME, $data, (array) $this->response);

        if ($this->isValid()) {
            return $this->getResponse();
        }

        throw new Exception('Invalid Refund Order Paystack');
    }

    protected function getResponse(): array
    {
        return json_decode($this->response->getBody(), true);
    }

    public function isValid(): bool
    {
        return $this->getResponse()['status'];
    }

    public function getPaymentDetails($transactionId)
    {
        $relativeUrl = '/transaction/' . $transactionId;

        do_action('payment_before_making_api_request', PAYSTACK_PAYMENT_METHOD_NAME, ['transaction_id' => $transactionId]);

        $this->response = $this->client->get($this->baseUrl . $relativeUrl);

        do_action('payment_after_api_response', PAYSTACK_PAYMENT_METHOD_NAME, ['transaction_id' => $transactionId], (array) $this->response);

        if ($this->isValid()) {
            return $this->getResponse();
        }

        throw new Exception('Invalid Get Payment Details Paystack');
    }

    public function getListTransactions(array $params = [])
    {
        $relativeUrl = '/transaction' . ($params ? ('?' . http_build_query($params)) : '');

        do_action('payment_before_making_api_request', PAYSTACK_PAYMENT_METHOD_NAME, $params);

        $this->response = $this->client->get($this->baseUrl . $relativeUrl);

        do_action('payment_after_api_response', PAYSTACK_PAYMENT_METHOD_NAME, $params, (array) $this->response);

        if ($this->isValid()) {
            return $this->getResponse();
        }

        throw new Exception('Invalid Get List Transactions Paystack');
    }

    public function getRefundDetails($refundId)
    {
        $relativeUrl = '/refund/' . $refundId;

        do_action('payment_before_making_api_request', PAYSTACK_PAYMENT_METHOD_NAME, ['refund_id' => $refundId]);

        $this->response = $this->client->get($this->baseUrl . $relativeUrl);

        do_action('payment_after_api_response', PAYSTACK_PAYMENT_METHOD_NAME, ['refund_id' => $refundId], (array) $this->response);

        if ($this->isValid()) {
            return $this->getResponse();
        }

        throw new Exception('Invalid Refund Order Paystack');
    }
}
