<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'genre', targetEntity: Chanson::class)]
    private Collection $chansons;

    public function __construct()
    {
        $this->chansons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Chanson>
     */
    public function getChansons(): Collection
    {
        return $this->chansons;
    }

    public function addChanson(Chanson $chanson): self
    {
        if (!$this->chansons->contains($chanson)) {
            $this->chansons->add($chanson);
            $chanson->setGenre($this);
        }

        return $this;
    }

    public function removeChanson(Chanson $chanson): self
    {
        if ($this->chansons->removeElement($chanson)) {
            // set the owning side to null (unless already changed)
            if ($chanson->getGenre() === $this) {
                $chanson->setGenre(null);
            }
        }

        return $this;
    }
}
