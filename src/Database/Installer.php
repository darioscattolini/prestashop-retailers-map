<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Database;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Statement;

class Installer
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var string
     */
    private $dbPrefix;

    /**
     * @var string
     */
    private $mysqlEngine;

    /**
     * @param string $dbPrefix
     * @param string $mysqlEngine
     */
    public function __construct(Connection $connection, $dbPrefix, $mysqlEngine)
    {
        $this->connection = $connection;
        $this->dbPrefix = $dbPrefix;
        $this->mysqlEngine = $mysqlEngine;
    }

    /**
     * @return array
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function createTables()
    {
        $errors = [];
        $this->dropTables();

        $retailerInstallFile = __DIR__.'/../../Resources/data/retailer.sql';
        $groupInstallFile = __DIR__.'/../../Resources/data/group.sql';
        $markerInstallFile = __DIR__.'/../../Resources/data/marker.sql';
        $queryFiles = [
            $retailerInstallFile, $groupInstallFile, $markerInstallFile
        ];

        foreach ($queryFiles as $file) {
            $content = file_get_contents($file);
            $query = str_replace('PREFIX_', $this->dbPrefix, $content);
            $query = str_replace('MYSQLENGINE', $this->mysqlEngine, $query);

            if (empty($query)) {
                continue;
            }

            $statement = $this->connection->executeQuery($query);

            if (
                $statement instanceof Statement 
                && 0 != (int) $statement->errorCode()
            ) {
                $errors[] = [
                    'key' => json_encode($statement->errorInfo()),
                    'parameters' => [],
                    'domain' => 'Admin.Modules.Notification',
                ];
            }
        }

        return $errors;
    }

    /**
     * @return array
     *
     * @throws DBALException
     */
    public function dropTables()
    {
        $errors = [];
        $tableNames = [
            'retailersmap_retailer', 'retailersmap_group', 'retailersmap_marker'
        ];

        foreach ($tableNames as $tableName) {
            $sql = 'DROP TABLE IF EXISTS '.$this->dbPrefix.$tableName;
            $statement = $this->connection->executeQuery($sql);
            
            if (
                $statement instanceof Statement 
                && 0 != (int) $statement->errorCode()
            ) {
                $errors[] = [
                    'key' => json_encode($statement->errorInfo()),
                    'parameters' => [],
                    'domain' => 'Admin.Modules.Notification',
                ];
            }
        }

        return $errors;
    }

    /**
     * @return array
     *
     * @throws PrestaShopDatabaseException #check
     */
    public function removeSettings()
    {
        return Settings::getInstance()->deleteSettings();
    }
}
