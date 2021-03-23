<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\String\Slugger\AsciiSlugger;

trait SlugEntity
{
    /**
     *
     * @var string $name
     * @ORM\Column(type="string", length=150, unique=true, nullable=true)
     */
    private $slug;

    public function setSlug(string $slug): self
    {
        $this->slug = (new AsciiSlugger())->slug($slug);

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}
