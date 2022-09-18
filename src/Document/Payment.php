<?php declare(strict_types=1);

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB; // phpcs:ignore

/** @MongoDB\EmbeddedDocument */
class Payment
{
    /** @MongoDB\Id */
    protected ?string $id = null;

    /** @MongoDB\Field(type="float") */
    protected ?float $amount = null;

    /** @MongoDB\Field(type="string") */
    protected ?string $currency = null;

    /** @MongoDB\Field(type="date") */
    protected ?\DateTime $receiptDate = null;

    /** @MongoDB\Field(type="date") */
    protected ?\DateTime $scheduledDate = null;

    /** @MongoDB\Field(type="date") */
    protected ?\DateTime $type = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): Payment
    {
        $this->id = $id;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): Payment
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): Payment
    {
        $this->currency = $currency;

        return $this;
    }

    public function getReceiptDate(): ?\DateTime
    {
        return $this->receiptDate;
    }

    public function setReceiptDate(?\DateTime $receiptDate): Payment
    {
        $this->receiptDate = $receiptDate;

        return $this;
    }



    }
