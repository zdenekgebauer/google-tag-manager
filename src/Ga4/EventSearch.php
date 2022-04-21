<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use stdClass;
use ZdenekGebauer\GoogleTagManager\DataLayerContent;

class EventSearch extends DataLayerContent
{
    public ?string $searchTerm = null;

    public function __construct()
    {
        $this->requiredProperties = ['searchTerm'];
    }

    public function jsonSerialize(): stdClass
    {
        $result = new stdClass();
        $result->event = 'search';
        Utils::addProperty($result, 'search_term', $this->searchTerm);
        return $result;
    }
}
