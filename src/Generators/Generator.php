<?php

declare(strict_types=1);

namespace Tourney\Generators;

interface Generator
{
    const FAKE_TEAM = -1;

    public function generate(array $participants): ?array;
}