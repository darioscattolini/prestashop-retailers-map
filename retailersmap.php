<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManagerInterface;
use PrestaShop\Module\RetailersMap\Database\Installer;
use PrestaShop\Module\RetailersMap\Database\Settings;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapGroup as Group;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapMarker as Marker;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapRetailer as Retailer;
use PrestaShop\PrestaShop\Adapter\Entity\Country;
use PrestaShop\PrestaShop\Adapter\SymfonyContainer;

if (!defined('_PS_VERSION_')) {
    exit;
}

if (file_exists(__DIR__.'/vendor/autoload.php')) {
    require_once __DIR__.'/vendor/autoload.php';
}

class RetailersMap extends Module
{
    public function __construct()
    {
        $this->name = 'retailersmap';
        $this->author = 'Darío Scattolini';
        $this->version = '1.0.0';
        $this->ps_versions_compliancy = [
            'min' => '1.7.6',
            'max' => _PS_VERSION_,
        ];

        /*  NOT IN SAMPLE MODULE
            $this->tab = 'front_office_features';
            $this->need_instance = 0;

            $this->bootstrap = true;
            */
        parent::__construct();

        $this->displayName = $this->l('Retailers Map');
        $this->description = $this->l(
            'Manage a list of retailers locations and display them in a Leaflet map.'
        );

        /* NOT IN SAMPLE MODULE
            $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

            $this->db = \Db::getInstance();*/
    }

    public function isUsingNewTranslationSystem()
    {
        return true;
    }

    public function install()
    {
        /* NOT IN SAMPLE MODULE
            if (Shop::isFeatureActive()) {
              Shop::setContext(Shop::CONTEXT_ALL);
            }
            */

        return $this->installTables()
            && parent::install()
            && $this->registerHook('displayRetailersMap');
    }

    public function uninstall()
    {
        return $this->removeTables()
            && $this->removeSettings()
            && parent::uninstall();
    }

    public function getContent()
    {
        Tools::redirectAdmin(
            $this->context->link->getAdminLink('AdminRetailersmap')
        );
    }

    // Modificar toma de datos de front office usando repository
    public function hookDisplayRetailersMap($params)
    {
        $callerPageId = $params['pageId'];

        $rawSettings = $callerPageId === 'preview' 
            ? $params['settings']
            : Settings::getInstance()->getSettings();
        
        $cmsPageId = $rawSettings['cmsPageId'];

        $validCallers = [$cmsPageId, 'moduleAdmin', 'preview'];

        if (in_array($callerPageId, $validCallers)) {
            unset($rawSettings['cmsPageId']);

            $settings = $this->transformSettings($rawSettings);
            
            $this->assignSmartyVariables($settings);

            return $this->display(__FILE__, 'retailersmap.tpl');
        }
    }

    public function getData(int $langId): array
    {
        $retailers = $this->getRetailers($langId);
        $groups = $this->getGroups();
        $markers = $this->getMarkers();

        return [
            'retailers' => $retailers,
            'groups' => $groups,
            'markers' => $markers
        ];
    }

    /**
     * @return array
     */
    private function getRetailers(int $langId): array
    {
        /** @var EntityManagerInterface */
        $entityManager = $this->get('doctrine.orm.default_entity_manager');

        $repository = $entityManager->getRepository(Retailer::class);
        $retailers = $repository->findAll();

        $processedRetailers = array_map(function (Retailer $ret) use ($langId) {
            $country = Country::getNameById($langId, $ret->getIdCountry());
            $state = State::getNameById($ret->getIdState());
            $group = $ret->getGroup();
            $marker = $ret->getMarker() ?? $ret->getGroup()->getMarker();

            return [
                'name' => $ret->getName(),
                'address' => $ret->getAddress(),
                'postcode' => $ret->getPostcode(),
                'city' => $ret->getCity(),
                'state' => $state,
                'country' => $country,
                'latitude' => $ret->getLatitude(),
                'longitude' => $ret->getLongitude(),
                'phone' => $ret->getPhone(),
                'email' => $ret->getEmail(),
                'group' => $group->getId(),
                'markerId' => $marker ? $marker->getId() : null
            ];
        }, $retailers);

        return $processedRetailers;
    }

    /**
     * @return array
     */
    private function getGroups(): array
    {
        /** @var EntityManagerInterface */
        $entityManager = $this->get('doctrine.orm.default_entity_manager');

        $repository = $entityManager->getRepository(Group::class);
        $groups = $repository->findAll();

        $processedGroups = array_map(function (Group $group) {
            return [
                'id' => $group->getId(),
                'stackOrder' => $group->getStackOrder(),
            ];
        }, $groups);

        return $processedGroups;
    }

    /**
     * @return array
     */
    private function getMarkers(): array
    {
        /** @var EntityManagerInterface */
        $entityManager = $this->get('doctrine.orm.default_entity_manager');

        $repository = $entityManager->getRepository(Marker::class);
        $markers = $repository->findAll();

        $processedMarkers = array_map(function (Marker $marker) {
            $_ICON_DIR_ = _PS_BASE_URL_ . $this->_path . '/views/img/';

            $iconSize = array($marker->getIconWidth(), $marker->getIconHeight());
            $iconAnchor = array($marker->getAnchorX(), $marker->getAnchorY());
            
            // Currently non configurable:
            $popupAnchor = array(1, -34);
            $shadowSize = array(41, 41);
            $shadowUrl = $_ICON_DIR_ . 'marker-shadow.png';
            $shadowAnchor = array(12, 41);
            $tooltipAnchor = array(16, -28);

            return [
                'id' => $marker->getId(),
                'iconUrl' => $_ICON_DIR_ . $marker->getFileNameDefault(),
                'retinaMarker' => $_ICON_DIR_ . $marker->getFileNameRetina(),
                'iconSize' => $iconSize,
                'iconAnchor' => $iconAnchor,
                'popupAnchor' => $popupAnchor,
                'shadowSize' => $shadowSize,
                'shadowUrl' => $shadowUrl,
                'shadowAnchor' => $shadowAnchor,
                'tooltipAnchor' => $tooltipAnchor,
            ];
        }, $markers);

        return $processedMarkers;
    }

    /**
     * @return string
     */
    private function transformSettings($settings): string
    {   
        $settings['height'] = strval($settings['height']) . 'px';
        $dataLink = (new Link())->getModuleLink(
            'retailersmap',
            'data',
            ['ajax' => true]
        );

        $settings['containerId'] = 'retailers-map';
        $settings['defaultCenter'] = [40.36418119493289, -3.7638643864609374];
        $settings['defaultZoom'] = 6;
        $settings['dataLink'] = $dataLink;

        return json_encode($settings);
    }

    /**
     * @return bool
     */
    private function installTables()
    {
        /** @var Installer $installer */
        $installer = $this->getInstaller();
        $errors = $installer->createTables();

        return empty($errors);
    }

    /**
     * @return bool
     */
    private function removeTables()
    {
        /** @var Installer $installer */
        $installer = $this->getInstaller();
        $errors = $installer->dropTables();

        return empty($errors);
    }

    /**
     * @return bool
     */
    private function removeSettings()
    {
        /** @var Installer $installer */
        $installer = $this->getInstaller();
        $errors = $installer->removeSettings();

        return empty($errors);
    }

    /**
     * @return Installer
     */
    private function getInstaller()
    {
        try {
            $installer = $this->get('prestashop.module.retailers_map.installer');
        } catch (Exception $e) {
            // Catch exception in case container is not available, or service is not available
            $installer = null;
        }

        // During install process the modules's service is not available yet so we build it manually
        if (!$installer) {
            $symfonyContainer = SymfonyContainer::getInstance();

            $installer = new Installer(
                $this->get('doctrine.dbal.default_connection'),
                $symfonyContainer->getParameter('database_prefix'),
                $symfonyContainer->getParameter('database_engine')
            );
        }

        return $installer;
    }

    /** 
     * @param string $settings
     * 
     * @return array 
     */
    private function assignSmartyVariables(string $settings)
    {
        $jsLink = $this->_path.'views/js/dist/common.bundle.js';
        $stylesheetLink = $this->_path.'views/css/retailersmap.css';
        $searchPlaceholder = $this->trans(
            'Search by city or postcode',
            [],
            'Modules.Retailersmap.Shop'
        );
        $searchNoResult = $this->trans(
            'We don\'t have retailers in that location',
            [],
            'Modules.Retailersmap.Shop'
        );
        $searchManyResults = $this->trans(
            'Did you mean one of the following?',
            [],
            'Modules.Retailersmap.Shop'
        );

        $this->context->smarty->assign([
            'settings' => $settings,
            'jsLink' => $jsLink,
            'stylesheetLink' => $stylesheetLink,
            'searchPlaceholder' => $searchPlaceholder,
            'searchNoResult' => $searchNoResult,
            'searchManyResults' => $searchManyResults,
        ]);
    }
}
