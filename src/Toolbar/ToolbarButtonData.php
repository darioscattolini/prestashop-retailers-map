<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Toolbar;

class ToolbarButtonData
{
    /** @var string */
    public $name;

    /** @var string */
    public $descriptionContent;

    /** @var string */
    public $descriptionDomain;

    /** @var string */
    public $icon;

    /** @var string */
    public $route;

    public function __construct(
        string $name,
        string $descriptionContent,
        string $descriptionDomain,
        string $icon,
        string $route
    ) {
        $this->name = $name;
        $this->descriptionContent = $descriptionContent;
        $this->descriptionDomain = $descriptionDomain;
        $this->icon = $icon;
        $this->route = $route;
    }
}
