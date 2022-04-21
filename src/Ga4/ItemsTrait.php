<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager\Ga4;

use LogicException;

use function get_class;

trait ItemsTrait
{
    /**
     * @var array<Item>
     */
    protected array $items = [];

    public function addItem(Item $item): void
    {
        $item->assertValidProperties();
        $this->items[] = $item;
    }

    protected function assertValidItems(): void
    {
        if (empty($this->items)) {
            $className = basename(str_replace('\\', '/', get_class($this)));
            throw new LogicException("'$className' requires items");
        }
    }
}
