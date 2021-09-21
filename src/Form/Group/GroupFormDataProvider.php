<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Group;

use Doctrine\ORM\EntityManagerInterface;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapGroup as Group;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataProvider\FormDataProviderInterface;

class GroupFormDataProvider implements FormDataProviderInterface
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
    public function getData($groupId)
    {
        $groupRepository = $this->entityManager->getRepository(Group::class);

        /** @var Group $group */
        $group = $groupRepository->findOneBy(['id' => $groupId]);

        $groupData = $group->toArray();

        return $groupData;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultData()
    {
        return [
            'name' => '',
            'stackOrder' => 0,
        ];
    }
}
