<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Retailer;

use Doctrine\ORM\EntityManagerInterface;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapGroup as Group;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapMarker as Marker;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapRetailer as Retailer;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataHandler\FormDataHandlerInterface;

class RetailerFormDataHandler implements FormDataHandlerInterface
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
        $data = $this->transformData($data);

        $retailer = new Retailer();
        $retailer
            ->setName($data['name'])
            ->setAddress($data['address'])
            ->setName($data['name'])
            ->setPostcode($data['postcode'])
            ->setCity($data['city'])
            ->setIdState($data['id_state'])
            ->setIdCountry($data['id_country'])
            ->setLatitude($data['latitude'])
            ->setLongitude($data['longitude'])
            ->setPhone($data['phone'])
            ->setEmail($data['email'])
            ->setGroup($data['group'])
            ->setMarker($data['marker'])
            ->setActive($data['active']);

        $this->entityManager->persist($retailer);
        $this->entityManager->flush();

        return $retailer->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $data = $this->transformData($data);
        $retailerRepository = $this->entityManager->getRepository(Retailer::class);

        /** @var Retailer $retailer */
        $retailer = $retailerRepository->findOneBy(['id' => $id]);

        $retailer
            ->setName($data['name'])
            ->setAddress($data['address'])
            ->setName($data['name'])
            ->setPostcode($data['postcode'])
            ->setCity($data['city'])
            ->setIdState($data['id_state'])
            ->setIdCountry($data['id_country'])
            ->setLatitude($data['latitude'])
            ->setLongitude($data['longitude'])
            ->setPhone($data['phone'])
            ->setEmail($data['email'])
            ->setGroup($data['group'])
            ->setMarker($data['marker'])
            ->setActive($data['active']);

        $this->entityManager->flush();

        return $retailer->getId();
    }

    private function transformData(array $data)
    {
        // For some strange reason this values must be transformed to int
        $data['id_country'] = intval($data['id_country']);
        $data['id_state'] = intval($data['id_state']);

        $groupRepository = $this->entityManager->getRepository(Group::class);
        $data['group'] = $groupRepository
            ->findOneBy(['id' => $data['id_group']]);

        $markerRepository = $this->entityManager->getRepository(Marker::class);
        $data['marker'] = $markerRepository
            ->findOneBy(['id' => $data['id_marker']]);

        return $data;
    }
}
