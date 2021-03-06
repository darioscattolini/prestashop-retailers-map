<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Grid\Group;

use Doctrine\DBAL\Connection;
use PrestaShop\PrestaShop\Core\Grid\Query\AbstractDoctrineQueryBuilder;
use PrestaShop\PrestaShop\Core\Grid\Search\SearchCriteriaInterface;

final class GroupQueryBuilder extends AbstractDoctrineQueryBuilder
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
        $pr = $this->dbPrefix;

        return $this->connection
            ->createQueryBuilder()
            ->select('g.*')
            ->addSelect('m.name AS marker_name')
            ->from($pr . 'retailersmap_group', 'g')
            ->leftJoin('g', $pr.'retailersmap_marker', 'm', 'g.id_marker = m.id_marker');
    }

    /**
     * {@inheritdoc}
     */
    public function getCountQueryBuilder(SearchCriteriaInterface $searchCriteria)
    {
        return $this->connection
            ->createQueryBuilder()
            ->from($this->dbPrefix.'retailersmap_group', 'rg')
            ->select('COUNT(DISTINCT rg.id_group)');
    }
}
