<?php

namespace App\Entity;

use App\Repository\PartnersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartnersRepository::class)]
class Partners
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\ManyToMany(targetEntity: Perms::class, inversedBy: 'partners')]
    private Collection $permission;

    #[ORM\OneToMany(mappedBy: 'partners', targetEntity: Structures::class)]
    private Collection $sutrcture;



    public function __construct()
    {
        $this->permission = new ArrayCollection();
        $this->sutrcture = new ArrayCollection();
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

    /**
     * @return Collection<int, Perms>
     */
    public function getPermission(): Collection
    {
        return $this->permission;
    }

    public function addPermission(Perms $permission): self
    {
        if (!$this->permission->contains($permission)) {
            $this->permission->add($permission);
        }

        return $this;
    }

    public function removePermission(Perms $permission): self
    {
        $this->permission->removeElement($permission);

        return $this;
    }

    /**
     * @return Collection<int, Structures>
     */
    public function getSutrcture(): Collection
    {
        return $this->sutrcture;
    }

    public function addSutrcture(Structures $sutrcture): self
    {
        if (!$this->sutrcture->contains($sutrcture)) {
            $this->sutrcture->add($sutrcture);
            $sutrcture->setPartners($this);
        }

        return $this;
    }

    public function removeSutrcture(Structures $sutrcture): self
    {
        if ($this->sutrcture->removeElement($sutrcture)) {
            // set the owning side to null (unless already changed)
            if ($sutrcture->getPartners() === $this) {
                $sutrcture->setPartners(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
