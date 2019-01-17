<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\SuperClass as SuperClass;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CandidatureRepository")
 */
class Candidature extends SuperClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $submit_date;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cover_letter;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $resume;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Candidate", inversedBy="Candidature")
     * @ORM\JoinColumn(nullable=false)
     */
    private $candidate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\LocationOffer", inversedBy="candidature")
     */
    private $locationOffer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubmitDate(): ?\DateTimeInterface
    {
        return $this->submit_date;
    }

    public function setSubmitDate(\DateTimeInterface $submit_date): self
    {
        $this->submit_date = $submit_date;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCoverLetter(): ?string
    {
        return $this->cover_letter;
    }

    public function setCoverLetter(string $cover_letter): self
    {
        $this->cover_letter = $cover_letter;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

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

    public function getCandidate(): ?Candidate
    {
        return $this->candidate;
    }

    public function setCandidate(?Candidate $candidate): self
    {
        $this->candidate = $candidate;

        return $this;
    }

    public function getLocationOffer(): ?LocationOffer
    {
        return $this->locationOffer;
    }

    public function setLocationOffer(?LocationOffer $locationOffer): self
    {
        $this->locationOffer = $locationOffer;

        return $this;
    }
}
