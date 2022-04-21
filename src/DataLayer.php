<?php

declare(strict_types=1);

namespace ZdenekGebauer\GoogleTagManager;

class DataLayer
{
    private DataLayerContent $content;

    public function __construct(DataLayerContent $content)
    {
        $content->assertValid();
        $this->content = $content;
    }

    /**
     * @throws \JsonException
     */
    public function render(): string
    {
        $encoded = json_encode($this->content, JSON_THROW_ON_ERROR);
        return ($encoded === '{}' ? '' : 'window.dataLayer.push(' . $encoded . ');');
    }
}
