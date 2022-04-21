<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use stdClass;
use ZdenekGebauer\GoogleTagManager\DataLayerContent;

class EventViewItem extends DataLayerContent
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
        $result->event = 'view_item';
        $result->ecommerce = new stdClass();
        Utils::addItems($result->ecommerce, $this->items);
        return $result;
    }
}
