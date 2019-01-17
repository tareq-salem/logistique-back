<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\SuperClass as SuperClass;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Category;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 */
class Location extends SuperClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $postal_code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="locations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LocationOffer", mappedBy="location", orphanRemoval=true)
     */
    private $locationOffers;

    public function __construct()
    {
        parent::__construct();
        $this->locationOffers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|LocationOffer[]
     */
    public function getLocationOffers(): Collection
    {
        return $this->locationOffers;
    }

    public function addLocationOffer(LocationOffer $locationOffer): self
    {
        if (!$this->locationOffers->contains($locationOffer)) {
            $this->locationOffers[] = $locationOffer;
            $locationOffer->setLocation($this);
        }

        return $this;
    }

    public function removeLocationOffer(LocationOffer $locationOffer): self
    {
        if ($this->locationOffers->contains($locationOffer)) {
            $this->locationOffers->removeElement($locationOffer);
            // set the owning side to null (unless already changed)
            if ($locationOffer->getLocation() === $this) {
                $locationOffer->setLocation(null);
            }
        }

        return $this;
    }
}
