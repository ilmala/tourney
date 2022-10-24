<?php

namespace App;

class Team
{
    public function __construct(
        protected int $number,
        protected string $name
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}