<?php

namespace App\Entity;

use App\Repository\OtherSkillRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OtherSkillRepository::class)
 */
class OtherSkill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Other::class, inversedBy="otherSkills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $other;

    /**
     * @ORM\ManyToOne(targetEntity=Skill::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $skill;

    /**
     * @ORM\ManyToOne(targetEntity=SkillLevel::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $level;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOther(): ?Other
    {
        return $this->other;
    }

    public function setOther(?Other $other): self
    {
        $this->other = $other;

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

    public function getLevel(): ?SkillLevel
    {
        return $this->level;
    }

    public function setLevel(?SkillLevel $level): self
    {
        $this->level = $level;

        return $this;
    }
}
