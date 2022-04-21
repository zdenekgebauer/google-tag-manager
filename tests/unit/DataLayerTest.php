<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager;

use UnitTester;

class DataLayerTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;

    public function testRenderEmptyContent(): void
    {
        $content = new class extends DataLayerContent{
            public function jsonSerialize(): \stdClass {
                return new \stdClass();
            }
        };
        $this->tester->assertEquals('', (new DataLayer($content))->render());
    }

    public function testRender(): void
    {
        $content = new class extends DataLayerContent{
            public function jsonSerialize(): \stdClass {
                return (object)['pageTitle' => 'Home'];
            }
        };

        $dataLayer = new DataLayer($content);
        $this->tester->assertEquals('window.dataLayer.push({"pageTitle":"Home"});', $dataLayer->render());
    }
}
