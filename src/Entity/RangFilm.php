<?php

namespace App\Entity;

use App\Repository\RangFilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RangFilmRepository::class)]
class RangFilm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Film>
     */
    #[ORM\ManyToMany(targetEntity: Film::class)]
    private Collection $film;

    /**
     * @var Collection<int, Liste>
     */
    #[ORM\ManyToMany(targetEntity: Liste::class, inversedBy: 'rangFilms')]
    private Collection $liste;

    #[ORM\Column]
    private ?int $rang = null;

    public function __construct()
    {
        $this->film = new ArrayCollection();
        $this->liste = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilm(): Collection
    {
        return $this->film;
    }

    public function addFilm(Film $film): static
    {
        if (!$this->film->contains($film)) {
            $this->film->add($film);
        }

        return $this;
    }

    public function removeFilm(Film $film): static
    {
        $this->film->removeElement($film);

        return $this;
    }

    /**
     * @return Collection<int, Liste>
     */
    public function getListe(): Collection
    {
        return $this->liste;
    }

    public function addListe(Liste $liste): static
    {
        if (!$this->liste->contains($liste)) {
            $this->liste->add($liste);
        }

        return $this;
    }

    public function removeListe(Liste $liste): static
    {
        $this->liste->removeElement($liste);

        return $this;
    }

    public function getRang(): ?int
    {
        return $this->rang;
    }

    public function setRang(int $rang): static
    {
        $this->rang = $rang;

        return $this;
    }
}
