<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RoleRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource(
 * collectionOperations={
 * "get"={},
 * "post"={},
 * },
 * itemOperations={
 * "get"={},
 * "put"={},
 * "delete"={}
 * }
 * )
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Admin::class, mappedBy="role")
     */
    private $admine;

    /**
     * @ORM\OneToMany(targetEntity=Candidats::class, mappedBy="role")
     */
    private $candidats;

    /**
     * @ORM\OneToMany(targetEntity=Electeur::class, mappedBy="role")
     */
    private $electeurs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_role;

    public function __construct()
    {
        $this->admine = new ArrayCollection();
        $this->candidats = new ArrayCollection();
        $this->electeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRole(): ?string
    {
        return $this->nom_role;
    }

    public function setNomRole(string $nom_role): self
    {
        $this->nom_role = $nom_role;

        return $this;
    }

    /**
     * @return Collection|Admin[]
     */
    public function getAdmine(): Collection
    {
        return $this->admine;
    }

    public function addAdmine(Admin $admine): self
    {
        if (!$this->admine->contains($admine)) {
            $this->admine[] = $admine;
            $admine->setRole($this);
        }

        return $this;
    }

    public function removeAdmine(Admin $admine): self
    {
        if ($this->admine->removeElement($admine)) {
            // set the owning side to null (unless already changed)
            if ($admine->getRole() === $this) {
                $admine->setRole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Candidats[]
     */
    public function getCandidats(): Collection
    {
        return $this->candidats;
    }

    public function addCandidat(Candidats $candidat): self
    {
        if (!$this->candidats->contains($candidat)) {
            $this->candidats[] = $candidat;
            $candidat->setRole($this);
        }

        return $this;
    }

    public function removeCandidat(Candidats $candidat): self
    {
        if ($this->candidats->removeElement($candidat)) {
            // set the owning side to null (unless already changed)
            if ($candidat->getRole() === $this) {
                $candidat->setRole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Electeur[]
     */
    public function getElecteurs(): Collection
    {
        return $this->electeurs;
    }

    public function addElecteur(Electeur $electeur): self
    {
        if (!$this->electeurs->contains($electeur)) {
            $this->electeurs[] = $electeur;
            $electeur->setRole($this);
        }

        return $this;
    }

    public function removeElecteur(Electeur $electeur): self
    {
        if ($this->electeurs->removeElement($electeur)) {
            // set the owning side to null (unless already changed)
            if ($electeur->getRole() === $this) {
                $electeur->setRole(null);
            }
        }

        return $this;
    }

   
}
