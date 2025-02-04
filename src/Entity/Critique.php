<?php

namespace App\Entity;

use App\Repository\CritiqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CritiqueRepository::class)]
class Critique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'critiques')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Visionnage $visionnage = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column]
    private ?bool $isPublique = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVisionnage(): ?Visionnage
    {
        return $this->visionnage;
    }

    public function setVisionnage(?Visionnage $visionnage): static
    {
        $this->visionnage = $visionnage;

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

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

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
}
