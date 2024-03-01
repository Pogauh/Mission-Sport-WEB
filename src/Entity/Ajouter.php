<?php

namespace App\Entity;

use App\Repository\AjouterRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Delete;

use ApiPlatform\Metadata\ApiResource;

#[ApiResource( 
    operations:[new Get(normalizationContext:['groups'=>'ajouter:item']),
            new GetCollection(normalizationContext:['groups'=>'ajouter:list']),
            new Delete(),
        ]
)]

#[ORM\Entity(repositoryClass: AjouterRepository::class)]
class Ajouter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[groups(['panier:list','panier:item'])]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'ajouters')]
    #[groups(['ajouter:list','ajouter:item','panier:list','panier:item'])]
    private ?Produit $produit = null;

    #[ORM\ManyToOne(inversedBy: 'ajouters')]
    #[groups(['ajouter:list','ajouter:item'])]
    private ?Panier $panier = null;

  
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->panier;
    }

    public function setPanier(?Panier $panier): static
    {
        $this->panier = $panier;

        return $this;
    }

    
 
}
