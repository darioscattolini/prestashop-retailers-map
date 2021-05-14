<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Grid\Retailer;

use Doctrine\DBAL\Connection;
use PrestaShop\PrestaShop\Core\Grid\Query\AbstractDoctrineQueryBuilder;
use PrestaShop\PrestaShop\Core\Grid\Search\SearchCriteriaInterface;

final class RetailerQueryBuilder extends AbstractDoctrineQueryBuilder
{
    /**
     * @var int
     */
    private $contextLangId;

    //@param int $contextShopId
    public function __construct(
        Connection $connection, string $dbPrefix, int $contextLangId
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

        $stateCondition = 'r.id_state = s.id_state';
        $langCondition = 'c.id_lang = '.$this->contextLangId;
        $countryCondition = $langCondition.' AND r.id_country = c.id_country';
        $groupCondition = 'r.id_group = g.id_group';

        return $this->connection
            ->createQueryBuilder()
            ->select('r.*')
            ->addSelect('s.name AS state')
            ->addSelect('c.name AS country')
            ->addSelect('g.name AS group_name')
            ->from($pr.'retailersmap_retailer', 'r')
            ->leftJoin('r', $pr.'state', 's', $stateCondition)
            ->leftJoin('r', $pr.'country_lang', 'c', $countryCondition)
            ->leftJoin('r', $pr.'retailersmap_group', 'g', $groupCondition);
            //->where('r.active = 1')
    }

    /**
     * {@inheritdoc}
     */
    public function getCountQueryBuilder(
        SearchCriteriaInterface $searchCriteria
    ) {
        return $this->connection
            ->createQueryBuilder()
            ->from($this->dbPrefix.'retailersmap_retailer', 'ret')
            ->select('COUNT(DISTINCT ret.id_retailer)');
    }
}
