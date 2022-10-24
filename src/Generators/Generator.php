<?php

namespace App\Generators;

interface Generator
{
    const FAKE_TEAM = -1;

    public function generate(array $participants): ?array;
}