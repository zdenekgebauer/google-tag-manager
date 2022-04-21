<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use stdClass;
use ZdenekGebauer\GoogleTagManager\DataLayerContent;

class EventShare extends DataLayerContent
{
    public ?string $method = null;

    public ?string $contentType = null;

    public ?string $itemId = null;

    public function jsonSerialize(): stdClass
    {
        $result = new stdClass();
        $result->event = 'share';
        Utils::addProperty($result, 'method', $this->method);
        Utils::addProperty($result, 'content_type', $this->contentType);
        Utils::addProperty($result, 'item_id', $this->itemId);
        return $result;
    }
}
