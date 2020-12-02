<?php

namespace App\Entity;

use App\Repository\UserStatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserStatRepository::class)
 * @ORM\Table(
 *      name="user_stat",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="U_user_stat_owner", columns={"owner_id"})
 *      }
 * )
 */
class UserStat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userStat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $viewed;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $searched;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastConnection;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getViewed(): ?int
    {
        return $this->viewed;
    }

    public function setViewed(int $viewed): self
    {
        $this->viewed = $viewed;

        return $this;
    }

    public function getSearched(): ?int
    {
        return $this->searched;
    }

    public function setSearched(int $searched): self
    {
        $this->searched = $searched;

        return $this;
    }

    public function getLastConnection(): ?\DateTimeInterface
    {
        return $this->lastConnection;
    }

    public function setLastConnection(?\DateTimeInterface $lastConnection): self
    {
        $this->lastConnection = $lastConnection;

        return $this;
    }
}
