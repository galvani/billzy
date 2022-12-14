<?php declare(strict_types=1);

namespace App\Document;

use App\Security\User as SecurityUser;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @MongoDB\Document(collection="users")
 */
class
User extends SecurityUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    /** @MongoDB\Id */
    private string $id;

    /**
     * @MongoDB\Field(type="string")
     * @MongoDB\UniqueIndex
     */
    #[Assert\NotBlank]
    #[Assert\Email]
    protected $email;

    /**
     * @MongoDB\Field(type="hash")
     */
    private $roles = [];

    /**
     * @MongoDB\Field(type="string")
     */
    #[Assert\NotBlank]
    private string $password;

    /** @MongoDB\EmbedOne("Contact")  */
    private Contact $contact;

    /**
     * @MongoDB\EmbedMany(targetDocument=Contact::class)
     * @var Contact[]
     */
    private array $contacts;

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /** @see UserInterface */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function hasRole(string $role): bool {
        return in_array($role, $this->getRoles(), true);
    }

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /** @return Contact[] */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    public function setContacts(array $contacts): User
    {
        $this->contacts = $contacts;
        return $this;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }

    public function setContact(Contact $contact): self
    {
        $this->contact = $contact;
        return $this;
    }
}