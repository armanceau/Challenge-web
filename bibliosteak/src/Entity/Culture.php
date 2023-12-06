<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CultureRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;

#[ApiResource(operations: [
    new Get(
        uriTemplate: '/api/cultures/nom/{nom}', 
        defaults: ['color' => 'brown'], 
        options: ['my_option' => 'my_option_value'], 
        schemes: ['https'], 
        host: '{subdomain}.api-platform.com'
    ),
    new Post(
        uriTemplate: '/grimoire', 
        status: 301
    )
])]

#[ORM\Entity(repositoryClass: CultureRepository::class)]
class Culture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

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
}
