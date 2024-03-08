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
    #[groups(['produit:list','produit:item','ajouter:list','ajouter:item','categorie:list','categorie:item','panier:list','panier:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[groups(['produit:list','produit:item','ajouter:list','ajouter:item','categorie:list','categorie:item','panier:list','panier:item'])]
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

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    #[groups(['produit:list','produit:item'])]
    private ?Categorie $categorie = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'favoris')]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Avis::class)]
    private Collection $avis;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Commande::class)]
    private Collection $commandes;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: LigneCommande::class)]
    private Collection $ligneCommandes;


    public function __construct()
    {
        $this->ajouters = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->ligneCommandes = new ArrayCollection();
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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addFavori($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeFavori($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): static
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setProduit($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): static
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getProduit() === $this) {
                $avi->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setProduit($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getProduit() === $this) {
                $commande->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LigneCommande>
     */
    public function getLigneCommandes(): Collection
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): static
    {
        if (!$this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes->add($ligneCommande);
            $ligneCommande->setProduit($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): static
    {
        if ($this->ligneCommandes->removeElement($ligneCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getProduit() === $this) {
                $ligneCommande->setProduit(null);
            }
        }

        return $this;
    }   
}
