<?php declare(strict_types=1);

namespace App\Document;

use App\Document\Embedded\ClientContact;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document(collection="Clients") */
class Client
{
    /** @MongoDB\Id */
    protected ?string $id = null;

    /** @MongoDB\Field(type="bool") */
    protected bool $active = true;

    /** @MongoDB\Field(type="string") */
    protected string $company;

    /** @MongoDB\Field(type="string") */
    protected string $taxId;

    /** @MongoDB\Field(type="float") */
    protected ?float $unitPrice=null ;

    /**
     * @MongoDB\EmbedMany(targetDocument=ClientContact::class)
     * @var ClientContact[]
     */
    protected array $contacts;

    public function __construct()
    {
        $this->contacts = new ArrayCollection;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): Client
    {
        $this->id = $id;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): Client
    {
        $this->active = $active;

        return $this;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): Client
    {
        $this->company = $company;

        return $this;
    }

    public function getTaxId(): string
    {
        return $this->taxId;
    }

    public function setTaxId(string $tax_id): Client
    {
        $this->taxId = $tax_id;

        return $this;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): Client
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /** @return ArrayCollection<Contact> */
    public function getContacts()
    {
        return $this->contacts;
    }

    /** @param ArrayCollection<Contact> $contacts */
    public function setContacts($contacts): Client
    {
        $this->contacts = $contacts;

        return $this;
    }

    public function addContact(ClientContact $contact): Client
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
        }

        return $this;
    }
}
