<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

trait LevelEntity
{
    /**
     * Score
     *
     * @var int
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    private $score = 0;

    /**
     * Rank
     *
     * @var int
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    private $rank = 0;

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }
}
