<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=14)
     */
    private $phone;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="Client", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Adresselivraison::class, mappedBy="Client")
     */
    private $adresselivraisons;

    /**
     * @ORM\OneToMany(targetEntity=Adressefacturation::class, mappedBy="Client")
     */
    private $adressefacturations;

    /**
     * @ORM\OneToOne(targetEntity=Panier::class, mappedBy="Client", cascade={"persist", "remove"})
     */
    private $panier;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="Client")
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="Client")
     */
    private $commentaires;

    public function __construct()
    {
        $this->adresselivraisons = new ArrayCollection();
        $this->adressefacturations = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setClient(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getClient() !== $this) {
            $user->setClient($this);
        }

        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Adresselivraison[]
     */
    public function getAdresselivraisons(): Collection
    {
        return $this->adresselivraisons;
    }

    public function addAdresselivraison(Adresselivraison $adresselivraison): self
    {
        if (!$this->adresselivraisons->contains($adresselivraison)) {
            $this->adresselivraisons[] = $adresselivraison;
            $adresselivraison->setClient($this);
        }

        return $this;
    }

    public function removeAdresselivraison(Adresselivraison $adresselivraison): self
    {
        if ($this->adresselivraisons->removeElement($adresselivraison)) {
            // set the owning side to null (unless already changed)
            if ($adresselivraison->getClient() === $this) {
                $adresselivraison->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Adressefacturation[]
     */
    public function getAdressefacturations(): Collection
    {
        return $this->adressefacturations;
    }

    public function addAdressefacturation(Adressefacturation $adressefacturation): self
    {
        if (!$this->adressefacturations->contains($adressefacturation)) {
            $this->adressefacturations[] = $adressefacturation;
            $adressefacturation->setClient($this);
        }

        return $this;
    }

    public function removeAdressefacturation(Adressefacturation $adressefacturation): self
    {
        if ($this->adressefacturations->removeElement($adressefacturation)) {
            // set the owning side to null (unless already changed)
            if ($adressefacturation->getClient() === $this) {
                $adressefacturation->setClient(null);
            }
        }

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->panier;
    }

    public function setPanier(?Panier $panier): self
    {
        // unset the owning side of the relation if necessary
        if ($panier === null && $this->panier !== null) {
            $this->panier->setClient(null);
        }

        // set the owning side of the relation if necessary
        if ($panier !== null && $panier->getClient() !== $this) {
            $panier->setClient($this);
        }

        $this->panier = $panier;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setClient($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getClient() === $this) {
                $commentaire->setClient(null);
            }
        }

        return $this;
    }
}