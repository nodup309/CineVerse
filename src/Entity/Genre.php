<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    const ACTION = "4ae5a00b-92af-4c7e-b12f-779404cde485";
    const ANIMATION_3D = "a6747418-3b6d-4eca-8e68-99eb08033b1e";
    const AVENTURE = "cf97f01c-f125-4c33-9f67-95405a50f1f8";
    const BIOPIC = "386fe40b-dd30-464d-bea0-cca13fa365ac";
    const CASSE = "bfef5876-3320-40aa-b4f7-c2dbd832a23a";
    const CATASTROPHE = "d1493fae-dbb6-4827-b200-68061216d62d";
    const COMEDIE = "409e36f7-2371-4bda-a2f1-84d091554517";
    const DESSIN_ANIME = "9edef770-9bf6-4813-8e47-21a25c838e69";
    const DOCUMENTAIRE = "a8e508ef-7598-4f5f-92e5-8218361d8ff7";
    const DRAME = "2bdd4a63-3094-4ceb-bb05-db65669a5d16";
    const MERVEILLEUX = "5d4b95a0-af1f-42e2-9616-50bf903a8691";
    const FANTASY = "7ae6451f-18e6-4fbd-a0ca-c6915079e989";
    const GUERRE = "a04481a6-9a77-4147-a282-15f19d36d430";
    const HISTORIQUE = "da75e9ba-967e-4274-9544-3184ccb5560a";
    const HORREUR = "388accbb-3632-4450-a892-15e5ef2ae778";
    const MUSICAL = "9feacee0-0ee9-4a52-a78d-9fd3c81deffb";
    const PEPLUM = "04b0cd11-c79a-4733-bf55-e3c243b380f4";
    const POLICIER = "8dd6dfa1-f90c-4976-b5e4-cdb2d48ad7f4";
    const ROMANCE = "3776fa49-7ac7-47bd-971f-d15a35be2fa7";
    const SCIENCE_FICTION = "fedaefcd-de83-4231-8cc2-69d793842e5e";
    const STOP_MOTION = "781ec432-d62d-425f-9d3a-ec9c4ef23b5b";
    const SUPER_HEROS = "7a25ea39-afd1-499a-b07f-8e664e2730e6";
    const THRILLER = "721f397c-b17d-4b3e-9269-a5f7681bceaa";
    const WESTERN = "702f5503-06b5-4f8b-ba61-9ec886faa4be";

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Film>
     */
    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'genre')]
    private Collection $films;

    #[ORM\Column(type: 'uuid')]
    private Uuid $uuid;

    public function __construct()
    {
        $this->films = new ArrayCollection();
        $this->uuid = Uuid::uuid4();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

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

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function setUuid(Uuid $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }
}
