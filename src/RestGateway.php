<?php
namespace Omnipay\PayZenLat;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

/**
 * PayZen Rest RestGateway
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class RestGateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'PayZen Rest';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'username' => '',
            'password' => '',
            'testPassword' => '',
            'testMode' => true,
        ];
    }

    /**
     * @param array $parameters
     * @return RequestInterface
     */
    public function purchase(array $parameters = []): RequestInterface
    {
        return $this->createRequest('\Omnipay\PayZenLat\Message\RestPurchaseRequest', $parameters);
    }

    public function completePurchase(array $options = []): RequestInterface
    {
        return $this->createRequest('\Omnipay\PayZenLat\Message\CompleteRestPurchaseRequest', $options);
    }

    public function setUsername(string $value): self
    {
        return $this->setParameter('username', $value);
    }

    public function getUsername(): string
    {
        return $this->getParameter('username');
    }

    public function setPassword(string $value): self
    {
        return $this->setParameter('password', $value);
    }

    public function getPassword(): string
    {
        return $this->getParameter('password');
    }

    public function setTestPassword(string $value): self
    {
        return $this->setParameter('testPassword', $value);
    }

    public function getTestPassword(): string
    {
        return $this->getParameter('testPassword');
    }
}
