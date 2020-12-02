<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

trait LongDescriptionEntity
{
    /**
     *
     * @var string $longDescription
     * @ORM\Column(type="text")
     */
    private $longDescription;

    /**
     * Get longDescription
     *
     * @return string
     */
    public function getLongDescription(): string
    {
        return $this->longDescription;
    }

    /**
     * Set longDescription
     *
     * @param string $longDescription
     * @return self
     */
    public function setLongDescription(string $longDescription): self
    {
        $this->longDescription = $longDescription;

        return $this;
    }
}
