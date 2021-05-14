<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class RetailersmapGroup
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_group", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=TRUE)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="group_marker", type="string", length=255, nullable=TRUE)
     */
    private $groupMarker;

    /**
     * @var string
     *
     * @ORM\Column(name="group_retina_marker", type="string", length=255, nullable=TRUE)
     */
    private $groupRetinaMarker;

    /**
     * @var int
     *
     * @ORM\Column(name="stack_order", type="integer")
     */
    private $stackOrder;

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
     * @return string|null
     */
    public function getGroupMarker()/* : ?string */
    {
        return $this->groupMarker;
    }

    /**
     * @return $this
     */
    public function setGroupMarker(?string $marker)/* : self */
    {
        $this->groupMarker = $marker;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getGroupRetinaMarker()/* : ?string */
    {
        return $this->groupRetinaMarker;
    }

    /**
     * @return $this
     */
    public function setGroupRetinaMarker(?string $marker)/* : self */
    {
        $this->groupRetinaMarker = $marker;

        return $this;
    }

    /**
     * @return int
     */
    public function getStackOrder()/* : int */
    {
        return $this->stackOrder;
    }

    /**
     * @return $this
     */
    public function setStackOrder(int $stackOrder)/* : self */
    {
        $this->stackOrder = $stackOrder;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'groupMarker' => $this->getGroupMarker(),
            'groupRetinaMarker' => $this->getGroupRetinaMarker(),
            'stackOrder' => $this->getStackOrder(),
        ];
    }
}
