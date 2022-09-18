<?php declare(strict_types=1);

namespace App\Document\Traits;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


trait EntityUpdatedTrait
{
    /**
     * @MongoDB\Field(type="date")
     * @Serializer\Groups({"Default"})
     * @Assert\NotNull
     */
    protected ?\DateTime $updatedAt = null;

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime|null $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(?\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}