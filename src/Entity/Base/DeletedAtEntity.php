<?php

namespace App\Entity\Base;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait DeletedAtEntity
{
    /**
     *
     * @var DateTime $deletedAt
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * Get DeletedAt
     *
     * @return DateTime
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * Set DeletedAt
     *
     * @param DateTime $deletedAt
     * @return self
     */
    public function setDeletedAt(DateTime $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Callback when entity is about to be Deleted
     *
     * @return void
     */
    public function delete()
    {
        $this->deletedAt = new DateTime();
    }
}
