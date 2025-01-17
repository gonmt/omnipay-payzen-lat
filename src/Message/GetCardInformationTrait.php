<?php

namespace Omnipay\PayZenLat\Message;

trait GetCardInformationTrait
{
    /**
     * @inheritDoc
     */
    public function hasCreatedCard()
    {
        if (isset($this->data['vads_identifier_status'])
            && 'CREATED' ===  $this->data['vads_identifier_status']
        ) {
            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function getCardReference()
    {
        return isset($this->data['vads_identifier']) ? $this->data['vads_identifier'] : null;
    }

    /**
     * @inheritDoc
     */
    public function getCardNumber()
    {
        return isset($this->data['vads_card_number']) ? $this->data['vads_card_number'] : null;
    }

    /**
     * @inheritDoc
     */
    public function getCardExpiryDate()
    {
        if (!isset($this->data['vads_expiry_year'])
            || !isset($this->data['vads_expiry_month'])
        ) {
            return null;
        }

        $beginningOfMonth = new \DateTime(
            sprintf('%s-%s', $this->data['vads_expiry_year'], $this->data['vads_expiry_month'])
        );

        return $beginningOfMonth->modify('last day of this month');
    }

    /**
     * @inheritDoc
     */
    public function getCardBrand()
    {
        return isset($this->data['vads_card_brand']) ? $this->data['vads_card_brand'] : null;
    }

    /**
     * @inheritDoc
     */
    public function getOwnerReference()
    {
        return isset($this->data['vads_ext_info_owner_reference'])
            ? $this->data['vads_ext_info_owner_reference']
            : null
        ;
    }
}
