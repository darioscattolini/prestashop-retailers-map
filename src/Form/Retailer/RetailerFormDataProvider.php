<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Retailer;

use Doctrine\ORM\EntityManagerInterface;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapRetailer as Retailer;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataProvider\FormDataProviderInterface;

class RetailerFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var int
     */
    private $defaultCountryId;

    public function __construct(
        EntityManagerInterface $entityManager,
        int $defaultCountryId
    ) {
        $this->entityManager = $entityManager;
        $this->defaultCountryId = $defaultCountryId;
    }

    /**
     * {@inheritdoc}
     */
    public function getData($retailerId)
    {
        $retailerRepository = $this->entityManager
            ->getRepository(Retailer::class);

        /** @var Retailer $retailer */
        $retailer = $retailerRepository->findOneBy(['id' => $retailerId]);

        $retailerData = $retailer->toArray();

        return $retailerData;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultData()
    {
        return [
            'id_country' => $this->defaultCountryId,
            'active' => true,
        ];
    }
}
