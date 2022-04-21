<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use UnitTester;
use ZdenekGebauer\GoogleTagManager\DataLayer;

class EventSearchTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;

    public function testRender(): void
    {
        $searchTerm = 't-shirts';
        $event = new EventSearch();
        $event->searchTerm = $searchTerm;

        $json = $this->tester->grabJsonFromDataLayer((new DataLayer($event))->render());

        $this->tester->assertEquals('search', $json->event);
        $this->tester->assertEquals($searchTerm, $json->search_term);
    }

    public function testRequiredProperties(): void
    {
        $this->tester->expectThrowable(
            new \LogicException("'EventSearch' requires properties searchTerm"),
            static function () {
                new DataLayer(new EventSearch());
            }
        );
    }
}
