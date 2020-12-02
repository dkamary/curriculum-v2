<?php

namespace App\Entity;

use App\Entity\Base\LevelEntity;
use App\Entity\Base\NameEntity;
use App\Repository\LanguageLevelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LanguageLevelRepository::class)
 */
class LanguageLevel
{
    use NameEntity;
    use LevelEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
