<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ElecteurRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"electeur:read"}},
 * denormalizationContext={"groups"={"electeur:write"}},
 * collectionOperations={
 * "get"={},
 * "post"={},
 * },
 * itemOperations={
 * "get"={},
 * "put"={},
 * "delete"={}
 * })
 * @ORM\Entity(repositoryClass=ElecteurRepository::class)
 */
class Electeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"electeur:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"electeur:read","electeur:write"})
     */
    private $nomElecteur;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"electeur:read","electeur:write"})
     */
    private $prenomElecteur;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"electeur:read","electeur:write"})
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"electeur:read","electeur:write"})
     */
    private $classe;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="electeur")
     */
    private $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomElecteur(): ?string
    {
        return $this->nomElecteur;
    }

    public function setNomElecteur(string $nomElecteur): self
    {
        $this->nomElecteur = $nomElecteur;

        return $this;
    }

    public function getPrenomElecteur(): ?string
    {
        return $this->prenomElecteur;
    }

    public function setPrenomElecteur(string $prenomElecteur): self
    {
        $this->prenomElecteur = $prenomElecteur;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getClasse(): ?string
    {
        return $this->classe;
    }

    public function setClasse(string $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setElecteur($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getElecteur() === $this) {
                $user->setElecteur(null);
            }
        }

        return $this;
    }

}
