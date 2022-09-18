<?php declare(strict_types=1);

namespace App\Document\Traits;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

trait EntityOwnerTrait
{
    /**
     * @MongoDB\Field(type="string",nullable=false)
     * @Assert\NotNull
     */
    protected ?string $ownerId = null;


    /**
     * @return string|null
     */
    public function getOwnerId(): ?string
    {
        return $this->ownerId;
    }

    /**
     * @param string|null $ownerId
     *
     * @return mixed
     */
    public function setOwnerId(?string $ownerId)
    {
        $this->ownerId = $ownerId;

        return $this;
    }
}