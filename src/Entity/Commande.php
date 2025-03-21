<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToMany(targetEntity: Produits::class, mappedBy: 'fk_commande')]
    private Collection $produits;

    #[ORM\ManyToMany(targetEntity: produits::class, inversedBy: 'commandes')]
    private Collection $fk_produits;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: "commandes")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->fk_produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;
        return $this;
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

    /**
     * @return Collection<int, Produits>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produits $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
        }
        return $this;
    }

    public function removeProduit(Produits $produit): static
    {
        $this->produits->removeElement($produit);
        return $this;
    }

    /**
     * @return Collection<int, produits>
     */
    public function getFkProduits(): Collection
    {
        return $this->fk_produits;
    }

    public function addFkProduit(produits $fkProduit): static
    {
        if (!$this->fk_produits->contains($fkProduit)) {
            $this->fk_produits->add($fkProduit);
        }
        return $this;
    }

    public function removeFkProduit(produits $fkProduit): static
    {
        $this->fk_produits->removeElement($fkProduit);
        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;
        return $this;
    }
}