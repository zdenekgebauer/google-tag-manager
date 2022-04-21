<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use stdClass;
use ZdenekGebauer\GoogleTagManager\DataLayerContent;

/**
 * @see https://developers.google.com/analytics/devguides/collection/ga4/ecommerce?client_type=gtm
 */
class EventPurchase extends DataLayerContent
{
    use ItemsTrait;

    public ?string $affiliation = null;

    public ?string $coupon = null;

    public ?string $currency = null;

    public ?float $shipping = null;

    public ?float $tax = null;

    public ?string $transactionId = null;

    public ?float $value = null;

    public function __construct()
    {
        $this->requiredProperties = ['transactionId', 'value', 'currency'];
    }

    public function assertValid(): void
    {
        parent::assertValid();
        $this->assertValidItems();
    }

    public function jsonSerialize(): stdClass
    {
        $result = new stdClass();
        $result->event = 'purchase';
        $result->ecommerce = new stdClass();
        Utils::addProperty($result->ecommerce, 'transaction_id', $this->transactionId);
        Utils::addProperty($result->ecommerce, 'affiliation', $this->affiliation);
        Utils::addProperty($result->ecommerce, 'value', $this->value);
        Utils::addProperty($result->ecommerce, 'tax', $this->tax);
        Utils::addProperty($result->ecommerce, 'shipping', $this->shipping);
        Utils::addProperty($result->ecommerce, 'currency', $this->currency);
        Utils::addProperty($result->ecommerce, 'coupon', $this->coupon);
        Utils::addItems($result->ecommerce, $this->items);
        return $result;
    }
}
