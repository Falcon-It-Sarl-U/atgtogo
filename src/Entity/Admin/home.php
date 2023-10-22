<?php

namespace App\Entity\Admin;

use App\Repository\Admin\homeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: homeRepository::class)]
class home
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
