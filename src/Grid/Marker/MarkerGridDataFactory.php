<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Grid\Marker;

use Doctrine\DBAL\Query\QueryBuilder;
use PDO;
use PrestaShop\PrestaShop\Core\Grid\Data\Factory\GridDataFactoryInterface;
use PrestaShop\PrestaShop\Core\Grid\Data\GridData;
use PrestaShop\PrestaShop\Core\Grid\Query\QueryParserInterface;
use PrestaShop\PrestaShop\Core\Grid\Record\RecordCollection;
use PrestaShop\PrestaShop\Core\Grid\Search\SearchCriteriaInterface;
use PrestaShop\PrestaShop\Core\Hook\HookDispatcherInterface;
use Symfony\Component\DependencyInjection\Container;

final class MarkerGridDataFactory implements GridDataFactoryInterface
{
    /**
     * @var MarkerQueryBuilder
     */
    private $markerQueryBuilder;

    /**
     * @var HookDispatcherInterface
     */
    private $hookDispatcher;

    /**
     * @var QueryParserInterface
     */
    private $queryParser;

    /**
     * @var string
     */
    private $gridId;

    /**
     * @var string
     */
    private $_ICON_DIR_;

    /**
     * @param MarkerQueryBuilder $markerQueryBuilder
     * @param HookDispatcherInterface $hookDispatcher
     * @param QueryParserInterface $queryParser
     * @param string $gridId
     */
    public function __construct(
        MarkerQueryBuilder $markerQueryBuilder,
        HookDispatcherInterface $hookDispatcher,
        QueryParserInterface $queryParser,
        $gridId
    ) {
        $this->markerQueryBuilder = $markerQueryBuilder;
        $this->hookDispatcher = $hookDispatcher;
        $this->queryParser = $queryParser;
        $this->gridId = $gridId;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(SearchCriteriaInterface $searchCriteria)
    {
        $searchQueryBuilder = $this->markerQueryBuilder
            ->getSearchQueryBuilder($searchCriteria);
        $countQueryBuilder = $this->markerQueryBuilder
            ->getCountQueryBuilder($searchCriteria);

        $this->hookDispatcher->dispatchWithParameters(
            'action' . Container::camelize($this->gridId) . 'GridQueryBuilderModifier', 
            [
                'search_query_builder' => $searchQueryBuilder,
                'count_query_builder' => $countQueryBuilder,
                'search_criteria' => $searchCriteria,
            ]
        );

        $records = $searchQueryBuilder->execute()->fetchAll();
        
        $records = $this->transformIconPaths($records);
        
        $recordsTotal = (int) $countQueryBuilder->execute()
            ->fetch(PDO::FETCH_COLUMN);

        $records = new RecordCollection($records);
        
        return new GridData(
            $records,
            $recordsTotal,
            $this->getRawQuery($searchQueryBuilder)
        );
    }

    /**
     * @param string $_ICON_DIR_
     * 
     */
    public function setIconDir($_ICON_DIR_) {
        $this->_ICON_DIR_ = 
            _PS_BASE_URL_ . _MODULE_DIR_ . 'retailersmap/' . $_ICON_DIR_;
    }

    /**
     * @param QueryBuilder $queryBuilder
     *
     * @return string
     */
    private function getRawQuery(QueryBuilder $queryBuilder)
    {
        $query = $queryBuilder->getSQL();
        $parameters = $queryBuilder->getParameters();

        return $this->queryParser->parse($query, $parameters);
    }

    /**
     * @param array $records
     */
    private function transformIconPaths(array $records) {
        return array_map(function ($record) {
            if (isset($record['file_name_default'])) {
                $record['file_name_default'] 
                    = $this->_ICON_DIR_ . $record['file_name_default'];
            }

            if (isset($record['file_name_retina'])) {
                $record['file_name_retina'] 
                    = $this->_ICON_DIR_ . $record['file_name_retina'];
            }
            
            return $record;
        }, $records);
    }
}
