<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use stdClass;
use ZdenekGebauer\GoogleTagManager\DataLayerContent;

class EventViewCart extends DataLayerContent
{
    use ItemsTrait;

    public ?string $currency = null;

    public ?float $value = null;

    public function __construct()
    {
        $this->requiredProperties = ['value', 'currency'];
    }

    public function assertValid(): void
    {
        parent::assertValid();
        $this->assertValidItems();
    }

    public function jsonSerialize(): stdClass
    {
        $result = new stdClass();
        $result->event = 'view_cart';
        $result->ecommerce = new stdClass();
        Utils::addProperty($result->ecommerce, 'value', $this->value);
        Utils::addProperty($result->ecommerce, 'currency', $this->currency);
        Utils::addItems($result->ecommerce, $this->items);
        return $result;
    }
}
