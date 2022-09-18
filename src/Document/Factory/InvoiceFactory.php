<?php declare(strict_types=1);

namespace App\Document\Factory;

use App\Document\Invoice;
use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Security\Core\Security;

class InvoiceFactory
{
    private DocumentManager $documentManager;

    /** @var Security */
    private Security $securityContext;

    public function __construct(DocumentManager $documentManager, Security $securityContext)
    {
        $this->documentManager = $documentManager;
        $this->securityContext = $securityContext;
    }

    public function createFromInvoice(?Invoice $invoice = null): Invoice {
        $newInvoice = new Invoice();
        $newInvoice->setClient($invoice->getClient());
        $newInvoice->setCurrency($invoice->getCurrency());
        $newInvoice->setNumber(
            $this->getNextInvoiceNumber($invoice->getNumber())
        );
        $newInvoice->setOwnerId($invoice->getOwnerId());
    }

    public function getNextInvoiceNumber($number = null): string {
        if ($number === null) {
            $lastInvoice = $this->getLastInvoice();
            if (!$lastInvoice)
            $number = $lastInvoice ? $lastInvoice->getNumber() : $this->seriesManagerGetString(0);
        }

        $newNumber = preg_replace_callback("|(\d+)$|", function(array $num){
            return sprintf("%0".strlen($num[0])."d",intval($num[0])+1);
        }, $number);

        return $newNumber;
    }

    public function getLastInvoice(): ?Invoice {
        $ownerId = $this->securityContext->getToken()->getUser()->getId();
        $invoice = $this->documentManager->createQueryBuilder(Invoice::class)
            ->field('ownerId')->equals($ownerId)
            ->sort('updatedAt', 'DESC')
            ->limit(1)
            ->getQuery()
            ->execute();

        return $invoice->current();
    }

    public function createNextInvoice(): Invoice {
        /** @var User $user */
        $user = $this->securityContext->getToken()->getUser();

        $lastInvoice = $this->getLastInvoice();

        $newInvoice = new Invoice();
        $newInvoice->setOwnerId($user->getId());
        $newInvoice->setClient($lastInvoice ? $lastInvoice->getClient() : null);
        $newInvoice->setNumber($this->getNextInvoiceNumber($lastInvoice ? $lastInvoice->getNumber() : null));

        return $newInvoice;
    }

    public function seriesManagerGetString($number): string {
        return sprintf('2020-%02d', $number);
    }
}