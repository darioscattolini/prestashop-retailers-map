<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Marker;

use Exception;
use PrestaShop\PrestaShop\Core\Image\Uploader\Exception\ImageUploadException;
use PrestaShop\PrestaShop\Core\Image\Uploader\Exception\UploadedImageConstraintException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MarkerIconFileManager
{
    /**
     * @var string
     */
    private $_ICON_DIR_;

    /**
     * @param string $_ICON_DIR_
     */
    public function __construct(string $_ICON_DIR_)
    {
        $this->_ICON_DIR_ 
            = _PS_ROOT_DIR_ . _MODULE_DIR_ . 'retailersmap/' . $_ICON_DIR_;
    }

    /**
     * Deletes old icon image
     *
     * @param string $fileName      Name of icon file to be deleted
     */
    public function deleteOld(string $fileName)
    {
        if (file_exists($this->_ICON_DIR_ . $fileName)) {
            unlink($this->_ICON_DIR_ . $fileName);
        }
    }

    /**
     * @param string $markerName    Marker name
     * @param string $oldFileName   Old file name for marker
     * @param bool $isRetina        Optional. Whether file corresponds to retina
     *                              icon. Defaults to `false`
     * 
     * @return string               New file's name
     * @throws ImageUploadException
     */
    public function updateFileName(
        string $markerName, 
        string $oldFileName,
        bool $isRetina = false
    ): string
    {
        $oldPath = $this->_ICON_DIR_ . $oldFileName;
        $newFileName = $this->buildFileName($markerName, $isRetina, 'png');
        $newPath = $this->_ICON_DIR_ . $newFileName;
        
        if (file_exists($oldPath)) {
            rename($oldPath, $newPath);
            return $newFileName;
        } else {
            throw new Exception('Old file not found.');
        }
    }

    /**
     * @param string $markerName    Marker name
     * @param UploadedFile $icon    Uploaded icon file
     * @param bool $isRetina        Optional. Whether file corresponds to retina
     *                              icon. Defaults to `false`
     * 
     * @return string               Uploaded file's name
     * @throws ImageUploadException
     */
    public function upload(
        string $markerName, 
        UploadedFile $icon,
        bool $isRetina = false
    ): string
    {
        $this->checkImageIsAllowedForUpload($icon);

        $fileName = $this->buildFileName(
            $markerName, $isRetina, $icon->guessExtension()
        );

        try {
            $icon->move($this->_ICON_DIR_, $fileName);
        } catch (FileException $e) {
            throw new ImageUploadException(
                'An error occurred while uploading the image. ' .
                'Check your directory permissions. ' . $e
            );
            return null;
        }

        return $fileName;
    }

    /**
     * Check if icon image is allowed to be uploaded.
     *
     * @param UploadedFile $icon
     *
     * @throws UploadedImageConstraintException
     */
    protected function checkImageIsAllowedForUpload(UploadedFile $icon)
    {
        $maxFileSize = \Tools::getMaxUploadSize();

        if ($maxFileSize > 0 && $icon->getSize() > $maxFileSize) {
            throw new UploadedImageConstraintException(
                sprintf(
                   'Max file size allowed is "%s" bytes. Uploaded image size is "%s".', 
                    $maxFileSize, $icon->getSize()
                ), 
                UploadedImageConstraintException::EXCEEDED_SIZE
            );
        }

        $isRealPng = \ImageManager::isRealImage(
            $icon->getPathname(), 
            $icon->getClientMimeType(),
            array('image/png')
        );
        $isCorrectFileExt = \ImageManager::isCorrectImageFileExt(
            $icon->getClientOriginalName(),
            array('png')
        );
        $nullByteInjection = preg_match('/\%00/', $icon->getClientOriginalName());

        if (!$isRealPng || !$isCorrectFileExt || $nullByteInjection) {
            throw new UploadedImageConstraintException(
                sprintf(
                    'Image format "%s" not allowed, only .png is allowed', 
                    $icon->getClientOriginalExtension()
                ),
                UploadedImageConstraintException::UNRECOGNIZED_FORMAT
            );
        }
    }

    /**
     * Builds icon file name based on marker name.
     *
     * @param string $markerName
     *
     * @return string
     */
    private function buildFileName(
        string $nameBase,
        bool $isRetina,
        string $extension
    ): string {
        $nameBase = transliterator_transliterate(
            'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', 
            $nameBase
        );
        $nameBase = substr($nameBase, 0, 45);
        $retina = $isRetina ? '-retina' : '';
        $uniqueId = '';
        $fileName = '';
        
        do {
            $fileName = 
                $nameBase . $retina . '-icon' . $uniqueId . '.' . $extension;    
            $uniqueId = '-' . uniqid();
        } while (file_exists($this->_ICON_DIR_ . $fileName));
        
        return $fileName;
    }
}
