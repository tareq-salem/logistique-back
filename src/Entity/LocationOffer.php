<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationOfferRepository")
 */
class LocationOffer
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
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location", inversedBy="locationOffers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Offer", inversedBy="locationOffers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Candidature", mappedBy="locationOffer", orphanRemoval=true)
     */
    private $candidature;

    public function __construct()
    {
        $this->candidature = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * @return Collection|Candidature[]
     */
    public function getCandidature(): Collection
    {
        return $this->candidature;
    }

    public function addCandidature(Candidature $candidature): self
    {
        if (!$this->candidature->contains($candidature)) {
            $this->candidature[] = $candidature;
            $candidature->setLocationOffer($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): self
    {
        if ($this->candidature->contains($candidature)) {
            $this->candidature->removeElement($candidature);
            // set the owning side to null (unless already changed)
            if ($candidature->getLocationOffer() === $this) {
                $candidature->setLocationOffer(null);
            }
        }

        return $this;
    }
}
