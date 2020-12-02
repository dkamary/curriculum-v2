<?php

namespace App\Entity;

use App\Entity\Base\ActiveEntity;
use App\Entity\Base\AlphaEntity;
use App\Entity\Base\NameEntity;
use App\Repository\LanguageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LanguageRepository::class)
 */
class Language
{
    use NameEntity;
    use AlphaEntity;
    use ActiveEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Asset::class)
     */
    private $icon;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIcon(): ?Asset
    {
        return $this->icon;
    }

    public function setIcon(?Asset $icon): self
    {
        $this->icon = $icon;

        return $this;
    }
}
