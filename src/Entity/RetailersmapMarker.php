<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class RetailersmapMarker
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_marker", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=80, unique=TRUE, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name_default", type="string", length=80, unique=TRUE, nullable=false)
     */
    private $fileNameDefault;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name_retina", type="string", length=80, unique=TRUE, nullable=true)
     */
    private $fileNameRetina;

    /**
     * @var int
     *
     * @ORM\Column(name="icon_width", type="integer", nullable=false)
     */
    private $iconWidth;

    /**
     * @var int
     *
     * @ORM\Column(name="icon_height", type="integer", nullable=false)
     */
    private $iconHeight;

    /**
     * @var int
     *
     * @ORM\Column(name="anchor_x", type="integer", nullable=false)
     */
    private $anchorX;

    /**
     * @var int
     *
     * @ORM\Column(name="anchor_y", type="integer", nullable=false)
     */
    private $anchorY;

    //### RETURN TYPES IN METHODS WERE COMMENTED OUT BECAUSE OF OUTDATED DOCTRINE VERSION ERROR

    /**
     * @return int
     */
    public function getId()/*: int */
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()/*: string */
    {
        return $this->name;
    }

    /**
     * @return $this
     */
    public function setName(string $name)/* : self */
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileNameDefault()/*: string */
    {
        return $this->fileNameDefault;
    }

    /**
     * @return $this
     */
    public function setFileNameDefault(string $fileName)/* : self */
    {
        $this->fileNameDefault = $fileName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileNameRetina()/*: string */
    {
        return $this->fileNameRetina;
    }

    /**
     * @return $this
     */
    public function setFileNameRetina(string $fileName)/* : self */
    {
        $this->fileNameRetina = $fileName;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getRetinaIcon()/*: boolean */
    {
        return $this->retinaIcon;
    }

    /**
     * @return $this
     */
    public function setRetinaIcon(string $retinaIcon)/* : self */
    {
        $this->retinaIcon = $retinaIcon;

        return $this;
    }

    /**
     * @return int
     */
    public function getIconWidth()/* : int */
    {
        return $this->iconWidth;
    }

    /**
     * @return $this
     */
    public function setIconWidth(int $iconWidth)/* : self */
    {
        $this->iconWidth = $iconWidth;

        return $this;
    }

    /**
     * @return int
     */
    public function getIconHeight()/* : int */
    {
        return $this->iconHeight;
    }

    /**
     * @return $this
     */
    public function setIconHeight(int $iconHeight)/* : self */
    {
        $this->iconHeight = $iconHeight;

        return $this;
    }

    /**
     * @return int
     */
    public function getAnchorX()/* : int */
    {
        return $this->anchorX;
    }

    /**
     * @return $this
     */
    public function setAnchorX(int $anchorX)/* : self */
    {
        $this->anchorX = $anchorX;

        return $this;
    }

    /**
     * @return int
     */
    public function getAnchorY()/* : int */
    {
        return $this->anchorY;
    }

    /**
     * @return $this
     */
    public function setAnchorY(int $anchorY)/* : self */
    {
        $this->anchorY = $anchorY;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'fileNameDefault' => $this->getFileNameDefault(),
            'fileNameRetina' => $this->getFileNameRetina(),
            'iconWidth' => $this->getIconWidth(),
            'iconHeight' => $this->getIconHeight(),
            'anchorX' => $this->getAnchorX(),
            'anchorY' => $this->getAnchorY()
        ];
    }
}
