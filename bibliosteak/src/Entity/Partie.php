<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PartieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartieRepository::class)]
#[ApiResource]

class Partie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idMatch = null;

    #[ORM\Column]
    private ?int $idUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMatch(): ?int
    {
        return $this->idMatch;
    }

    public function setIdMatch(int $idMatch): static
    {
        $this->idMatch = $idMatch;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }
}
