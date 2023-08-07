<?php


namespace Omnipay\PayZen\Message;


use Omnipay\Common\Message\AbstractResponse;

class CompleteRestPurchaseResponse extends AbstractResponse
{
    public function isSuccessful(): bool
    {
        return in_array($this->data['orderStatus'], ["PAID", "PARTIALLY_PAID", "RUNNING"]);
    }
}