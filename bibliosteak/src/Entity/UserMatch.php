<?php

namespace App\Entity;

use App\Repository\UserMatchRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserMatchRepository::class)]
class UserMatch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $frags = null;

    #[ORM\Column(nullable: true)]
    private ?int $morts = null;

    #[ORM\Column]
    private ?int $assists = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbMatchsGagnes = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbMatchsPerdus = null;

    #[ORM\OneToOne(mappedBy: 'idUser', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrags(): ?int
    {
        return $this->frags;
    }

    public function setFrags(?int $frags): static
    {
        $this->frags = $frags;

        return $this;
    }

    public function getMorts(): ?int
    {
        return $this->morts;
    }

    public function setMorts(?int $morts): static
    {
        $this->morts = $morts;

        return $this;
    }

    public function getAssists(): ?int
    {
        return $this->assists;
    }

    public function setAssists(int $assists): static
    {
        $this->assists = $assists;

        return $this;
    }

    public function getNbMatchsGagnes(): ?int
    {
        return $this->nbMatchsGagnes;
    }

    public function setNbMatchsGagnes(?int $nbMatchsGagnes): static
    {
        $this->nbMatchsGagnes = $nbMatchsGagnes;

        return $this;
    }

    public function getNbMatchsPerdus(): ?int
    {
        return $this->nbMatchsPerdus;
    }

    public function setNbMatchsPerdus(?int $nbMatchsPerdus): static
    {
        $this->nbMatchsPerdus = $nbMatchsPerdus;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
