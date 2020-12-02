<?php

namespace App\Entity;

use App\Entity\Base\ActiveEntity;
use App\Entity\Base\DescriptionEntity;
use App\Entity\Base\NameEntity;
use App\Repository\UserTypeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserTypeRepository::class)
 */
class UserType
{
    const ADMIN = 1;
    const CANDIDAT = 2;
    const COMPANY = 3;

    use NameEntity;
    use DescriptionEntity;
    use ActiveEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
