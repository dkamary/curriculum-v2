<?php

namespace App\Entity;

use App\Entity\Base\ActiveEntity;
use App\Entity\Base\DescriptionEntity;
use App\Entity\Base\NameEntity;
use App\Repository\AssetTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AssetTypeRepository::class)
 */
class AssetType
{
    use NameEntity;
    use DescriptionEntity;
    use ActiveEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $mime;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $extensions;

    /**
     * @ORM\OneToMany(targetEntity=Asset::class, mappedBy="assetType")
     */
    private $assets;

    public function __construct()
    {
        $this->assets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMime(): ?string
    {
        return $this->mime;
    }

    public function setMime(string $mime): self
    {
        $this->mime = $mime;

        return $this;
    }

    public function getExtensions(): ?string
    {
        return $this->extensions;
    }

    public function setExtensions(?string $extensions): self
    {
        $this->extensions = $extensions;

        return $this;
    }

    /**
     * @return Collection|Asset[]
     */
    public function getAssets(): Collection
    {
        return $this->assets;
    }

    public function addAsset(Asset $asset): self
    {
        if (!$this->assets->contains($asset)) {
            $this->assets[] = $asset;
            $asset->setAssetType($this);
        }

        return $this;
    }

    public function removeAsset(Asset $asset): self
    {
        if ($this->assets->removeElement($asset)) {
            // set the owning side to null (unless already changed)
            if ($asset->getAssetType() === $this) {
                $asset->setAssetType(null);
            }
        }

        return $this;
    }
}
