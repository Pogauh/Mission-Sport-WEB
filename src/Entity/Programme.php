<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProgrammeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Delete;

//------------------------------------------

#[ApiResource( 
    operations:[new Get(normalizationContext:['groups'=>'programme:item']),
            new GetCollection(normalizationContext:['groups'=>'programme:list']),
            new Delete(),            
        ]
)]


#[ORM\Entity(repositoryClass: ProgrammeRepository::class)]
class Programme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[groups(['programme:list','programme:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[groups(['programme:list','programme:item'])]
    private ?string $nom = null;

    #[ORM\Column]
    #[groups(['programme:list','programme:item'])]
    private ?int $prix = null;

    #[ORM\Column(type: Types::TEXT)]
    #[groups(['programme:list','programme:item'])]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[groups(['programme:list','programme:item'])]
    private ?string $image = null;

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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
