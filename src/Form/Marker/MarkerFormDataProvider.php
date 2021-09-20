<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Marker;

use Doctrine\ORM\EntityManagerInterface;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapMarker as Marker;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataProvider\FormDataProviderInterface;

class MarkerFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getData($markerId)
    {
        $markerRepository = $this->entityManager->getRepository(Marker::class);

        /** @var Marker $marker */
        $marker = $markerRepository->findOneBy(['id' => $markerId]);

        $markerData = $marker->toArray();

        return $markerData;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultData()
    {
        return [];
    }
}
