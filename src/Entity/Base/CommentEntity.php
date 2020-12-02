<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

trait CommentEntity
{
    /**
     *
     * @var string $comment
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $comment;

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return self
     */
    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
