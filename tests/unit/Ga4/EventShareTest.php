<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use UnitTester;
use ZdenekGebauer\GoogleTagManager\DataLayer;

class EventShareTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;

    public function testRender(): void
    {
        $method = 'Twitter';
        $contentType = 'image';
        $itemId = 'C_12345';
        $event = new EventShare();
        $event->method = $method;
        $event->contentType = $contentType;
        $event->itemId = $itemId;

        $json = $this->tester->grabJsonFromDataLayer((new DataLayer($event))->render());

        $this->tester->assertEquals('share', $json->event);
        $this->tester->assertEquals($method, $json->method);
        $this->tester->assertEquals($contentType, $json->content_type);
        $this->tester->assertEquals($itemId, $json->item_id);
    }
}
