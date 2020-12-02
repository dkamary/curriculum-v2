<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

trait NameEntity
{
    /**
     *
     * @var string $name
     * @ORM\Column(type="string", length=150, unique=true)
     */
    private $name;

    /**
     * Get Name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set Name
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
