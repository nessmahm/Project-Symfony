<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $designation;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: PFE::class)]
    private $PFE;

    public function __construct()
    {
        $this->PFE = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * @return Collection<int, PFE>
     */
    public function getPFE(): Collection
    {
        return $this->PFE;
    }

    public function addPFE(PFE $pFE): self
    {
        if (!$this->PFE->contains($pFE)) {
            $this->PFE[] = $pFE;
            $pFE->setEntreprise($this);
        }

        return $this;
    }

    public function removePFE(PFE $pFE): self
    {
        if ($this->PFE->removeElement($pFE)) {
            // set the owning side to null (unless already changed)
            if ($pFE->getEntreprise() === $this) {
                $pFE->setEntreprise(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getDesignation();
    }
}
