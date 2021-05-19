<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"user:read"}},
 * denormalizationContext={"groups"={"user:write"}},
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
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, EncoderAwareInterface  
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user:read","user:write"})
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"user:read","user:write"})
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"user:read","user:write"})
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity=Electeur::class, inversedBy="user")
     * @Groups({"user:read","user:write"})
     */
    private $electeur;

    /**
     * @ORM\ManyToOne(targetEntity=Candidats::class, inversedBy="user")
     * @Groups({"user:read","user:write"})
     */
    private $candidats;

    /**
     * @ORM\ManyToOne(targetEntity=Admin::class, inversedBy="user")
     * @Groups({"user:read","user:write"})
     */
    private $admins;

    /**
     * @ORM\ManyToOne(targetEntity=Roles::class, inversedBy="users")
     * @Groups({"user:read","user:write"})
     */
    private $role;

    public function __construct($username)    {
        $this->isActive = true;
        $this->username = $username;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getElecteur(): ?Electeur
    {
        return $this->electeur;
    }

    public function setElecteur(?Electeur $electeur): self
    {
        $this->electeur = $electeur;

        return $this;
    }

    public function getCandidats(): ?Candidats
    {
        return $this->candidats;
    }

    public function setCandidats(?Candidats $candidats): self
    {
        $this->candidats = $candidats;

        return $this;
    }

    public function getAdmins(): ?Admin
    {
        return $this->admins;
    }

    public function setAdmins(?Admin $admins): self
    {
        $this->admins = $admins;

        return $this;
    }

    public function getRole(): ?Roles
    {
        return $this->role;
    }

    public function setRole(?Roles $role): self
    {
        $this->role = $role;

        return $this;
    }

     /**
     * Indique si l'utilisateur utilise l'encodage de mot de passe legacy ou le nouveau
     * 
     * @return boolean
     */
    public function hasLegacyPassword(): bool
    {
        return null !== $this->oldPassword;
    }

    /**
     * {@inheritDoc}
     */
    public function getEncoderName()
    {
        if ($this->hasLegacyPassword()) {
            // L'utilisateur est configuré avec un mot de passe legacy, utiliser l'encodeur legacy
            // configured in security.yaml
            return 'legacy_encoder';
        }

        // L'utilisateur est configuré avec l'encodage par défaut (ici Argon2i), utiliser l'encodeur par défaut
        return null;
    }
}
