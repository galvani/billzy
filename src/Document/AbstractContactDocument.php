<?php declare(strict_types=1);

namespace App\Document;

use Doctrine\DBAL\Exception\InvalidArgumentException;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Intl\Countries;

abstract class AbstractContactDocument
{
    /** @MongoDB\Id */
    protected ?string $id = null;

    /** @MongoDB\Field(type="string") */
    protected string $name;

    /** @MongoDB\Field(type="string") */
    protected ?string $address = null;

    /** @MongoDB\Field(type="string") */
    protected ?string $address2 = null;

    /** @MongoDB\Field(type="string") */
    protected ?string $zipCode = null;

    /** @MongoDB\Field(type="string") */
    protected ?string $city = null;

    /** @MongoDB\Field(type="string") */
    protected ?string $country = null;

    /** @MongoDB\Field(type="string") */
    protected ?string $comment = null;

    /** @MongoDB\Field(type="string") */
    protected ?string $email = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): AbstractContactDocument
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): AbstractContactDocument
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): AbstractContactDocument
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): AbstractContactDocument
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): AbstractContactDocument
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): AbstractContactDocument
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    /** @throws InvalidArgumentException */
    public function setCountry(?string $country): AbstractContactDocument
    {
        if (null !== $country and !in_array($country, Countries::getCountryCodes(), true)) {
            throw new InvalidArgumentException('Invalid country');
        }

        $this->country = $country;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): AbstractContactDocument
    {
        $this->comment = $comment;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): AbstractContactDocument
    {
        $this->email = $email;

        return $this;
    }
}
