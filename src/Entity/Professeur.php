<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
#[ApiResource(security: "is_granted('Admin')",
              normalizationContext:['groups' => ['read']],
              itemOperations:['GET'],
              collectionOperations:['GET'])]
class Professeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(["read"])]
    private ?string $nomP = null;

    #[ORM\Column(length: 50)]
    #[Groups(["read"])]
    private ?string $prenomP = null;

    #[ORM\Column(length: 50)]
    private ?string $rueP = null;

    #[ORM\Column(length: 50)]
    private ?string $villeP = null;

    #[ORM\Column(length: 5)]
    private ?string $codePostal = null;

    #[ORM\OneToMany(mappedBy: 'referent', targetEntity: Etablissement::class)]
    private Collection $referee;

    #[ORM\ManyToMany(targetEntity: Etablissement::class, mappedBy: 'appartenir')]
    private Collection $etablissements;

    public function __construct()
    {
        $this->referee = new ArrayCollection();
        $this->etablissements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomP(): ?string
    {
        return $this->nomP;
    }

    public function setNomP(string $nomP): self
    {
        $this->nomP = $nomP;

        return $this;
    }

    public function getPrenomP(): ?string
    {
        return $this->prenomP;
    }

    public function setPrenomP(string $prenomP): self
    {
        $this->prenomP = $prenomP;

        return $this;
    }

    public function getRueP(): ?string
    {
        return $this->rueP;
    }

    public function setRueP(string $rueP): self
    {
        $this->rueP = $rueP;

        return $this;
    }

    public function getVilleP(): ?string
    {
        return $this->villeP;
    }

    public function setVilleP(string $villeP): self
    {
        $this->villeP = $villeP;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * @return Collection<int, Etablissement>
     */
    public function getReferee(): Collection
    {
        return $this->referee;
    }

    public function addReferee(Etablissement $referee): self
    {
        if (!$this->referee->contains($referee)) {
            $this->referee->add($referee);
            $referee->setReferent($this);
        }

        return $this;
    }

    public function removeReferee(Etablissement $referee): self
    {
        if ($this->referee->removeElement($referee)) {
            // set the owning side to null (unless already changed)
            if ($referee->getReferent() === $this) {
                $referee->setReferent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Etablissement>
     */
    public function getEtablissements(): Collection
    {
        return $this->etablissements;
    }

    public function addEtablissement(Etablissement $etablissement): self
    {
        if (!$this->etablissements->contains($etablissement)) {
            $this->etablissements->add($etablissement);
            $etablissement->addAppartenir($this);
        }

        return $this;
    }

    public function removeEtablissement(Etablissement $etablissement): self
    {
        if ($this->etablissements->removeElement($etablissement)) {
            $etablissement->removeAppartenir($this);
        }

        return $this;
    }
}
