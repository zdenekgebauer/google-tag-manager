<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager;

use JsonSerializable;
use LogicException;
use stdClass;

use function get_class;

abstract class DataLayerContent extends stdClass implements JsonSerializable
{
    /**
     * @var array<string>
     */
    protected array $requiredProperties = [];

    /**
     * @throws LogicException
     */
    public function assertValid(): void
    {
        $missingRequiredProperties = [];
        foreach ($this->requiredProperties as $propertyName) {
            if ($this->{$propertyName} === null) {
                $missingRequiredProperties[] = $propertyName;
            }
        }
        if (!empty($missingRequiredProperties)) {
            $className = basename(str_replace('\\', '/', get_class($this)));
            throw new LogicException("'$className' requires properties " . implode(', ', $missingRequiredProperties));
        }
    }

    abstract public function jsonSerialize(): stdClass;
}
