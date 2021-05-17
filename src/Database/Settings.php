<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Database;

use Configuration;
use Exception;

class Settings
{
    private static $instance;

    private $configName = 'RETAILERS_MAP_SETTINGS';

    private $fields = ['cmsPageId', 'mapHeight', 'tilesProvider'];

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Settings();
        }

        return self::$instance;
    }

    /**
     * @return array
     *
     * @throws PrestaShopDatabaseException #check
     */
    public function getSettings()
    {
        // $errors = [];
        $rawSettings = Configuration::get($this->configName);

        /* No se puede porque debe devoler valor
        if (!$rawSettings) {
          $errors[] = [
            'key' => 'Could not retrieve settings from Configuration table',
            'parameters' => [],
            'domain' => 'Admin.Modules.Notification',
          ];
        }*/

        if ($rawSettings) {
            return unserialize($rawSettings);
        }
    }

    /**
     * @param array $settings
     *
     * @return array
     *
     * @throws PrestaShopDatabaseException #check
     * @throws Exception
     */
    public function updateSettings($settings)
    {
        $errors = [];

        foreach ($settings as $field => $value) {
            if (!in_array($field, $this->fields)) {
                throw new Exception('Wrong settings field name: '.$field);
            }

            if (!$this->validate($field, $value)) {
                throw new Exception($value.'is a wrong value for: '.$field);
            }
        }

        $serializedSettings = serialize($settings);

        $result = Configuration::updateValue(
            $this->configName, $serializedSettings
        );

        if (!$result) {
            $errors[] = [
                'key' => 'Could not update settings in Configuration table',
                'parameters' => [],
                'domain' => 'Admin.Modules.Notification',
            ];
        }

        return $errors;
    }

    /**
     * @return array
     *
     * @throws PrestaShopDatabaseException #check
     */
    public function deleteSettings()
    {
        $errors = [];
        $result = Configuration::deleteByName($this->configName);

        if (!$result) {
            $errors[] = [
                'key' => 'Could not delete settings from Configuration table',
                'domain' => 'Admin.Modules.Notification',
                'parameters' => [],
            ];
        }

        return $errors;
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return bool
     */
    private function validate($field, $value)
    {
        switch ($field) {
            case 'cmsPageId':
                return is_int($value) && $value >= 0;
            case 'mapHeight':
                return is_int($value) && $value >= 0 && $value <= 1000;
            case 'tilesProvider':
                return in_array($value, [
                    'OpenStreetMap.Mapnik',
                    'OpenStreetMap.DE',
                    'OpenStreetMap.CH',
                    'OpenStreetMap.France',
                    'OpenStreetMap.HOT',
                    'OpenStreetMap.BZH',
                    'Stadia.AlidadeSmooth',
                    'Stadia.AlidadeSmoothDark',
                    'Stadia.OSMBright',
                    'Stadia.Outdoors',
                    'CyclOSM',
                    'Stamen.Toner',
                    'Stamen.TonerBackground',
                    'Stamen.TonerLife',
                    'Stamen.Watercolor',
                    'Esri.WorldStreetMap',
                    'Esri.DeLorme',
                    'Esri.WorldTopoMap',
                    'Esri.WorldImagery',
                    'CartoDB.Positron',
                    'CartoDB.Voyager',
                    'CartoDB.VoyagerLabelsUnder',
                    'HikeBike.HikeBike',
                ]);
        }
    }
}
