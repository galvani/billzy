<?php declare(strict_types=1);

namespace App\Document;

use App\Document\Traits\EntityOwnerTrait;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document(collection="Contacts") */
class Contact extends AbstractContactDocument
{
    use EntityOwnerTrait;

}
