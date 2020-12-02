<?php

namespace App\Entity;

use App\Entity\Base\DescriptionEntity;
use App\Entity\Base\NameEntity;
use App\Repository\SkillCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillCategoryRepository::class)
 */
class SkillCategory
{
    use NameEntity;
    use DescriptionEntity;

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

    /**
     * @ORM\ManyToOne(targetEntity=Asset::class)
     */
    private $banner;

    /**
     * @ORM\OneToMany(targetEntity=Skill::class, mappedBy="category")
     */
    private $skills;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
    }

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

    public function getBanner(): ?Asset
    {
        return $this->banner;
    }

    public function setBanner(?Asset $banner): self
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->setCategory($this);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skills->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getCategory() === $this) {
                $skill->setCategory(null);
            }
        }

        return $this;
    }
}
