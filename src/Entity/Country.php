<?php

    namespace App\Entity;

use App\Entity\SuperClass;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
     */
    class Country extends SuperClass
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
        private $name;

        /**
         * @ORM\OneToMany(targetEntity="App\Entity\Location", mappedBy="country")
         */
        private $locations;

        public function __construct()
        {
            parent::__construct();
            $this->locations = new ArrayCollection();
        }

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getName(): ?string
        {
            return $this->name;
        }

        public function setName(string $name): self
        {
            $this->name = $name;

            return $this;
        }

        /**
         * @return Collection|Location[]
         */
        public function getLocations(): Collection
        {
            return $this->locations;
        }

        public function addLocation(Location $location): self
        {
            if (!$this->locations->contains($location)) {
                $this->locations[] = $location;
                $location->setCountry($this);
            }

            return $this;
        }

        public function removeLocation(Location $location): self
        {
            if ($this->locations->contains($location)) {
                $this->locations->removeElement($location);
                // set the owning side to null (unless already changed)
                if ($location->getCountry() === $this) {
                    $location->setCountry(null);
                }
            }

            return $this;
        }
    }
