<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use stdClass;
use ZdenekGebauer\GoogleTagManager\DataLayerContent;

class EventLogin extends DataLayerContent
{
    public ?string $method = null;

    public function jsonSerialize(): stdClass
    {
        $result = new stdClass();
        $result->event = 'login';
        Utils::addProperty($result, 'method', $this->method);
        return $result;
    }
}
