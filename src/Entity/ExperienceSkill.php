<?php

namespace App\Entity;

use App\Repository\ExperienceSkillRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExperienceSkillRepository::class)
 * @ORM\Table(
 *      name="experience_skill",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="U_user_exp_skill", columns={"experience_id", "skill_id"})
 *      }
 * )
 */
class ExperienceSkill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Experience::class, inversedBy="experienceSkills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $experience;

    /**
     * @ORM\ManyToOne(targetEntity=Skill::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $skill;

    /**
     * @ORM\Column(type="float")
     */
    private $xp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExperience(): ?Experience
    {
        return $this->experience;
    }

    public function setExperience(?Experience $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getSkill(): ?Skill
    {
        return $this->skill;
    }

    public function setSkill(?Skill $skill): self
    {
        $this->skill = $skill;

        return $this;
    }

    public function getName(): string
    {
        if ($skill = $this->getSkill()) {
            return $skill->getName();
        }

        return '';
    }

    public function getXp(): ?float
    {
        return $this->xp;
    }

    public function setXp(float $xp): self
    {
        $this->xp = $xp;

        return $this;
    }
}
