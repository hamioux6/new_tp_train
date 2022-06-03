<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GareRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GareRepository::class)]
#[ApiResource]
class Gare
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nom;

    #[ORM\ManyToOne(targetEntity: Ville::class, inversedBy: 'gares')]
    #[ORM\JoinColumn(nullable: false)]
    private $ville;

    #[ORM\OneToMany(mappedBy: 'gare_depart', targetEntity: Train::class, orphanRemoval: true)]
    private $departs;

    #[ORM\OneToMany(mappedBy: 'gare_arrivee', targetEntity: Train::class, orphanRemoval: true)]
    private $arrivees;

    public function __construct()
    {
        $this->departs = new ArrayCollection();
        $this->arrivees = new ArrayCollection();
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

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Train>
     */
    public function getDeparts(): Collection
    {
        return $this->departs;
    }

    public function addDepart(Train $depart): self
    {
        if (!$this->departs->contains($depart)) {
            $this->departs[] = $depart;
            $depart->setGareDepart($this);
        }

        return $this;
    }

    public function removeDepart(Train $depart): self
    {
        if ($this->departs->removeElement($depart)) {
            // set the owning side to null (unless already changed)
            if ($depart->getGareDepart() === $this) {
                $depart->setGareDepart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Train>
     */
    public function getArrivees(): Collection
    {
        return $this->arrivees;
    }

    public function addArrivee(Train $arrivee): self
    {
        if (!$this->arrivees->contains($arrivee)) {
            $this->arrivees[] = $arrivee;
            $arrivee->setGareArrivee($this);
        }

        return $this;
    }

    public function removeArrivee(Train $arrivee): self
    {
        if ($this->arrivees->removeElement($arrivee)) {
            // set the owning side to null (unless already changed)
            if ($arrivee->getGareArrivee() === $this) {
                $arrivee->setGareArrivee(null);
            }
        }

        return $this;
    }

}
