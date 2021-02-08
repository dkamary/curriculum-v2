<?php

namespace App\Entity;

use App\Entity\Base\ActiveEntity;
use App\Entity\Base\CreatedAtEntity;
use App\Entity\Base\DeletedAtEntity;
use App\Entity\Base\EndEntity;
use App\Entity\Base\LongDescriptionEntity;
use App\Entity\Base\NameEntity;
use App\Entity\Base\StartEntity;
use App\Entity\Base\UpdatedAtEntity;
use App\Repository\ProposalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProposalRepository::class)
 * @ORM\Table(
 *  name="proposal",
 *  indexes={
 *      @ORM\Index(name="FT_proposal_long_description", columns={"long_description"}, flags={"fulltext"}),
 *      @ORM\Index(name="IDX_proposal_start", columns={"start"}),
 *      @ORM\Index(name="IDX_proposal_end", columns={"end"}),
 *      @ORM\Index(name="IDX_proposal_start_end", columns={"start", "end"}),
 *      @ORM\Index(name="IDX_proposal_name", columns={"name"}),
 *      @ORM\Index(name="IDX_proposal_name_reference", columns={"name", "reference"})
 *  }
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class Proposal
{
    // use NameEntity;
    use LongDescriptionEntity;
    use StartEntity;
    use EndEntity;
    use CreatedAtEntity;
    use UpdatedAtEntity;
    use DeletedAtEntity;
    use ActiveEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="proposals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity=Asset::class)
     */
    private $featuredImage;

    /**
     * @ORM\ManyToOne(targetEntity=Asset::class)
     */
    private $bannerImage;

    /**
     * @ORM\OneToMany(targetEntity=ProposalAttachment::class, mappedBy="proposal")
     */
    private $proposalAttachments;

    /**
     * @ORM\OneToMany(targetEntity=Applier::class, mappedBy="proposal")
     */
    private $appliers;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->proposalAttachments = new ArrayCollection();
        $this->appliers = new ArrayCollection();
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

    public function getFeaturedImage(): ?Asset
    {
        return $this->featuredImage;
    }

    public function setFeaturedImage(?Asset $featuredImage): self
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    public function getBannerImage(): ?Asset
    {
        return $this->bannerImage;
    }

    public function setBannerImage(?Asset $bannerImage): self
    {
        $this->bannerImage = $bannerImage;

        return $this;
    }

    /**
     * @return Collection|ProposalAttachment[]
     */
    public function getProposalAttachments(): Collection
    {
        return $this->proposalAttachments;
    }

    public function addProposalAttachment(ProposalAttachment $proposalAttachment): self
    {
        if (!$this->proposalAttachments->contains($proposalAttachment)) {
            $this->proposalAttachments[] = $proposalAttachment;
            $proposalAttachment->setProposal($this);
        }

        return $this;
    }

    public function removeProposalAttachment(ProposalAttachment $proposalAttachment): self
    {
        if ($this->proposalAttachments->removeElement($proposalAttachment)) {
            // set the owning side to null (unless already changed)
            if ($proposalAttachment->getProposal() === $this) {
                $proposalAttachment->setProposal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Applier[]
     */
    public function getAppliers(): Collection
    {
        return $this->appliers;
    }

    public function addApplier(Applier $applier): self
    {
        if (!$this->appliers->contains($applier)) {
            $this->appliers[] = $applier;
            $applier->setProposal($this);
        }

        return $this;
    }

    public function removeApplier(Applier $applier): self
    {
        if ($this->appliers->removeElement($applier)) {
            // set the owning side to null (unless already changed)
            if ($applier->getProposal() === $this) {
                $applier->setProposal(null);
            }
        }

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
