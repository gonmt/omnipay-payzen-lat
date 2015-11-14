<?php

namespace Omnipay\PayZen\Message;

/**
 * PayZen Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    public $liveEndpoint = 'https://secure.payzen.eu/vads-payment/';

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getTransactionDate()
    {
        return $this->getParameter('transactionDate');
    }

    public function setTransactionDate($value)
    {
        return $this->setParameter('transactionDate', $value);
    }

    public function getCertificate()
    {
        return $this->getParameter('certificate');
    }

    public function setCertificate($value)
    {
        return $this->setParameter('certificate', $value);
    }

    public function getEndpoint()
    {
        return $this->liveEndpoint;
    }

    public function formatCurrency($amount)
    {
        return strval(intval($amount * 100));
    }

    /**
     * @see https://payzen.eu/wp-content/uploads/2013/04/Guide_d_implementation_formulaire_paiement_PayZen_v3.4.pdf
     */
    protected function generateSignature($data)
    {
        // Sort the data
        ksort($data);

        // Filter only the vads_* fields
        $matchedKeys = array_filter(array_keys($data), function($v) {
            return strpos($v, 'vads_') === 0;
        });
        $data = array_intersect_key($data, array_flip($matchedKeys));

        // Add the certificate
        $data[] = $this->getCertificate();

        return sha1(implode('+', $data));
    }
}