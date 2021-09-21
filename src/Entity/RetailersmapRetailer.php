<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class RetailersmapRetailer
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_retailer", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=12)
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=64)
     */
    private $city;

    /**
     * @var int
     *
     * @ORM\Column(name="id_state", type="integer", options={"unsigned":true, "default":NULL}, nullable=TRUE)
     */
    private $idState;

    /**
     * @var int
     *
     * @ORM\Column(name="id_country", type="integer", options={"unsigned":true})
     */
    private $idCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=11)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=11)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=16, options={"default":NULL}, nullable=TRUE)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, options={"default":NULL}, nullable=TRUE)
     */
    private $email;

    /**
     * @var RetailersmapGroup
     *
     * @ORM\OneToOne(targetEntity="RetailersmapGroup")
     * @ORM\JoinColumn(name="id_group", referencedColumnName="id_group")
     **/
    private $group;

    /**
     * @var RetailersmapMarker
     *
     * @ORM\OneToOne(targetEntity="RetailersmapMarker")
     * @ORM\JoinColumn(name="id_marker", referencedColumnName="id_marker", nullable=TRUE)
     **/
    private $marker;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", options={"default":1})
     */
    private $active;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return $this
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @return $this
     */
    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return $this
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getIdState(): ?int
    {
        return $this->idState;
    }

    /**
     * @return $this
     */
    public function setIdState(?int $idState): self
    {
        $this->idState = $idState;

        return $this;
    }

    /**
     * @return int
     */
    public function getIdCountry(): int
    {
        return $this->idCountry;
    }

    /**
     * @return $this
     */
    public function setIdCountry(int $idCountry): self
    {
        $this->idCountry = $idCountry;

        return $this;
    }

    /**
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * @return $this
     */
    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * @return $this
     */
    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return $this
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return $this
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return RetailersmapGroup
     */
    public function getGroup(): RetailersmapGroup
    {
        return $this->group;
    }

    /**
     * @return $this
     */
    public function setGroup(RetailersmapGroup $group): self
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @return RetailersmapMarker|null
     */
    public function getMarker(): ?RetailersmapMarker
    {
        return $this->marker;
    }

    /**
     * @return $this
     */
    public function setMarker(RetailersmapMarker $marker): self
    {
        $this->marker = $marker;

        return $this;
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @return $this
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'address' => $this->getAddress(),
            'postcode' => $this->getPostcode(),
            'city' => $this->getCity(),
            'id_state' => $this->getIdState(),
            'id_country' => $this->getIdCountry(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'phone' => $this->getPhone(),
            'email' => $this->getEmail(),
            'group' => $this->getGroup(),
            'marker' => $this->getMarker(),
            'active' => $this->getActive(),
        ];
    }
}
