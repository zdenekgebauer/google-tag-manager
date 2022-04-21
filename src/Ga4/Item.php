<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use LogicException;

/**
 * @see https://developers.google.com/analytics/devguides/collection/ga4/reference/events#purchase_item
 */
class Item
{
    public ?string $itemId;

    public ?string $name;

    public ?string $affiliation = null;

    public ?string $coupon = null;

    public ?string $currency = null;

    public ?float $discount = null;

    public ?string $brand = null;

    public ?string $category = null;

    public ?string $category2 = null;

    public ?string $category3 = null;

    public ?string $category4 = null;

    public ?string $category5 = null;

    public ?string $listId = null;

    public ?string $listName = null;

    public ?string $variant = null;

    public ?string $locationId = null;

    public ?float $price;

    public ?int $quantity;

    public function __construct(string $itemId = null, string $name = null, float $price = null, int $quantity = null)
    {
        $this->itemId = $itemId;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function assertValidProperties(): void
    {
        if (($this->itemId === null || $this->itemId === '') && ($this->name === null || $this->name === '')) {
            throw new LogicException('Either itemId or name is required');
        }
    }
}
