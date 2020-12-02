<?php

namespace App\Entity;

use App\Entity\Base\CreatedAtEntity;
use App\Entity\Base\UpdatedAtEntity;
use App\Repository\OtherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OtherRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Other
{
    use CreatedAtEntity;
    use UpdatedAtEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="others")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity=OtherSkill::class, mappedBy="other")
     */
    private $otherSkills;

    public function __construct()
    {
        $this->otherSkills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|OtherSkill[]
     */
    public function getOtherSkills(): Collection
    {
        return $this->otherSkills;
    }

    public function addOtherSkill(OtherSkill $otherSkill): self
    {
        if (!$this->otherSkills->contains($otherSkill)) {
            $this->otherSkills[] = $otherSkill;
            $otherSkill->setOther($this);
        }

        return $this;
    }

    public function removeOtherSkill(OtherSkill $otherSkill): self
    {
        if ($this->otherSkills->removeElement($otherSkill)) {
            // set the owning side to null (unless already changed)
            if ($otherSkill->getOther() === $this) {
                $otherSkill->setOther(null);
            }
        }

        return $this;
    }
}
