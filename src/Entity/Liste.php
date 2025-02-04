<?php

namespace App\Entity;

use App\Repository\ListeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeRepository::class)]
class Liste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'listes')]
    private Collection $user;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $isPublique = null;

    #[ORM\Column]
    private ?bool $isCollaborative = null;

    #[ORM\Column]
    private ?bool $isARegarder = null;

    #[ORM\Column]
    private ?bool $isFavori = null;

    /**
     * @var Collection<int, RangFilm>
     */
    #[ORM\ManyToMany(targetEntity: RangFilm::class, mappedBy: 'liste')]
    private Collection $rangFilms;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->rangFilms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->user->removeElement($user);

        return $this;
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

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isPublique(): ?bool
    {
        return $this->isPublique;
    }

    public function setIsPublique(bool $isPublique): static
    {
        $this->isPublique = $isPublique;

        return $this;
    }

    public function isCollaborative(): ?bool
    {
        return $this->isCollaborative;
    }

    public function setIsCollaborative(bool $isCollaborative): static
    {
        $this->isCollaborative = $isCollaborative;

        return $this;
    }

    public function isARegarder(): ?bool
    {
        return $this->isARegarder;
    }

    public function setIsARegarder(bool $isARegarder): static
    {
        $this->isARegarder = $isARegarder;

        return $this;
    }

    public function isFavori(): ?bool
    {
        return $this->isFavori;
    }

    public function setIsFavori(bool $isFavori): static
    {
        $this->isFavori = $isFavori;

        return $this;
    }

    /**
     * @return Collection<int, RangFilm>
     */
    public function getRangFilms(): Collection
    {
        return $this->rangFilms;
    }

    public function addRangFilm(RangFilm $rangFilm): static
    {
        if (!$this->rangFilms->contains($rangFilm)) {
            $this->rangFilms->add($rangFilm);
            $rangFilm->addListe($this);
        }

        return $this;
    }

    public function removeRangFilm(RangFilm $rangFilm): static
    {
        if ($this->rangFilms->removeElement($rangFilm)) {
            $rangFilm->removeListe($this);
        }

        return $this;
    }
}
