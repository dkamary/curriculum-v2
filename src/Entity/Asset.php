<?php

namespace App\Entity;

use App\Entity\Base\CreatedAtEntity;
use App\Entity\Base\DeletedAtEntity;
use App\Entity\Base\UpdatedAtEntity;
use App\Repository\AssetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AssetRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Asset
{
    use CreatedAtEntity;
    use UpdatedAtEntity;
    use DeletedAtEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity=AssetType::class, inversedBy="assets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $assetType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $path;

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

    public function getAssetType(): ?AssetType
    {
        return $this->assetType;
    }

    public function setAssetType(?AssetType $assetType): self
    {
        $this->assetType = $assetType;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }
}
