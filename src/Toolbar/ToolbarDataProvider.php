<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Toolbar;

class ToolbarDataProvider
{
    /** @var ToolbarButtonData[] */
    private $toolbarData = [];

    public function __construct()
    {
        $this->buildData();
    }

    /**
     * @param string
     *
     * @return ToolbarButtonData[]
     */
    public function getDataFor(string $pageName)
    {
        return array_filter(
            $this->toolbarData,
            function (ToolbarButtonData $buttonData) use (&$pageName) {
                return $buttonData->name !== $pageName;
            }
        );
    }

    /**
     * @return void
     */
    private function buildData()
    {
        $rawData = [
            [
                'index', 
                'Back to start', 
                'Modules.Retailersmap.General', 
                'arrow_back', 
                'ps_retailersmap_index'
            ],[
                'settings', 
                'Settings', 
                'Modules.Retailersmap.Settings', 
                'settings', 
                'ps_retailersmap_settings'
            ], [
                'group', 
                'Groups', 
                'Modules.Retailersmap.Group', 
                'groups', 
                'ps_retailersmap_group'
            ], [
                'retailer', 
                'Retailers', 
                'Modules.Retailersmap.Retailer', 
                'store', 
                'ps_retailersmap_retailer'
            ], [
                'marker', 
                'Markers', 
                'Modules.Retailersmap.Marker', 
                'edit_location_alt', 
                'ps_retailersmap_marker'
            ],
        ];

        foreach ($rawData as $buttonData) {
            $this->toolbarData[] = new ToolbarButtonData(...$buttonData);
        }
    }
}
