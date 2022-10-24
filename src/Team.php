<?php

declare(strict_types=1);

namespace App;

class Team
{
    public function __construct(
        protected string $name,
        protected mixed  $key
    )
    {
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return  "{$this->name()} ({$this->key})";
    }
}