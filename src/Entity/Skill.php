<?php

namespace App\Entity;

use App\Entity\Base\DescriptionEntity;
use App\Entity\Base\NameEntity;
use App\Entity\Base\SlugEntity;
use App\Repository\SkillRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 */
class Skill
{
    use NameEntity;
    use DescriptionEntity;
    use SlugEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=SkillCategory::class, inversedBy="skills")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?SkillCategory
    {
        return $this->category;
    }

    public function setCategory(?SkillCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function exportArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'description' => $this->getDescription(),
            'category' => [
                'id' => $this->getCategory()->getId(),
                'name' => $this->getCategory()->getName(),
                'slug' => $this->getCategory()->getSlug(),
                'description' => $this->getCategory()->getDescription(),
            ],
        ];
    }
}
