<?php

namespace Omnipay\PayZenLat;

use Omnipay\Tests\GatewayTestCase;

class RestGatewayTest extends GatewayTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->gateway = new RestGateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase([]);
        $this->assertInstanceOf('Omnipay\PayZenLat\Message\RestPurchaseRequest', $request);
    }
}
