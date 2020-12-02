<?php

namespace App\Entity;

use App\Entity\Base\LevelEntity;
use App\Entity\Base\NameEntity;
use App\Repository\SkillLevelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillLevelRepository::class)
 */
class SkillLevel
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
