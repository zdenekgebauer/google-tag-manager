<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use stdClass;

class Utils
{
    /**
     * add property if value is set
     * @param stdClass $data
     * @param string $propertyName
     * @param int|float|string|null $propertyValue
     */
    public static function addProperty(stdClass $data, string $propertyName, int|float|string|null $propertyValue): void
    {
        if ($propertyValue !== null) {
            $data->{$propertyName} = $propertyValue;
        }
    }

    /**
     * @param array<Item> $eventItems
     */
    public static function addItems(stdClass $data, array $eventItems): void
    {
        $index = 0;
        foreach ($eventItems as $eventItem) {
            $dataLayerItem = new stdClass();
            $dataLayerItem->item_id = $eventItem->itemId;
            $dataLayerItem->item_name = $eventItem->name;
            self::addProperty($dataLayerItem, 'affiliation', $eventItem->affiliation);
            self::addProperty($dataLayerItem, 'coupon', $eventItem->coupon);
            self::addProperty($dataLayerItem, 'currency', $eventItem->currency); // overwrite event-level currency
            self::addProperty($dataLayerItem, 'discount', $eventItem->discount);
            self::addProperty($dataLayerItem, 'discount', $eventItem->discount);
            $dataLayerItem->index = $index++;
            self::addProperty($dataLayerItem, 'item_brand', $eventItem->brand);
            self::addProperty($dataLayerItem, 'item_category', $eventItem->category);
            self::addProperty($dataLayerItem, 'item_category2', $eventItem->category2);
            self::addProperty($dataLayerItem, 'item_category3', $eventItem->category3);
            self::addProperty($dataLayerItem, 'item_category4', $eventItem->category4);
            self::addProperty($dataLayerItem, 'item_category5', $eventItem->category5);
            self::addProperty($dataLayerItem, 'item_list_id', $eventItem->listId);
            self::addProperty($dataLayerItem, 'item_list_name', $eventItem->listName);
            self::addProperty($dataLayerItem, 'item_variant', $eventItem->variant);
            self::addProperty($dataLayerItem, 'location_id', $eventItem->locationId);
            $dataLayerItem->price = $eventItem->price;
            $dataLayerItem->quantity = $eventItem->quantity;

            $data->items[] = $dataLayerItem;
        }
    }
}
