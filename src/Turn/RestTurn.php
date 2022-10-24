<?php

declare(strict_types=1);

namespace App\Turn;

use App\Team;

class RestTurn
{
    public function __construct(protected string|Team $restTeam)
    {
    }

    /**
     * @return Team
     */
    public function restTeam(): string|Team
    {
        return $this->restTeam;
    }

    public function description(): string
    {
        return "Rest for {$this->restTeam()}";
    }

    public function __toString(): string
    {
        return $this->description();
    }
}