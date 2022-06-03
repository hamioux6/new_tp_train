<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TrainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainRepository::class)]
#[ApiResource]
class Train
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $numero;

    #[ORM\Column(type: 'time')]
    private $heure_depart;

    #[ORM\Column(type: 'time')]
    private $heure_arrivee;

    #[ORM\Column(type: 'date')]
    private $date_depart;

    #[ORM\Column(type: 'date')]
    private $date_arrivee;

    #[ORM\ManyToOne(targetEntity: Gare::class, inversedBy: 'departs')]
    #[ORM\JoinColumn(nullable: false)]
    private $gare_depart;

    #[ORM\ManyToOne(targetEntity: Gare::class, inversedBy: 'arrivees')]
    #[ORM\JoinColumn(nullable: false)]
    private $gare_arrivee;

    #[ORM\OneToMany(mappedBy: 'train', targetEntity: Arret::class, orphanRemoval: true)]
    private $arrets;

    #[ORM\ManyToOne(targetEntity: Companie::class, inversedBy: 'trains')]
    #[ORM\JoinColumn(nullable: false)]
    private $companie;

    #[ORM\OneToMany(mappedBy: 'train', targetEntity: Reservation::class)]
    private $reservations;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $reservationclosed;

    public function __construct()
    {
        $this->arrets = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

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

    public function getHeureArrivee(): ?\DateTimeInterface
    {
        return $this->heure_arrivee;
    }

    public function setHeureArrivee(\DateTimeInterface $heure_arrivee): self
    {
        $this->heure_arrivee = $heure_arrivee;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }

    public function setDateDepart(\DateTimeInterface $date_depart): self
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getDateArrivee(): ?\DateTimeInterface
    {
        return $this->date_arrivee;
    }

    public function setDateArrivee(\DateTimeInterface $date_arrivee): self
    {
        $this->date_arrivee = $date_arrivee;

        return $this;
    }

    public function getGareDepart(): ?Gare
    {
        return $this->gare_depart;
    }

    public function setGareDepart(?Gare $gare_depart): self
    {
        $this->gare_depart = $gare_depart;

        return $this;
    }

    public function getGareArrivee(): ?Gare
    {
        return $this->gare_arrivee;
    }

    public function setGareArrivee(?Gare $gare_arrivee): self
    {
        $this->gare_arrivee = $gare_arrivee;

        return $this;
    }

    /**
     * @return Collection<int, Arret>
     */
    public function getArrets(): Collection
    {
        return $this->arrets;
    }

    public function addArret(Arret $arret): self
    {
        if (!$this->arrets->contains($arret)) {
            $this->arrets[] = $arret;
            $arret->setTrain($this);
        }

        return $this;
    }

    public function removeArret(Arret $arret): self
    {
        if ($this->arrets->removeElement($arret)) {
            // set the owning side to null (unless already changed)
            if ($arret->getTrain() === $this) {
                $arret->setTrain(null);
            }
        }

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

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setTrain($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getTrain() === $this) {
                $reservation->setTrain(null);
            }
        }

        return $this;
    }

    public function isReservationclosed(): ?bool
    {
        return $this->reservationclosed;
    }

    public function setReservationclosed(?bool $reservationclosed): self
    {
        $this->reservationclosed = $reservationclosed;

        return $this;
    }
}
