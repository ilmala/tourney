<?php

declare(strict_types=1);

namespace App\Turn;

use App\Team;

class RestTurn
{
    public function __construct(protected Team $restTeam)
    {
    }

    /**
     * @return Team
     */
    public function getRestTeam(): Team
    {
        return $this->restTeam;
    }
}