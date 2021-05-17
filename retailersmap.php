<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManagerInterface;
use PrestaShop\Module\RetailersMap\Database\Installer;
use PrestaShop\Module\RetailersMap\Database\Settings;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapGroup as Group;
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
        $cmsPageId = Settings::getInstance()->getSettings()['cmsPageId'];

        if ($callerPageId === $cmsPageId || $callerPageId === 'moduleAdmin') {
            $this->assignSmartyVariables();

            return $this->display(__FILE__, 'retailersmap.tpl');
        }
    }

    public function getData(int $langId): array
    {
        $settings = $this->getSettings();
        $retailers = $this->getRetailers($langId);
        $groups = $this->getGroups();

        return [
            'settings' => $settings,
            'retailers' => $retailers,
            'groups' => $groups,
        ];
    }

    /**
     * @return array
     */
    private function getSettings(): array
    {
        $tilesProvider = Settings::getInstance()->getSettings()['tilesProvider'];
        return [
            'mediaPath' => _PS_BASE_URL_ . $this->_path . 'views/',
            'containerId' => 'retailers-map',
            'defaultCenter' => [40.36418119493289, -3.7638643864609374],
            'defaultZoom' => 6,
            'tilesProvider' => $tilesProvider,
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
            $group = $ret->getGroup()->getId();

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
                'group' => $group,
                'singularMarker' => $ret->getSingularMarker(),
                'singularRetinaMarker' => $ret->getSingularRetinaMarker(),
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
                'marker' => $group->getGroupMarker(),
                'retinaMarker' => $group->getGroupRetinaMarker(),
                'stackOrder' => $group->getStackOrder(),
            ];
        }, $groups);

        return $processedGroups;
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

    /** @return array */
    private function assignSmartyVariables()
    {
        $mapHeight = Settings::getInstance()->getSettings()['mapHeight'];
        $jsLink = $this->_path.'views/js/dist/common.bundle.js';
        $mapDataLink = (new Link())->getModuleLink(
            'retailersmap',
            'data',
            ['ajax' => true]
        );
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
            'height' => $mapHeight,
            'jsLink' => $jsLink,
            'mapDataLink' => $mapDataLink,
            'stylesheetLink' => $stylesheetLink,
            'searchPlaceholder' => $searchPlaceholder,
            'searchNoResult' => $searchNoResult,
            'searchManyResults' => $searchManyResults,
        ]);
    }
}
