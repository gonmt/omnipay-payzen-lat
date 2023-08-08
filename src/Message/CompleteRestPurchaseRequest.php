<?php


namespace Omnipay\PayZenLat\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractRequest as OmniPayAbstractRequest;
use Omnipay\Common\Message\AbstractResponse;


class CompleteRestPurchaseRequest extends OmniPayAbstractRequest
{
    public function getData(): array
    {
        $this->validateHash();

        return $this->httpRequest->request->all();
    }

    public function sendData($data): AbstractResponse
    {
        $data = json_decode(stripslashes($this->httpRequest->request->get('kr-answer')), true);

        return $this->response = new CompleteRestPurchaseResponse($this, $data);
    }

    public function setHmacKey(string $hashKey): self
    {
        return $this->setParameter('hmacKey', $hashKey);
    }

    public function getHmacKey(): string
    {
        return $this->getParameter('hmacKey');
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

    public function getHashKey(): string
    {
        return $this->httpRequest->request->get('kr-hash-key') == 'sha256_hmac'
            ? $this->getHmacKey() : $this->getPassword();
    }

    private function validateHash(): void
    {
        $requestHash = $this->httpRequest->request->get('kr-hash');

        $hashData = str_replace('\/', '/', $this->httpRequest->request->get('kr-answer'));

        $expectedHash = hash_hmac('sha256', $hashData, $this->getHashKey());

        if ($requestHash !== $expectedHash) {
            throw new InvalidResponseException('Invalid hash');
        }
    }
}