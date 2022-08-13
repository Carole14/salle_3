<?php

namespace App\Entity;

use App\Repository\PermsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PermsRepository::class)]
class Perms
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

  

    #[ORM\ManyToMany(targetEntity: Partenaires::class, inversedBy: 'partperms')]
    private Collection $partperms;

    #[ORM\ManyToMany(targetEntity: Structures::class, mappedBy: 'struturesperms')]
    private Collection $structures;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[ORM\Column(length: 255)]
    private ?string $nom2 = null;

    public function __construct()
    {
        $this->partperms = new ArrayCollection();
        $this->structures = new ArrayCollection();
    }


    /**
     * @return Collection<int, Partenaires>
     */
    public function getPartperms(): Collection
    {
        return $this->partperms;
    }

    public function addPartperm(Partenaires $partperm): self
    {
        if (!$this->partperms->contains($partperm)) {
            $this->partperms->add($partperm);
        }

        return $this;
    }

    public function removePartperm(Partenaires $partperm): self
    {
        $this->partperms->removeElement($partperm);

        return $this;
    }

    /**
     * @return Collection<int, Structures>
     */
    public function getStructures(): Collection
    {
        return $this->structures;
    }

    public function addStructure(Structures $structure): self
    {
        if (!$this->structures->contains($structure)) {
            $this->structures->add($structure);
            $structure->addStruturesperm($this);
        }

        return $this;
    }

    public function removeStructure(Structures $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            $structure->removeStruturesperm($this);
        }

        return $this;
    }

    public function getNom2(): ?string
    {
        return $this->nom2;
    }

    public function setNom2(string $nom2): self
    {
        $this->nom2 = $nom2;

        return $this;
    }

    public function __toString()
    {
        return $this->nom2;
    }
}
