<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Group;

use Doctrine\ORM\EntityManagerInterface;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapGroup as Group;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;

final class GroupChoiceProvider implements FormChoiceProviderInterface
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
        $groupRepository = $this->entityManager->getRepository(Group::class);

        /** @var Group[] $groups */
        $groups = $groupRepository->findAll();

        $choices = [];

        foreach ($groups as $group) {
            $choices[$group->getName()] = $group->getId();
        }

        return $choices;
    }
}
