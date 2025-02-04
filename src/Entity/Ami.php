<?php

namespace App\Entity;

use App\Repository\AmiRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AmiRepository::class)]
class Ami
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userDemandeur = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userReceveur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDemande = null;

    #[ORM\Column(length: 255)]
    private ?string $statutDemande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserDemandeur(): ?User
    {
        return $this->userDemandeur;
    }

    public function setUserDemandeur(?User $userDemandeur): static
    {
        $this->userDemandeur = $userDemandeur;

        return $this;
    }

    public function getUserReceveur(): ?User
    {
        return $this->userReceveur;
    }

    public function setUserReceveur(?User $userReceveur): static
    {
        $this->userReceveur = $userReceveur;

        return $this;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(\DateTimeInterface $dateDemande): static
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    public function getStatutDemande(): ?string
    {
        return $this->statutDemande;
    }

    public function setStatutDemande(string $statutDemande): static
    {
        $this->statutDemande = $statutDemande;

        return $this;
    }
}
