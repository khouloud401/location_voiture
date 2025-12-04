<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Date_debut = null;

    #[ORM\Column(length: 255)]
    private ?string $Date_retour = null;

    #[ORM\Column(length: 255)]
    private ?string $Prix = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?string
    {
        return $this->Date_debut;
    }

    public function setDateDebut(string $Date_debut): static
    {
        $this->Date_debut = $Date_debut;

        return $this;
    }

    public function getDateRetour(): ?string
    {
        return $this->Date_retour;
    }

    public function setDateRetour(string $Date_retour): static
    {
        $this->Date_retour = $Date_retour;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->Prix;
    }

    public function setPrix(string $Prix): static
    {
        $this->Prix = $Prix;

        return $this;
    }
}
