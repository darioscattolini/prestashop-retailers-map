<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Marker;

use Doctrine\ORM\EntityManagerInterface;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapMarker as Marker;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;

final class MarkerChoiceProvider implements FormChoiceProviderInterface
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
    public function getChoices()
    {
        $groupRepository = $this->entityManager->getRepository(Marker::class);

        /** @var Marker[] $groups */
        $markers = $groupRepository->findAll();

        $choices = [];

        foreach ($markers as $marker) {
            $choices[$marker->getName()] = $marker->getId();
        }

        return $choices;
    }
}
