<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\EntityListeners(['App\EntityListener\UserListener'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Length(min:2, max:50)]
    #[Assert\Email()]
    #[ORM\Column(length: 50, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private array $roles = [];

    private ?string $plainPassword = null;
    private ?string $NewPassword = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\NotBlank()]
    private ?string $password ='password';

    #[Assert\Length(min:2, max:50)]
    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[Assert\Length(min:2, max:50)]
    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[Assert\Length(min:6, max:10)]
    #[ORM\Column(length: 10)]
    private ?string $numTel = null;

    #[Assert\Length(min:1, max:10)]
    #[ORM\Column(length: 10)]
    private ?string $numVoie = null;

    #[Assert\Length(min:10, max:100)]
    #[ORM\Column(length: 100)]
    private ?string $voie = null;

    #[Assert\Length(min:2, max:50)]
    #[ORM\Column(length: 50)]
    private ?string $ville = null;

    #[Assert\Length(min:2, max:10)]
    #[ORM\Column(length: 10)]
    private ?string $codePostal = null;

    
    #[ORM\Column(length: 20)]
    private ?string $livraisonFav = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set the value of plain password
     *
     * @return self
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function getNewPassword(): string
    {
        return $this->password;
    }

    public function setNewPassword(string $password): static
    {
        $this->password = $password;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): static
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getNumVoie(): ?string
    {
        return $this->numVoie;
    }

    public function setNumVoie(string $numVoie): static
    {
        $this->numVoie = $numVoie;

        return $this;
    }

    public function getVoie(): ?string
    {
        return $this->voie;
    }

    public function setVoie(string $voie): static
    {
        $this->voie = $voie;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): static
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getLivraisonFav(): ?string
    {
        return $this->livraisonFav;
    }

    public function setLivraisonFav(string $livraisonFav): static
    {
        $this->livraisonFav = $livraisonFav;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}