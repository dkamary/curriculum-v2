<?php

namespace App\Entity;

use App\Entity\Base\CreatedAtEntity;
use App\Entity\Base\UpdatedAtEntity;
use App\Repository\LanguageKnowledgeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LanguageKnowledgeRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class LanguageKnowledge
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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="languageKnowledges")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity=LanguageLevel::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $level;

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

    public function getLevel(): ?LanguageLevel
    {
        return $this->level;
    }

    public function setLevel(?LanguageLevel $level): self
    {
        $this->level = $level;

        return $this;
    }
}
