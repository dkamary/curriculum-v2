<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

trait ActiveEntity
{
    /**
     *
     * @var boolean $isActive
     * @ORM\Column(type="boolean")
     */
    private $isActive = true;

    /**
     * get isActive
     *
     * @return boolean
     */
    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return self
     */
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}
