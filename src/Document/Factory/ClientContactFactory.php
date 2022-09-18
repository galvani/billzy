<?php declare(strict_types=1);

namespace App\Document\Factory;

use App\Document\Contact;
use App\Document\Embedded\ClientContact;

class ClientContactFactory
{
    use DocumentConverter;

    public static function createFromContact(Contact $contact): ClientContact
    {
        return self::castToDocument(ClientContact::class, $contact);
    }
}
