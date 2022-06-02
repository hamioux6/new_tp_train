<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
#[ApiResource]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $cp;

    #[ORM\OneToMany(mappedBy: 'id_ville', targetEntity: Gare::class)]
    private $gares;

    public function __construct()
    {
        $this->gares = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(?int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * @return Collection<int, Gare>
     */
    public function getGares(): Collection
    {
        return $this->gares;
    }

    public function addGare(Gare $gare): self
    {
        if (!$this->gares->contains($gare)) {
            $this->gares[] = $gare;
            $gare->setVille($this);
        }

        return $this;
    }

    public function removeGare(Gare $gare): self
    {
        if ($this->gares->removeElement($gare)) {
            // set the owning side to null (unless already changed)
            if ($gare->getVille() === $this) {
                $gare->setVille(null);
            }
        }

        return $this;
    }
}
