<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ApiResource]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'boolean')]
    private $confirme;

    #[ORM\Column(type: 'boolean')]
    private $annule;

    #[ORM\ManyToOne(targetEntity: Train::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private $train;

    #[ORM\ManyToOne(targetEntity: Companie::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $companie;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private $client;

    #[ORM\ManyToOne(targetEntity: Passager::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private $passager;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isConfirme(): ?bool
    {
        return $this->confirme;
    }

    public function setConfirme(bool $confirme): self
    {
        $this->confirme = $confirme;

        return $this;
    }

    public function isAnnule(): ?bool
    {
        return $this->annule;
    }

    public function setAnnule(bool $annule): self
    {
        $this->annule = $annule;

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

    public function getCompanie(): ?Companie
    {
        return $this->companie;
    }

    public function setCompanie(?Companie $companie): self
    {
        $this->companie = $companie;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getPassager(): ?Passager
    {
        return $this->passager;
    }

    public function setPassager(?Passager $passager): self
    {
        $this->passager = $passager;

        return $this;
    }
}
