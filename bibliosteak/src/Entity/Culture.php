<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CultureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource]

#[ORM\Entity(repositoryClass: CultureRepository::class)]
class Culture
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:Culture'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:Culture'])]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'culture', targetEntity: Livre::class)]
    private Collection $livres;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Livre>
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livre $livre): static
    {
        if (!$this->livres->contains($livre)) {
            $this->livres->add($livre);
            $livre->setCulture($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): static
    {
        if ($this->livres->removeElement($livre)) {
            // set the owning side to null (unless already changed)
            if ($livre->getCulture() === $this) {
                $livre->setCulture(null);
            }
        }

        return $this;
    }
}
