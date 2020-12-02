<?php

namespace App\Entity\Base;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait EndEntity
{
    /**
     *
     * @var DateTime $end
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end;

    /**
     * Get end
     *
     * @return DateTime
     */
    public function getEnd(): ?DateTime
    {
        return $this->end;
    }

    /**
     * Set end
     *
     * @param DateTime $end
     * @return self
     */
    public function setEnd(?DateTime $end): self
    {
        $this->end = $end;

        return $this;
    }
}
