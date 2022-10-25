<?php

namespace Tourney\Models;

use Illuminate\Support\Collection;

class Tournament
{
    public function __construct(
        protected array $participants,
        protected array $turns
    )
    {
    }

    public function participants(): Collection
    {
        return collect($this->participants);
    }

    public function turns(): Collection
    {
        return collect($this->turns);
    }

    public function toArray(): array
    {
        return [
            'participants' => $this->participants()->toArray(),
            'turns' => $this->turns()->toArray(),
        ];
    }
}