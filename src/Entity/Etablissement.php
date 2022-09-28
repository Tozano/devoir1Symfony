<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
#[ApiResource(security: "is_granted('ROLE_ADMIN')",
              normalizationContext:['groups' => ['read']],
              itemOperations:['GET'],
              collectionOperations:['GET'])]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(["read"])]
    private ?string $nomE = null;

    #[ORM\Column(length: 50)]
    #[Groups(["read"])]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'referee')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Professeur $referent = null;

    #[ORM\ManyToMany(targetEntity: Professeur::class, inversedBy: 'etablissements')]
    private Collection $appartenir;

    public function __construct()
    {
        $this->appartenir = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomE(): ?string
    {
        return $this->nomE;
    }

    public function setNomE(string $nomE): self
    {
        $this->nomE = $nomE;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getReferent(): ?Professeur
    {
        return $this->referent;
    }

    public function setReferent(?Professeur $referent): self
    {
        $this->referent = $referent;

        return $this;
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getAppartenir(): Collection
    {
        return $this->appartenir;
    }

    public function addAppartenir(Professeur $appartenir): self
    {
        if (!$this->appartenir->contains($appartenir)) {
            $this->appartenir->add($appartenir);
        }

        return $this;
    }

    public function removeAppartenir(Professeur $appartenir): self
    {
        $this->appartenir->removeElement($appartenir);

        return $this;
    }
}
