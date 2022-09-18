<?php declare(strict_types=1);

namespace App\Document\Factory;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

trait DocumentConverter
{
    private static ?Serializer $serializer = null;

    /** @param mixed $document */
    protected static function getJson($document): ?string
    {
        return self::getSerializer()->serialize($document, JsonEncoder::FORMAT);
    }

    /**
     * @param mixed $document
     * @return mixed
     */
    protected static function castToDocument(string $documentClass, $document)
    {
        return self::getSerializer()->deserialize(self::getJson($document), $documentClass, JsonEncoder::FORMAT);
    }

    private static function getSerializer(): Serializer
    {
        if (is_null(self::$serializer)) {
            $encoders = [new JsonEncoder];
            $normalizers = [new ObjectNormalizer];

            self::$serializer = new Serializer($normalizers, $encoders);
        }

        return self::$serializer;
    }
}
