<?php

namespace Tourney\Models;

class Tournament
{
    public function __construct(
        protected array $turns
    )
    {
    }

    public function turns(): array
    {
        return $this->turns;
    }
}