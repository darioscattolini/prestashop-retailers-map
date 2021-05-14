<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Group;

use Doctrine\ORM\EntityManagerInterface;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapGroup as Group;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataHandler\FormDataHandlerInterface;

class GroupFormDataHandler implements FormDataHandlerInterface
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
    public function create(array $data)
    {
        $group = new Group();
        $group
            ->setName($data['name'])
            ->setGroupMarker($data['groupMarker'])
            ->setGroupRetinaMarker($data['groupRetinaMarker'])
            ->setStackOrder($data['stackOrder']);

        $this->entityManager->persist($group);
        $this->entityManager->flush();

        return $group->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $groupRepository = $this->entityManager->getRepository(Group::class);

        /** @var Group $group */
        $group = $groupRepository->findOneBy(['id' => $id]);

        $group->setName($data['name'])
            ->setGroupMarker($data['groupMarker'])
            ->setGroupRetinaMarker($data['groupRetinaMarker'])
            ->setStackOrder($data['stackOrder']);

        $this->entityManager->flush();

        return $group->getId();
    }
}
