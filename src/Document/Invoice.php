<?php declare(strict_types=1);

namespace App\Document;

use App\Document\Embedded\InvoiceItem;
use App\Document\Traits\EntityOwnerTrait;
use App\Document\Traits\EntityUpdatedTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document as Document;
use Doctrine\ODM\MongoDB\PersistentCollection;
use Hateoas\Configuration\Annotation\Relation as Relation;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Expose as Expose;
use JMS\Serializer\Annotation\Groups as Groups;

//phpcs:disable SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingNativeTypeHint
//phpcs:disable SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
//phpcs:disable SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingAnyTypeHint

/**
 * @Document(collection="Invoices",repositoryClass=InvoiceRepository::class)
 * @Relation("self", href = "expr('/invoice/' ~ object.getId())")
 */
class Invoice
{
    use EntityOwnerTrait, EntityUpdatedTrait;

    /**
     * @MongoDB\Id
     * @Groups({"Default", "simple"})
     *
     */
    protected ?string $id = null;

    /**
     * @MongoDB\Field(type="string",nullable=true)
     * @Serializer\Type("string")
     */
    protected ?string $number = null;

    /**
     * @MongoDB\Field(type="float")
     * @Groups({"Default", "simple"})
     * @Expose()
     */
    protected ?float $total = null;

    /**
     * @MongoDB\Field(type="string")
     * @Groups({"Default", "simple"})
     */
    protected ?string $currency = null;

    /**
     * @MongoDB\Field(type="date")
     * @Groups({"Default", "simple"})
     */
    protected ?\DateTime $issuedDate = null;

    /**
     * @MongoDB\Field(type="date")
     * @Groups({"Default", "simple"})
     */
    protected ?\DateTime $dueDate = null;

    /**
     * @MongoDB\EmbedMany(targetDocument=Payment::class)
     * @Groups({"Default"})
     * @var ArrayCollection<Payment> $payments
     */
    protected $payments;

    /**
     * @MongoDB\EmbedMany(targetDocument=InvoiceItem::class)
     * @var ArrayCollection<InvoiceItem>
     */
    protected $items;

    /** @MongoDB\EmbedOne(targetDocument=Client::class) */
    protected ?Client $client = null;


    public function __construct()
    {
        $this->setIssuedDate(new \DateTime);
        $this->items = new ArrayCollection;
        $this->payments = new ArrayCollection;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): Invoice
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @Expose()
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): Invoice
    {
        $this->number = $number;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): Invoice
    {
        $this->total = $total;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): Invoice
    {
        $this->currency = $currency;

        return $this;
    }

    public function getIssuedDate(): ?\DateTime
    {
        return $this->issuedDate;
    }

    public function setIssuedDate(\DateTime $issuedDate): Invoice
    {
        $this->issuedDate = $issuedDate;

        return $this;
    }

    public function getDueDate(): ?\DateTime
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate): Invoice
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getPayments(): PersistentCollection
    {
        return $this->payments;
    }

    public function setPayments(PersistentCollection $payments): Invoice
    {
        $this->payments = $payments;

        return $this;
    }

    public function addPayment(Payment $payment): Invoice {
        if (!$this->payments->contains($payment)) {
            $this->payments[] = $payment;
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /** @param ArrayCollection<mixed> $items */
    public function setItems($items): Invoice
    {
        $this->items = $items;

        return $this;
    }

    public function addItem(InvoiceItem $item): Invoice
    {
        if (!$this->getItems()->contains($item)) {
            $this->items[] = $item;
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(Client $client): Invoice
    {
        $this->client = $client;

        return $this;
    }

    public function getPaymentTotal(): float {
        $sum = 0;
        foreach ($this->getPayments() as $payment) {
            assert($payment instanceof Payment);
            $sum += $payment->getAmount();
        }
        return (float) $sum;
    }


}
