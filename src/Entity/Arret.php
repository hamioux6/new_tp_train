<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ArretRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArretRepository::class)]
#[ApiResource]
class Arret
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'time')]
    private $heure_arrivee;

    #[ORM\Column(type: 'time')]
    private $heure_depart;

    #[ORM\ManyToOne(targetEntity: Gare::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $gare;

    #[ORM\ManyToOne(targetEntity: Train::class, inversedBy: 'arrets')]
    #[ORM\JoinColumn(nullable: false)]
    private $train;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureArrivee(): ?\DateTimeInterface
    {
        return $this->heure_arrivee;
    }

    public function setHeureArrivee(\DateTimeInterface $heure_arrivee): self
    {
        $this->heure_arrivee = $heure_arrivee;

        return $this;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->heure_depart;
    }

    public function setHeureDepart(\DateTimeInterface $heure_depart): self
    {
        $this->heure_depart = $heure_depart;

        return $this;
    }

    public function getGare(): ?Gare
    {
        return $this->gare;
    }

    public function setGare(?Gare $gare): self
    {
        $this->gare = $gare;

        return $this;
    }

    public function getTrain(): ?Train
    {
        return $this->train;
    }

    public function setTrain(?Train $train): self
    {
        $this->train = $train;

        return $this;
    }
}
