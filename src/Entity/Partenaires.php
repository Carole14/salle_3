<?php

namespace App\Entity;

use App\Repository\PartenairesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartenairesRepository::class)]
class Partenaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    /**
     * @var string The hashed password
     */

    #[ORM\Column(length: 255)]
    private ?string $mot_de_passe = null;

    #[ORM\ManyToOne(inversedBy: 'partenaires')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $partenaire = null;

    #[ORM\ManyToMany(targetEntity: Perms::class, mappedBy: 'partperms')]
    private Collection $partperms;

    #[ORM\OneToMany(mappedBy: 'partenaire', targetEntity: Structures::class)]
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

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

    public function getPartenaire(): ?User
    {
        return $this->partenaire;
    }

    public function setPartenaire(?User $partenaire): self
    {
        $this->partenaire = $partenaire;

        return $this;
    }

    /**
     * @return Collection<int, Perms>
     */
    public function getPartperms(): Collection
    {
        return $this->partperms;
    }

    public function addPartperm(Perms $partperm): self
    {
        if (!$this->partperms->contains($partperm)) {
            $this->partperms->add($partperm);
            $partperm->addPartperm($this);
        }

        return $this;
    }

    public function removePartperm(Perms $partperm): self
    {
        if ($this->partperms->removeElement($partperm)) {
            $partperm->removePartperm($this);
        }

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
            $structure->setPartenaire($this);
        }

        return $this;
    }

    public function removeStructure(Structures $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getPartenaire() === $this) {
                $structure->setPartenaire(null);
            }
        }

        return $this;
    }

}
