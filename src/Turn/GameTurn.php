<?php

declare(strict_types=1);

namespace App\Turn;

use App\Team;

class GameTurn
{
    public function __construct(
        protected int $number,
        protected string|Team $homeTeam,
        protected string|Team $awayTeam,
    )
    {
    }

    public function number(): int
    {
        return $this->number;
    }

    public function homeTeam(): string|Team
    {
        return $this->homeTeam;
    }

    public function awayTeam(): string|Team
    {
        return $this->awayTeam;
    }

    public function description(): string
    {
        return "n°{$this->number()} - {$this->homeTeam()} vs {$this->awayTeam()}";
    }

    public function __toString(): string
    {
        return $this->description();
    }
}