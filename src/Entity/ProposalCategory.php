<?php

namespace App\Entity;

use App\Entity\Base\ActiveEntity;
use App\Entity\Base\DescriptionEntity;
use App\Entity\Base\LongDescriptionEntity;
use App\Entity\Base\NameEntity;
use App\Entity\Base\SlugEntity;
use App\Repository\ProposalCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProposalCategoryRepository::class)
 */
class ProposalCategory
{
    use NameEntity, SlugEntity, DescriptionEntity, LongDescriptionEntity, ActiveEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ProposalCategory::class, inversedBy="children")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=ProposalCategory::class, mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\OneToMany(targetEntity=Proposal::class, mappedBy="category")
     */
    private $proposals;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $icon;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->proposals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(self $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self
    {
        if ($this->children->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Proposal[]
     */
    public function getProposals(): Collection
    {
        return $this->proposals;
    }

    public function addProposal(Proposal $proposal): self
    {
        if (!$this->proposals->contains($proposal)) {
            $this->proposals[] = $proposal;
            $proposal->setCategory($this);
        }

        return $this;
    }

    public function removeProposal(Proposal $proposal): self
    {
        if ($this->proposals->removeElement($proposal)) {
            // set the owning side to null (unless already changed)
            if ($proposal->getCategory() === $this) {
                $proposal->setCategory(null);
            }
        }

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }
}
