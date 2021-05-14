<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Controller\Admin;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

class AdminController extends FrameworkBundleAdminController
{
    public function indexAction()
    {
        return $this->render(
            '@Modules/retailersmap/views/templates/admin/index.html.twig',
            [
                'enableSidebar' => true,
                'layoutTitle' => $this->trans(
                    'Retailers Map', 'Modules.Retailersmap.General'
                ),
                'layoutHeaderToolbarBtn' => $this->getToolbarButtons(),
            ]
        );
    }

    /**
     * @return array[]
     */
    private function getToolbarButtons()
    {
        return [
            'settings' => [
                'desc' => $this->trans(
                    'Settings', 'Modules.Retailersmap.Settings'
                ),
                'icon' => 'settings',
                'href' => $this->generateUrl('ps_retailersmap_settings'),
            ],
            'groups' => [
                'desc' => $this->trans('Groups', 'Modules.Retailersmap.Group'),
                'icon' => 'groups',
                'href' => $this->generateUrl('ps_retailersmap_group'),
            ],
            'retailers' => [
                'desc' => $this->trans(
                    'Retailers', 'Modules.Retailersmap.Retailer'
                ),
                'icon' => 'store',
                'href' => $this->generateUrl('ps_retailersmap_retailer'),
            ],
            'markers' => [
                'desc' => $this->trans(
                    'Markers', 'Modules.Retailersmap.Marker'
                ),
                'icon' => 'edit_location_alt',
                'href' => $this->generateUrl('ps_retailersmap_marker'),
            ],
        ];
    }
}
