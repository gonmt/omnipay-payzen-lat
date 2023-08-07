<?php

namespace Omnipay\PayZenLat\Message;

/**
 * PayZen Complete Purchase Request
 */
class CompletePurchaseRequest extends AbstractRequest
{
    use GetValidatedSignedDataTrait;

    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
