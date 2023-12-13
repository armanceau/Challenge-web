<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LivreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
#[ApiResource(
    description: "Un ensemble de rêve culinaire",
    operations: [
        //Affiche les livres sans détail (id, auteur, nom, note)
        new GetCollection(normalizationContext: ['groups' => ['read:collection']]),
        //Affiche les détails du livre lorsque le livre est sélectionné
        new Get(normalizationContext: ['groups' => ['read:collection', 'read:item', 'read:Culture', 'read:Regime']]), 
        new Post(), 
        new Put(denormalizationContext:['groups' => ['put:Livre']]), 
        new Delete()
    ]
)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:collection'])]
    private ?int $id = null;

    #[Groups(['read:collection', 'put:Livre'])]
    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[Groups(['read:item'])]
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[Groups(['read:item'])]
    #[ORM\Column(length: 255)]
    private ?string $ISBN = null;

    #[Groups(['read:collection'])]
    #[ORM\Column(length: 255)]
    private ?string $auteur = null;

    #[Groups(['read:item'])]
    #[ORM\Column(length: 255)]
    private ?string $editeur = null;

    #[Groups(['read:collection'])]
    #[ORM\Column(nullable: true)]
    private ?int $note = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['read:item'])]
    private ?\DateTimeInterface $date = null;

    #[Groups(['read:item'])]
    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[Groups(['read:item'])]
    private ?Culture $culture = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[Groups(['read:item'])]
    private ?Regime $regime = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getISBN(): ?string
    {
        return $this->ISBN;
    }

    public function setISBN(string $ISBN): static
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getEditeur(): ?string
    {
        return $this->editeur;
    }

    public function setEditeur(string $editeur): static
    {
        $this->editeur = $editeur;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCulture(): ?culture
    {
        return $this->culture;
    }

    public function setCulture(?culture $culture): static
    {
        $this->culture = $culture;

        return $this;
    }

    public function getRegime(): ?regime
    {
        return $this->regime;
    }

    public function setRegime(?regime $regime): static
    {
        $this->regime = $regime;

        return $this;
    }
}
