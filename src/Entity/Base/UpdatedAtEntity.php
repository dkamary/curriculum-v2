<?php

namespace App\Entity\Base;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait UpdatedAtEntity
{
    /**
     *
     * @var DateTime $updatedAt
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * Get updatedAt
     *
     * @return DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param DateTime $updatedAt
     * @return self
     */
    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Callback when entity is about to be updated
     *
     * @return void
     * @ORM\PreUpdate
     */
    public function onUpdate()
    {
        $this->updatedAt = new DateTime();
    }
}
