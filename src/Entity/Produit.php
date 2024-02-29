<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Delete;

use Doctrine\ORM\Mapping as ORM;




//------------------------------------------

#[ApiResource( 
    operations:[new Get(normalizationContext:['groups'=>'produit:item']),
            new GetCollection(normalizationContext:['groups'=>'produit:list']),
            new Delete(),
        ]
)]


#[ORM\Entity(repositoryClass: ProduitRepository::class)]

class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[groups(['produit:list','produit:item','ajouter:list','ajouter:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[groups(['produit:list','produit:item','ajouter:list','ajouter:item'])]
    private ?string $nom = null;

    #[ORM\Column]
    #[groups(['produit:list','produit:item'])]
    private ?int $prix = null;

    #[ORM\Column(type: Types::TEXT)]
    #[groups(['produit:list','produit:item'])]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[groups(['produit:list','produit:item'])]
    private ?string $image = null;

    #[ORM\OneToMany(targetEntity: Ajouter::class, mappedBy: 'produit')]
    private Collection $ajouters;

    public function __construct()
    {
        $this->ajouters = new ArrayCollection();
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

    /**
     * @return Collection<int, Ajouter>
     */
    public function getAjouters(): Collection
    {
        return $this->ajouters;
    }

    public function addAjouter(Ajouter $ajouter): static
    {
        if (!$this->ajouters->contains($ajouter)) {
            $this->ajouters->add($ajouter);
            $ajouter->setProduit($this);
        }

        return $this;
    }

    public function removeAjouter(Ajouter $ajouter): static
    {
        if ($this->ajouters->removeElement($ajouter)) {
            // set the owning side to null (unless already changed)
            if ($ajouter->getProduit() === $this) {
                $ajouter->setProduit(null);
            }
        }

        return $this;
    }   
}
