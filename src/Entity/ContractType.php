<?php

namespace App\Entity;

use App\Entity\Base\ActiveEntity;
use App\Entity\Base\NameEntity;
use App\Repository\ContractTypeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContractTypeRepository::class)
 */
class ContractType
{
    use NameEntity;
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
