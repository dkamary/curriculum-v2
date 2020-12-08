<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

trait DescriptionEntity
{
    /**
     *
     * @var string $description
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * Get Description
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set Description
     *
     * @param string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
