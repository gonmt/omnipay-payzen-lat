<?php

namespace Omnipay\PayZenLat\Message;

use Omnipay\Tests\TestCase;
use Omnipay\Common\Exception\InvalidResponseException;

class CompletePurchaseRequestTest extends TestCase
{
    private $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->request = new CompletePurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testGetDataWithCorruptedData_ShouldThrowAnException()
    {
        $this->expectException(InvalidResponseException::class);
        $data = $this->request->getData();
    }
}
