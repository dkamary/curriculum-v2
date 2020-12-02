<?php

namespace App\Entity;

use App\Entity\Base\NameEntity;
use App\Repository\CompanyTypeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyTypeRepository::class)
 */
class CompanyType
{
    use NameEntity;

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
