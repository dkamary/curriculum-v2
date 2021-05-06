<?php

namespace App\Entity;

use App\Repository\ProposalSkillRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProposalSkillRepository::class)
 */
class ProposalSkill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Proposal::class, inversedBy="skills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $proposal;

    /**
     * @ORM\ManyToOne(targetEntity=Skill::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $skill;

    /**
     * @ORM\ManyToOne(targetEntity=SkillLevel::class)
     */
    private $level;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $xp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProposal(): ?Proposal
    {
        return $this->proposal;
    }

    public function setProposal(?Proposal $proposal): self
    {
        $this->proposal = $proposal;

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

    public function getXp(): ?float
    {
        return $this->xp;
    }

    public function setXp(?float $xp): self
    {
        $this->xp = $xp;

        return $this;
    }
}
