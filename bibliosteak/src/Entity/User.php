<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pseudo = null;

    #[ORM\Column(nullable: true)]
    private ?int $niveau_compte = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbMatch = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getNiveauCompte(): ?int
    {
        return $this->niveau_compte;
    }

    public function setNiveauCompte(?int $niveau_compte): static
    {
        $this->niveau_compte = $niveau_compte;

        return $this;
    }

    public function getNbMatch(): ?int
    {
        return $this->nbMatch;
    }

    public function setNbMatch(?int $nbMatch): static
    {
        $this->nbMatch = $nbMatch;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}
