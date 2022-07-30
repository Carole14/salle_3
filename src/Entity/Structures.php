<?php

namespace App\Entity;

use App\Repository\StructuresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StructuresRepository::class)]
class Structures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $mot_de_passe = null;

    #[ORM\ManyToMany(targetEntity: Perms::class, inversedBy: 'structures')]
    private Collection $struturesperms;

    public function __construct()
    {
        $this->struturesperms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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

    public function getMotDePasse(): ?string
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse(string $mot_de_passe): self
    {
        $this->mot_de_passe = $mot_de_passe;

        return $this;
    }

    /**
     * @return Collection<int, Perms>
     */
    public function getStruturesperms(): Collection
    {
        return $this->struturesperms;
    }

    public function addStruturesperm(Perms $struturesperm): self
    {
        if (!$this->struturesperms->contains($struturesperm)) {
            $this->struturesperms->add($struturesperm);
        }

        return $this;
    }

    public function removeStruturesperm(Perms $struturesperm): self
    {
        $this->struturesperms->removeElement($struturesperm);

        return $this;
    }
}
