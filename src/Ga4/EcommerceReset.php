<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use stdClass;
use ZdenekGebauer\GoogleTagManager\DataLayerContent;

class EcommerceReset extends DataLayerContent
{
    public function jsonSerialize(): stdClass
    {
        $result = new stdClass();
        $result->ecommerce = null;
        return $result;
    }
}
