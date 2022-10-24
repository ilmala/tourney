<?php

declare(strict_types=1);

namespace Tourney\Models;

class Team
{
    public function __construct(
        protected string $name,
        protected mixed  $key
    )
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function key(): mixed
    {
        return $this->key;
    }

    public function __toString(): string
    {
        return  "{$this->name()} ({$this->key})";
    }
}