<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use stdClass;
use ZdenekGebauer\GoogleTagManager\DataLayerContent;

class EventBeginCheckout extends DataLayerContent
{
    use ItemsTrait;

    public function assertValid(): void
    {
        parent::assertValid();
        $this->assertValidItems();
    }

    public function jsonSerialize(): stdClass
    {
        $result = new stdClass();
        $result->event = 'begin_checkout';
        $result->ecommerce = new stdClass();
        Utils::addItems($result->ecommerce, $this->items);
        return $result;
    }
}
