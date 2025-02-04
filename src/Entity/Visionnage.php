<?php

namespace App\Entity;

use App\Repository\VisionnageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisionnageRepository::class)]
class Visionnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'visionnages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'visionnages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Film $film = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateVisionnage = null;

    #[ORM\Column(nullable: true)]
    private ?int $note = null;

    /**
     * @var Collection<int, Critique>
     */
    #[ORM\OneToMany(targetEntity: Critique::class, mappedBy: 'visionnage')]
    private Collection $critiques;

    public function __construct()
    {
        $this->critiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getFilm(): ?Film
    {
        return $this->film;
    }

    public function setFilm(?Film $film): static
    {
        $this->film = $film;

        return $this;
    }

    public function getDateVisionnage(): ?\DateTimeInterface
    {
        return $this->dateVisionnage;
    }

    public function setDateVisionnage(\DateTimeInterface $dateVisionnage): static
    {
        $this->dateVisionnage = $dateVisionnage;

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

    /**
     * @return Collection<int, Critique>
     */
    public function getCritiques(): Collection
    {
        return $this->critiques;
    }

    public function addCritique(Critique $critique): static
    {
        if (!$this->critiques->contains($critique)) {
            $this->critiques->add($critique);
            $critique->setVisionnage($this);
        }

        return $this;
    }

    public function removeCritique(Critique $critique): static
    {
        if ($this->critiques->removeElement($critique)) {
            // set the owning side to null (unless already changed)
            if ($critique->getVisionnage() === $this) {
                $critique->setVisionnage(null);
            }
        }

        return $this;
    }
}
