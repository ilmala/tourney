<?php

namespace Tourney\Support;

use Illuminate\Support\Collection;
use Tourney\Models\Team;

class ParticipantsCollection
{
    public function __construct(
        protected array|Collection $participants
    )
    {
    }

    public static function makeFromArray(array $values): static
    {
        $participants = collect($values)
            ->map(function ($team, $key) {
                return new Team($team, $key);
            });

        return new static($participants->values());
    }

    public function collection(): Collection
    {
        return is_array($this->participants)
            ? collect($this->participants)
            : $this->participants;
    }
}