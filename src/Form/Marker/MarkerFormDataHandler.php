<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Marker;

use Doctrine\ORM\EntityManagerInterface;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapMarker as Marker;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataHandler\FormDataHandlerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MarkerFormDataHandler implements FormDataHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var MarkerIconFileManager
     */
    private $fileManager;

    public function __construct(
        EntityManagerInterface $entityManager, 
        MarkerIconFileManager $fileManager
    )
    {
        $this->entityManager = $entityManager;
        $this->fileManager = $fileManager;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $marker = new Marker();
        $this->setData($marker, $data);
        $this->entityManager->persist($marker);
        $this->entityManager->flush();

        return $marker->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $markerRepository = $this->entityManager->getRepository(Marker::class);

        /** @var Marker $group */
        $marker = $markerRepository->findOneBy(['id' => $id]);
        $this->setData($marker, $data);
        $this->entityManager->flush();

        return $marker->getId();
    }

    /**
     * Populates Marker entity with form data
     * 
     * @param Marker $marker
     * @param array $data
     * @param bool $isUpdate
     */
    private function setData(Marker $marker, array $data, bool $isUpdate = false) 
    {
        $marker->setName($data['name'])
            ->setIconWidth($data['iconWidth'])
            ->setIconHeight($data['iconHeight'])
            ->setAnchorX($data['anchorX'])
            ->setAnchorY($data['anchorY']);
        
        $fileNameDefault = null;
        $fileNameRetina = null;
        
        if ($isUpdate) {
            $fileNameDefault = isset($data['iconDefault'])
                ? $this->uploadIcon($marker, $data['iconDefault'])
                : $this->fileManager->updateFileName(
                    $marker->getName(), $marker->getFileNameDefault()
                );
            
            $fileNameRetina = isset($data['iconRetina'])
                ? $this->uploadIcon($marker, $data['iconRetina'], true)
                : $this->fileManager->updateFileName(
                    $marker->getName(), 
                    $marker->getFileNameDefault(),
                    true
                );
        } else {
            $fileNameDefault = $this->uploadIcon($marker, $data['iconDefault']);

            $fileNameRetina = isset($data['iconRetina'])
                ? $this->uploadIcon($marker, $data['iconRetina'], true)
                : null;
        }

        $marker->setFileNameDefault($fileNameDefault);
        
        if (isset($fileNameRetina)) {
            $marker->setFileNameRetina($fileNameRetina);
        }
    }

    /**
     * @param Marker $marker        Marker entity
     * @param UploadedFile $icon    Uploaded icon file
     * @param bool $isRetina        Optional. Whether file corresponds to retina
     *                              icon. Defaults to `false`
     * 
     * @return string               Uploaded file's name
     */
    private function uploadIcon(
        Marker $marker, 
        UploadedFile $icon, 
        bool $isRetina = false
    ): string
    {
        $currentFileName = $isRetina 
            ? $marker->getFileNameRetina() 
            : $marker->getFileNameDefault();
            
        if ($currentFileName) {
            $this->fileManager->deleteOld($currentFileName);
        }

        return $this->fileManager->upload($marker->getName(), $icon, $isRetina);
    }
}
