<?php declare(strict_types=1);

namespace App\Document\Factory;

use App\Document\AbstractContactDocument;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class UserContact extends AbstractContactDocument
{
}
