<?php

namespace App\Entity;

use App\Entity\Base\CommentEntity;
use App\Repository\ProposalAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProposalAttachmentRepository::class)
 */
class ProposalAttachment
{
    use CommentEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Proposal::class, inversedBy="proposalAttachments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $proposal;

    /**
     * @ORM\ManyToOne(targetEntity=Asset::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $asset;

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

    public function getAsset(): ?Asset
    {
        return $this->asset;
    }

    public function setAsset(?Asset $asset): self
    {
        $this->asset = $asset;

        return $this;
    }
}
