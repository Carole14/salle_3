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

    public function __construct()
    {
        $this->partperms = new ArrayCollection();
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
}
