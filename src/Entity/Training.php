<?php

namespace App\Entity;

use App\Entity\Base\CreatedAtEntity;
use App\Entity\Base\EndEntity;
use App\Entity\Base\StartEntity;
use App\Entity\Base\UpdatedAtEntity;
use App\Repository\TrainingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrainingRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Training
{
    use StartEntity;
    use EndEntity;
    use CreatedAtEntity;
    use UpdatedAtEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="trainings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $school;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $diploma;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $note;

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

    public function getSchool(): ?string
    {
        return $this->school;
    }

    public function setSchool(string $school): self
    {
        $this->school = $school;

        return $this;
    }

    public function getDiploma(): ?string
    {
        return $this->diploma;
    }

    public function setDiploma(string $diploma): self
    {
        $this->diploma = $diploma;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }
}
