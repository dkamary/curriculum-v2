<?php

namespace App\Entity\Base;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait CreatedAtEntity
{
    /**
     *
     * @var DateTime $createdAt
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * Get CreatedAt
     *
     * @return DateTime
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set CreatedAt
     *
     * @param DateTime $createdAt
     * @return self
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Callback when entity is about to be created
     *
     * @return void
     * @ORM\PrePersist
     */
    public function onCreate()
    {
        $this->createdAt = new DateTime();
    }
}
