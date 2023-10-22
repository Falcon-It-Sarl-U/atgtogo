<?php

namespace App\Entity\Admin;

use App\Repository\Admin\ProduitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description1 = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description2 = null;

    #[ORM\Column(length: 255)]
    private ?string $avantage = null;

    #[ORM\Column(length: 255)]
    private ?string $avantage2 = null;

    #[ORM\Column(length: 255)]
    private ?string $avantage3 = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $image2 = null;

    #[ORM\Column]
    private ?bool $statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription1(): ?string
    {
        return $this->description1;
    }

    public function setDescription1(string $description1): static
    {
        $this->description1 = $description1;

        return $this;
    }

    public function getDescription2(): ?string
    {
        return $this->description2;
    }

    public function setDescription2(string $description2): static
    {
        $this->description2 = $description2;

        return $this;
    }

    public function getAvantage(): ?string
    {
        return $this->avantage;
    }

    public function setAvantage(string $avantage): static
    {
        $this->avantage = $avantage;

        return $this;
    }

    public function getAvantage2(): ?string
    {
        return $this->avantage2;
    }

    public function setAvantage2(string $avantage2): static
    {
        $this->avantage2 = $avantage2;

        return $this;
    }

    public function getAvantage3(): ?string
    {
        return $this->avantage3;
    }

    public function setAvantage3(string $avantage3): static
    {
        $this->avantage3 = $avantage3;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(string $image2): static
    {
        $this->image2 = $image2;

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
