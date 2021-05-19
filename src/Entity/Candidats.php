<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CandidatsRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"candidats:read"}},
 * denormalizationContext={"groups"={"candidats:write"}},
 * collectionOperations={
 * "get"={},
 * "post"={},
 * },
 * itemOperations={
 * "get"={},
 * "put"={},
 * "delete"={}
 * })
 * @ORM\Entity(repositoryClass=CandidatsRepository::class)
 */
class Candidats
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"candidats:read","candidats:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups({"candidats:read","candidats:write"})
     */
    private $prenomCandidat;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"candidats:read","candidats:write"})
     */
    private $nomCandidat;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"candidats:read","candidats:write"})
     */
    private $nomParti;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"candidats:read","candidats:write"})
     */
    private $classe;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"candidats:read","candidats:write"})
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="candidats")
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

    public function getPrenomCandidat(): ?string
    {
        return $this->prenomCandidat;
    }

    public function setPrenomCandidat(string $prenomCandidat): self
    {
        $this->prenomCandidat = $prenomCandidat;

        return $this;
    }

    public function getNomCandidat(): ?string
    {
        return $this->nomCandidat;
    }

    public function setNomCandidat(string $nomCandidat): self
    {
        $this->nomCandidat = $nomCandidat;

        return $this;
    }

    public function getNomParti(): ?string
    {
        return $this->nomParti;
    }

    public function setNomParti(string $nomParti): self
    {
        $this->nomParti = $nomParti;

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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

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
            $user->setCandidats($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCandidats() === $this) {
                $user->setCandidats(null);
            }
        }

        return $this;
    }
    
}
