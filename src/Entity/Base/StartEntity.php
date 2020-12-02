<?php

namespace App\Entity\Base;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait StartEntity
{
    /**
     *
     * @var DateTime $start
     * @ORM\Column(type="datetime")
     */
    private $start;

    /**
     * Get start
     *
     * @return DateTime
     */
    public function getStart(): ?DateTime
    {
        return $this->start;
    }

    /**
     * Set start
     *
     * @param DateTime $start
     * @return self
     */
    public function setStart(?DateTime $start): self
    {
        $this->start = $start;

        return $this;
    }
}
