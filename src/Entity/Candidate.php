<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\SuperClass as SuperClass;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CandidateRepository")
 */

class Candidate extends SuperClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=50)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=50)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "L'email '{{ value }}' est invalide",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Candidature", mappedBy="candidate", orphanRemoval=true)
     */
    private $Candidature;

    public function __construct()
    {
        $this->Candidature = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|Candidature[]
     */
    public function getCandidature(): Collection
    {
        return $this->Candidature;
    }

    public function addCandidature(Candidature $candidature): self
    {
        if (!$this->Candidature->contains($candidature)) {
            $this->Candidature[] = $candidature;
            $candidature->setCandidate($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): self
    {
        if ($this->Candidature->contains($candidature)) {
            $this->Candidature->removeElement($candidature);
            // set the owning side to null (unless already changed)
            if ($candidature->getCandidate() === $this) {
                $candidature->setCandidate(null);
            }
        }

        return $this;
    }
}
