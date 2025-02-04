<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $synopsis = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateSortie = null;

    #[ORM\Column]
    private ?int $duree = null;

    /**
     * @var Collection<int, Genre>
     */
    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'films')]
    private Collection $genre;

    /**
     * @var Collection<int, Role>
     */
    #[ORM\ManyToMany(targetEntity: Role::class, mappedBy: 'film')]
    private Collection $roles;

    /**
     * @var Collection<int, Visionnage>
     */
    #[ORM\OneToMany(targetEntity: Visionnage::class, mappedBy: 'film')]
    private Collection $visionnages;

    public function __construct()
    {
        $this->genre = new ArrayCollection();
        $this->roles = new ArrayCollection();
        $this->visionnages = new ArrayCollection();
    }

    public function getId(): int
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

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): static
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(?\DateTimeInterface $dateSortie): static
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genre->contains($genre)) {
            $this->genre->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        $this->genre->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Role $role): static
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
            $role->addFilm($this);
        }

        return $this;
    }

    public function removeRole(Role $role): static
    {
        if ($this->roles->removeElement($role)) {
            $role->removeFilm($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Visionnage>
     */
    public function getVisionnages(): Collection
    {
        return $this->visionnages;
    }

    public function addVisionnage(Visionnage $visionnage): static
    {
        if (!$this->visionnages->contains($visionnage)) {
            $this->visionnages->add($visionnage);
            $visionnage->setFilm($this);
        }

        return $this;
    }

    public function removeVisionnage(Visionnage $visionnage): static
    {
        if ($this->visionnages->removeElement($visionnage)) {
            // set the owning side to null (unless already changed)
            if ($visionnage->getFilm() === $this) {
                $visionnage->setFilm(null);
            }
        }

        return $this;
    }
}
