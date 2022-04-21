<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use UnitTester;
use ZdenekGebauer\GoogleTagManager\DataLayer;

class EventPurchaseTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;

    public function testRender(): void
    {
        $transactionId = "T_12345";
        $affiliation = "Google Merchandise Store";
        $value = 25.42;
        $tax = 4.90;
        $shipping = 5.99;
        $currency = "USD";
        $coupon = "SUMMER_SALE";

        $product1itemId = "SKU_12345";
        $product1name = "Stan and Friends Tee";
        $product1affiliation = "Google Merchandise Store";
        $product1coupon = "SUMMER_FUN";
        $product1currency = "USD";
        $product1discount = 2.22;
        $product1brand = "Google";
        $product1category = "Apparel";
        $product1category2 = "Adult";
        $product1category3 = "Shirts";
        $product1category4 = "Crew";
        $product1category5 = "Short sleeve";
        $product1listId = "related_products";
        $product1listName = "Related Products";
        $product1variant = "green";
        $product1locationId = "L_12345";
        $product1price = 9.99;
        $product1quantity = 1;

        $event = new EventPurchase();
        $event->transactionId = $transactionId;
        $event->affiliation = $affiliation;
        $event->value = $value;
        $event->tax = $tax;
        $event->shipping = $shipping;
        $event->currency = $currency;
        $event->coupon = $coupon;

        $item = new Item($product1itemId, $product1name, $product1price, $product1quantity);
        $item->affiliation = $product1affiliation;
        $item->coupon = $product1coupon;
        $item->currency = $product1currency;
        $item->discount = $product1discount;
        $item->brand = $product1brand;
        $item->category = $product1category;
        $item->category2 = $product1category2;
        $item->category3 = $product1category3;
        $item->category4 = $product1category4;
        $item->category5 = $product1category5;
        $item->listId = $product1listId;
        $item->listName = $product1listName;
        $item->variant = $product1variant;
        $item->locationId = $product1locationId;

        $event->addItem($item);
        $event->addItem(new Item('423', 'Product 2'));

        $json = $this->tester->grabJsonFromDataLayer((new DataLayer($event))->render());
        $this->tester->assertEquals('purchase', $json->event);
        $this->tester->assertEquals($transactionId, $json->ecommerce->transaction_id);
        $this->tester->assertEquals($affiliation, $json->ecommerce->affiliation);
        $this->tester->assertEquals($value, $json->ecommerce->value);
        $this->tester->assertEquals($tax, $json->ecommerce->tax);
        $this->tester->assertEquals($shipping, $json->ecommerce->shipping);
        $this->tester->assertEquals($currency, $json->ecommerce->currency);
        $this->tester->assertEquals($coupon, $json->ecommerce->coupon);

        $this->tester->assertCount(2, $json->ecommerce->items);
        $this->tester->assertEquals($product1itemId, $json->ecommerce->items[0]->item_id);
        $this->tester->assertEquals($product1name, $json->ecommerce->items[0]->item_name);
        $this->tester->assertEquals($product1affiliation, $json->ecommerce->items[0]->affiliation);
        $this->tester->assertEquals($product1coupon, $json->ecommerce->items[0]->coupon);
        $this->tester->assertEquals($product1currency, $json->ecommerce->items[0]->currency);
        $this->tester->assertEquals($product1discount, $json->ecommerce->items[0]->discount);
        $this->tester->assertEquals(0, $json->ecommerce->items[0]->index);
        $this->tester->assertEquals($product1brand, $json->ecommerce->items[0]->item_brand);
        $this->tester->assertEquals($product1category, $json->ecommerce->items[0]->item_category);
        $this->tester->assertEquals($product1category2, $json->ecommerce->items[0]->item_category2);
        $this->tester->assertEquals($product1category3, $json->ecommerce->items[0]->item_category3);
        $this->tester->assertEquals($product1category4, $json->ecommerce->items[0]->item_category4);
        $this->tester->assertEquals($product1category5, $json->ecommerce->items[0]->item_category5);
        $this->tester->assertEquals($product1listId, $json->ecommerce->items[0]->item_list_id);
        $this->tester->assertEquals($product1listName, $json->ecommerce->items[0]->item_list_name);
        $this->tester->assertEquals($product1variant, $json->ecommerce->items[0]->item_variant);
        $this->tester->assertEquals($product1locationId, $json->ecommerce->items[0]->location_id);
        $this->tester->assertEquals($product1price, $json->ecommerce->items[0]->price);
        $this->tester->assertEquals($product1quantity, $json->ecommerce->items[0]->quantity);
    }

    public function testRequiredProperties(): void
    {
        $this->tester->expectThrowable(
            new \LogicException("'EventPurchase' requires properties transactionId, value, currency"),
            static function () {
                new DataLayer(new EventPurchase());
            }
        );

        $this->tester->expectThrowable(
            new \LogicException("'EventPurchase' requires items"),
            static function () {
                $event = new EventPurchase();
                $event->transactionId = '1';
                $event->value = 12.3;
                $event->currency = 'EUR';
                new DataLayer($event);
            }
        );
    }

    public function testAddInvalidItem(): void
    {
        $this->tester->expectThrowable(
            new \LogicException('Either itemId or name is required'),
            static function () {
                $event = new EventPurchase();
                $item = new Item();
                $event->addItem($item);
            }
        );
    }
}
