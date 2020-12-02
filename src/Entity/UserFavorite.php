<?php

namespace App\Entity;

use App\Entity\Base\CommentEntity;
use App\Repository\UserFavoriteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserFavoriteRepository::class)
 */
class UserFavorite
{
    use CommentEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userFavorites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $favoriteUser;

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

    public function getFavoriteUser(): ?User
    {
        return $this->favoriteUser;
    }

    public function setFavoriteUser(?User $favoriteUser): self
    {
        $this->favoriteUser = $favoriteUser;

        return $this;
    }
}
