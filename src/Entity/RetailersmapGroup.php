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
     * @var RetailersmapMarker
     *
     * @ORM\OneToOne(targetEntity="RetailersmapMarker")
     * @ORM\JoinColumn(name="id_marker", referencedColumnName="id_marker", nullable=TRUE)
     **/
    private $marker;

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
     * @return RetailersmapMarker|null
     */
    public function getMarker()/*: ?RetailersmapMarker */
    {
        return $this->marker;
    }

    /**
     * @return $this
     */
    public function setMarker(RetailersmapMarker $marker)/*: self */
    {
        $this->marker = $marker;

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
            'marker' => $this->getMarker(),
            'stackOrder' => $this->getStackOrder(),
        ];
    }
}
