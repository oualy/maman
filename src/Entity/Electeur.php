<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ElecteurRepository;
use ApiPlatform\Core\Annotation\ApiResource;

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
 * })
 * @ORM\Entity(repositoryClass=ElecteurRepository::class)
 */
class Electeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomElecteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomElecteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $classe;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="electeurs")
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="electeur")
     */
    private $user;

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

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

   
}
