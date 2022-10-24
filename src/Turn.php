<?php

declare(strict_types=1);

namespace App;

class Turn
{
    protected array $games;

    public function __construct(protected int $number)
    {
    }

    public function number(): int
    {
        return $this->number;
    }

    public function addGame($game, ?int $index = null): void
    {
        is_null($index) ? $this->games[] = $game: $this->games[$index] = $game;
    }

    public function games(): array
    {
        return $this->games;
    }
}