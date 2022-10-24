<?php

namespace App\Turn;

use App\Team;

class GameTurn
{
    public function __construct(
        protected int $number,
        protected Team $homeTeam,
        protected Team $awayTeam,
    )
    {
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return Team
     */
    public function getHomeTeam(): Team
    {
        return $this->homeTeam;
    }

    /**
     * @return Team
     */
    public function getAwayTeam(): Team
    {
        return $this->awayTeam;
    }
}