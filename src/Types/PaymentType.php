<?php declare(strict_types=1);

namespace App\Types;

use Doctrine\ODM\MongoDB\Types\ClosureToPHP;
use Doctrine\ODM\MongoDB\Types\Type;
use MongoDB\BSON\UTCDateTime;

class PaymentType extends Type
{
    // This trait provides default closureToPHP used during data hydration
    use ClosureToPHP;

    public function convertToPHPValue($value): \DateTime
    {
        // This is called to convert a Mongo value to a PHP representation
        return new \DateTime('@' . $value->sec);
    }

    public function convertToDatabaseValue($value): UTCDateTime
    {
        // This is called to convert a PHP value to its Mongo equivalent
        return new UTCDateTime($value);
    }
}