<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use UnitTester;
use ZdenekGebauer\GoogleTagManager\DataLayer;

class EventLoginTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;

    public function testRender(): void
    {
        $method = "Google";
        $event = new EventLogin();
        $event->method = $method;

        $json = $this->tester->grabJsonFromDataLayer((new DataLayer($event))->render());

        $this->tester->assertEquals('login', $json->event);
        $this->tester->assertEquals($method, $json->method);
    }
}
