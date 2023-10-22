<?php

namespace App\Entity\Admin;

use App\Repository\Admin\ServiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description1 = null;

    #[ORM\Column(length: 255)]
    private ?string $avantage1 = null;

    #[ORM\Column(length: 255)]
    private ?string $avantage2 = null;

    #[ORM\Column(length: 255)]
    private ?string $description2 = null;

    #[ORM\Column(length: 255)]
    private ?string $benefice1 = null;

    #[ORM\Column(length: 255)]
    private ?string $benefice2 = null;

    #[ORM\Column(length: 255)]
    private ?string $benefices3 = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description3 = null;

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

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

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

    public function getAvantage1(): ?string
    {
        return $this->avantage1;
    }

    public function setAvantage1(string $avantage1): static
    {
        $this->avantage1 = $avantage1;

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

    public function getDescription2(): ?string
    {
        return $this->description2;
    }

    public function setDescription2(string $description2): static
    {
        $this->description2 = $description2;

        return $this;
    }

    public function getBenefice1(): ?string
    {
        return $this->benefice1;
    }

    public function setBenefice1(string $benefice1): static
    {
        $this->benefice1 = $benefice1;

        return $this;
    }

    public function getBenefice2(): ?string
    {
        return $this->benefice2;
    }

    public function setBenefice2(string $benefice2): static
    {
        $this->benefice2 = $benefice2;

        return $this;
    }

    public function getBenefices3(): ?string
    {
        return $this->benefices3;
    }

    public function setBenefices3(string $benefices3): static
    {
        $this->benefices3 = $benefices3;

        return $this;
    }

    public function getDescription3(): ?string
    {
        return $this->description3;
    }

    public function setDescription3(string $description3): static
    {
        $this->description3 = $description3;

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
