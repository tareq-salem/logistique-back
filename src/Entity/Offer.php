<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\SuperClass;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OfferRepository")
 */
class Offer extends SuperClass
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end_publication_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start_publication_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $salary;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hour_per_week;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $availability;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $required_profil;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $required_experience;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $benefits;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status", inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OfferType", inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offerType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContractType", inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contratType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getEndPublicationDate(): ?\DateTimeInterface
    {
        return $this->end_publication_date;
    }

    public function setEndPublicationDate(\DateTimeInterface $end_publication_date): self
    {
        $this->end_publication_date = $end_publication_date;

        return $this;
    }

    public function getStartPublicationDate(): ?\DateTimeInterface
    {
        return $this->start_publication_date;
    }

    public function setStartPublicationDate(\DateTimeInterface $start_publication_date): self
    {
        $this->start_publication_date = $start_publication_date;

        return $this;
    }

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(string $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getHourPerWeek(): ?string
    {
        return $this->hour_per_week;
    }

    public function setHourPerWeek(string $hour_per_week): self
    {
        $this->hour_per_week = $hour_per_week;

        return $this;
    }

    public function getAvailability(): ?string
    {
        return $this->availability;
    }

    public function setAvailability(string $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    public function getRequiredProfil(): ?string
    {
        return $this->required_profil;
    }

    public function setRequiredProfil(string $required_profil): self
    {
        $this->required_profil = $required_profil;

        return $this;
    }

    public function getRequiredExperience(): ?string
    {
        return $this->required_experience;
    }

    public function setRequiredExperience(string $required_experience): self
    {
        $this->required_experience = $required_experience;

        return $this;
    }

    public function getBenefits(): ?string
    {
        return $this->benefits;
    }

    public function setBenefits(string $benefits): self
    {
        $this->benefits = $benefits;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getOfferType(): ?OfferType
    {
        return $this->offerType;
    }

    public function setOfferType(?OfferType $offerType): self
    {
        $this->offerType = $offerType;

        return $this;
    }

    public function getContratType(): ?ContractType
    {
        return $this->contratType;
    }

    public function setContratType(?ContractType $contratType): self
    {
        $this->contratType = $contratType;

        return $this;
    }
}
