<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use UnitTester;
use ZdenekGebauer\GoogleTagManager\DataLayer;

class EcommerceResetTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;

    public function testRender(): void
    {
        $output = (new DataLayer(new EcommerceReset()))->render();
        $this->tester->assertEquals('window.dataLayer.push({"ecommerce":null});', $output);
    }
}
