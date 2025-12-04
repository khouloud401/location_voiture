<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Serie = null;

    #[ORM\Column(length: 255)]
    private ?string $Date_mise_En_marche = null;

    #[ORM\Column(length: 255)]
    private ?string $Modele = null;

    #[ORM\Column(length: 255)]
    private ?string $Prix_jour = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerie(): ?string
    {
        return $this->Serie;
    }

    public function setSerie(string $Serie): static
    {
        $this->Serie = $Serie;

        return $this;
    }

    public function getDateMiseEnMarche(): ?string
    {
        return $this->Date_mise_En_marche;
    }

    public function setDateMiseEnMarche(string $Date_mise_En_marche): static
    {
        $this->Date_mise_En_marche = $Date_mise_En_marche;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->Modele;
    }

    public function setModele(string $Modele): static
    {
        $this->Modele = $Modele;

        return $this;
    }

    public function getPrixJour(): ?string
    {
        return $this->Prix_jour;
    }

    public function setPrixJour(string $Prix_jour): static
    {
        $this->Prix_jour = $Prix_jour;

        return $this;
    }
}
