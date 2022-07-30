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

    #[ORM\Column]
    private ?bool $nom = null;

    #[ORM\ManyToMany(targetEntity: Partenaires::class, inversedBy: 'partperms')]
    private Collection $partperms;

    #[ORM\ManyToMany(targetEntity: Structures::class, mappedBy: 'struturesperms')]
    private Collection $structures;

    public function __construct()
    {
        $this->partperms = new ArrayCollection();
        $this->structures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isNom(): ?bool
    {
        return $this->nom;
    }

    public function setNom(bool $nom): self
    {
        $this->nom = $nom;

        return $this;
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
}
