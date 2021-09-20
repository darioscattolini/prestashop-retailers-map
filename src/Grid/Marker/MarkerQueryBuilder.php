<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Grid\Marker;

use Doctrine\DBAL\Connection;
use PrestaShop\PrestaShop\Core\Grid\Query\AbstractDoctrineQueryBuilder;
use PrestaShop\PrestaShop\Core\Grid\Search\SearchCriteriaInterface;

final class MarkerQueryBuilder extends AbstractDoctrineQueryBuilder
{
    /**
     * @var int
     */
    private $contextLangId;

    /**
     * @param string $dbPrefix
     * @param int    $contextLangId
     */
    //@param int $contextShopId
    public function __construct(
        Connection $connection, $dbPrefix, $contextLangId
    ) {
        parent::__construct($connection, $dbPrefix);

        $this->contextLangId = $contextLangId;
    }

    /**
     * {@inheritdoc}
     */
    public function getSearchQueryBuilder(
        SearchCriteriaInterface $searchCriteria
    ) {
        return $this->connection
            ->createQueryBuilder()
            ->from($this->dbPrefix.'retailersmap_marker', 'm')
            ->select('*');
    }

    /**
     * {@inheritdoc}
     */
    public function getCountQueryBuilder(SearchCriteriaInterface $searchCriteria)
    {
        return $this->connection
            ->createQueryBuilder()
            ->from($this->dbPrefix.'retailersmap_marker', 'm')
            ->select('COUNT(DISTINCT m.id_marker)');
    }
}
