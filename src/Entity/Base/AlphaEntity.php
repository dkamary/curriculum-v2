<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

trait AlphaEntity
{
    /**
     * @var string
     * @ORM\Column(type="string", length=2, unique=true)
     */
    private $alpha2;

    /**
     * @var string
     * @ORM\Column(type="string", length=3, unique=true)
     */
    private $alpha3;

    /**
     * Get Alpha2
     *
     * @return string
     */
    public function getAlpha2(): string
    {
        return $this->alpha2;
    }

    /**
     * Get Alpha3
     *
     * @return string
     */
    public function getAlpha3(): string
    {
        return $this->alpha3;
    }

    /**
     * Set Alpha2
     *
     * @param string $alpha2
     * @return self
     */
    public function setAlpha2(string $alpha2): self
    {
        $this->alpha2 = $alpha2;

        return $this;
    }

    /**
     * Set Alpha3
     *
     * @param string $alpha2
     * @return self
     */
    public function setAlpha3(string $alpha3): self
    {
        $this->alpha3 = $alpha3;

        return $this;
    }
}
