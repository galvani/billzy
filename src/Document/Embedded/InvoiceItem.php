<?php declare(strict_types=1);

namespace App\Document\Embedded;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\EmbeddedDocument */
class InvoiceItem
{
    /** @MongoDB\Id */
    protected ?string $id = null;

    /** @MongoDB\Field(type="date") */
    protected ?\DateTime $itemDate = null;

    /** @MongoDB\Field(type="string") */
    protected string $name;

    /** @MongoDB\Field(type="float") */
    protected float $amount;

    /** @MongoDB\Field(type="string") */
    protected string $unit;

    /** @MongoDB\Field(type="float") */
    protected ?float $unitPrice = null;

    /** @MongoDB\Field(type="float") */
    protected float $total;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): InvoiceItem
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): InvoiceItem
    {
        $this->name = $name;

        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): InvoiceItem
    {
        $this->amount = $amount;

        return $this;
    }

    public function getItemDate(): ?\DateTime
    {
        return $this->itemDate;
    }

    public function setItemDate(?\DateTime $itemDate): InvoiceItem
    {
        $this->itemDate = $itemDate;

        return $this;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): InvoiceItem
    {
        $this->unit = $unit;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): InvoiceItem
    {
        $this->total = $total;

        return $this;
    }

    public function getUnitPrice(): ?float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): InvoiceItem
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }
}
