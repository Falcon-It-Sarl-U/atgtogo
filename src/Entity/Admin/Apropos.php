<?php

namespace App\Entity\Admin;

use App\Repository\Admin\AproposRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AproposRepository::class)]
class Apropos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $valeur = null;

    #[ORM\Column(length: 255)]
    private ?string $valeur2 = null;

    #[ORM\Column(length: 255)]
    private ?string $valeur3 = null;

    #[ORM\Column(length: 255)]
    private ?string $valeur4 = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_directeur = null;

    #[ORM\Column]
    private ?bool $statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(string $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getValeur2(): ?string
    {
        return $this->valeur2;
    }

    public function setValeur2(string $valeur2): static
    {
        $this->valeur2 = $valeur2;

        return $this;
    }

    public function getValeur3(): ?string
    {
        return $this->valeur3;
    }

    public function setValeur3(string $valeur3): static
    {
        $this->valeur3 = $valeur3;

        return $this;
    }

    public function getValeur4(): ?string
    {
        return $this->valeur4;
    }

    public function setValeur4(string $valeur4): static
    {
        $this->valeur4 = $valeur4;

        return $this;
    }

    public function getNomDirecteur(): ?string
    {
        return $this->nom_directeur;
    }

    public function setNomDirecteur(string $nom_directeur): static
    {
        $this->nom_directeur = $nom_directeur;

        return $this;
    }

    public function isStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}
