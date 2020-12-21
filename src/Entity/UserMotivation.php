<?php

namespace App\Entity;

use App\Repository\UserMotivationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserMotivationRepository::class)
 */
class UserMotivation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userMotivations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity=ContractType::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $contract;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $presentation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isTraveller;

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

    public function getContract(): ?ContractType
    {
        return $this->contract;
    }

    public function setContract(?ContractType $contract): self
    {
        $this->contract = $contract;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(?string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getIsTraveller(): ?bool
    {
        return $this->isTraveller;
    }

    public function setIsTraveller(bool $isTraveller): self
    {
        $this->isTraveller = $isTraveller;

        return $this;
    }
}
