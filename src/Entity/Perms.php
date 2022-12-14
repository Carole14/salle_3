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

    #[ORM\ManyToMany(targetEntity: Structures::class, mappedBy: 'struturesperms')]
    private Collection $structures;

    #[ORM\Column(length: 255)]
    private ?string $nom2 = null;

    #[ORM\ManyToMany(targetEntity: Partners::class, mappedBy: 'permission')]
    private Collection $partners;
    public function __construct()
    {
        $this->structures = new ArrayCollection();
        $this->partners = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Partners>
     */
    public function getPartners(): Collection
    {
        return $this->partners;
    }

    public function addPartner(Partners $partner): self
    {
        if (!$this->partners->contains($partner)) {
            $this->partners->add($partner);
            $partner->addPermission($this);
        }

        return $this;
    }

    public function removePartner(Partners $partner): self
    {
        if ($this->partners->removeElement($partner)) {
            $partner->removePermission($this);
        }

        return $this;
    }
}
