<?php

namespace App\Entity;

use App\Entity\Base\CreatedAtEntity;
use App\Entity\Base\EndEntity;
use App\Entity\Base\LongDescriptionEntity;
use App\Entity\Base\StartEntity;
use App\Entity\Base\UpdatedAtEntity;
use App\Repository\ExperienceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExperienceRepository::class)
 * @ORM\Table(
 *      name="experience",
 *      indexes={
 *          @ORM\Index(name="IDX_experience_description", columns={"long_description"}, flags={"fulltext"}),
 *          @ORM\Index(name="IDX_experience_start", columns={"start"}),
 *          @ORM\Index(name="IDX_experience_end", columns={"end"}),
 *          @ORM\Index(name="IDX_experience_start_end", columns={"start", "end"}),
 *          @ORM\Index(name="IDX_experience_company", columns={"company"})
 *      }
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class Experience
{
    use StartEntity;
    use EndEntity;
    use LongDescriptionEntity;
    use CreatedAtEntity;
    use UpdatedAtEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="experiences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company;

    /**
     * @ORM\OneToMany(targetEntity=ExperienceSkill::class, mappedBy="experience", cascade={"persist"})
     */
    private $experienceSkills;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jobTitle;

    public function __construct()
    {
        $this->experienceSkills = new ArrayCollection();
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

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection|ExperienceSkill[]
     */
    public function getExperienceSkills(): Collection
    {
        return $this->experienceSkills;
    }

    public function addExperienceSkill(ExperienceSkill $experienceSkill): self
    {
        if (!$this->experienceSkills->contains($experienceSkill)) {
            $this->experienceSkills[] = $experienceSkill;
            $experienceSkill->setExperience($this);
        }

        return $this;
    }

    public function removeExperienceSkill(ExperienceSkill $experienceSkill): self
    {
        if ($this->experienceSkills->removeElement($experienceSkill)) {
            // set the owning side to null (unless already changed)
            if ($experienceSkill->getExperience() === $this) {
                $experienceSkill->setExperience(null);
            }
        }

        return $this;
    }

    public function getJobTitle(): ?string
    {
        return $this->jobTitle;
    }

    public function setJobTitle(string $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }
}
