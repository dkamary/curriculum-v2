<?php

namespace App\Entity;

use App\Repository\ApplierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApplierRepository::class)
 * @ORM\Table(
 *      name="applier",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="U_applier_owner_proposal", columns={"owner_id", "proposal_id"})
 *      }
 * )
 */
class Applier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="appliers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity=Proposal::class, inversedBy="appliers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $proposal;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $applyDate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isValidate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $validateDate;

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

    public function getProposal(): ?Proposal
    {
        return $this->proposal;
    }

    public function setProposal(?Proposal $proposal): self
    {
        $this->proposal = $proposal;

        return $this;
    }

    public function getApplyDate(): ?\DateTimeInterface
    {
        return $this->applyDate;
    }

    public function setApplyDate(?\DateTimeInterface $applyDate): self
    {
        $this->applyDate = $applyDate;

        return $this;
    }

    public function getIsValidate(): ?bool
    {
        return $this->isValidate;
    }

    public function setIsValidate(?bool $isValidate): self
    {
        $this->isValidate = $isValidate;

        return $this;
    }

    public function getValidateDate(): ?\DateTimeInterface
    {
        return $this->validateDate;
    }

    public function setValidateDate(?\DateTimeInterface $validateDate): self
    {
        $this->validateDate = $validateDate;

        return $this;
    }
}
