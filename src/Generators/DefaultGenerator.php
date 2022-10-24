<?php

declare(strict_types=1);

namespace App\Generators;

use App\Support\CoPrimeNumber;

class DefaultGenerator implements Generator
{
    public function generate(array $participants): ?array
    {
        $participants = $this->prepareParticipants($participants);

        $participantIndexNumber = count($participants) - 1;

        $shift = $this->getRandomShift($participantIndexNumber);

        $turnNumber = $participantIndexNumber;
        $firstPick = 0;
        $turns = [];
        for ($i = 0; $i < $turnNumber; $i++) {
            $isEvenTurn = $i % 2;

            if ($isEvenTurn) {
                $turns[$i + 1][] = [$participants[$participantIndexNumber], $participants[$firstPick]];
                $turns[$i + 1 + $participantIndexNumber][] = [$participants[$firstPick], $participants[$participantIndexNumber]];
            } else {
                $turns[$i + 1 + $participantIndexNumber][] = [$participants[$participantIndexNumber], $participants[$firstPick]];
                $turns[$i + 1][] = [$participants[$firstPick], $participants[$participantIndexNumber]];
            }

            $firstPickIndex = ($firstPick + 1) % $participantIndexNumber;
            for ($offset = $participantIndexNumber - 2; $offset > 0; $offset -= 2) {
                $secondPickIndex = ($firstPickIndex + $offset) % $participantIndexNumber;

                if ($isEvenTurn) {
                    $turns[$i + 1][] = [$participants[$firstPickIndex], $participants[$secondPickIndex]];
                    $turns[$i + 1 + $participantIndexNumber][] = [$participants[$secondPickIndex], $participants[$firstPickIndex]];
                } else {
                    $turns[$i + 1 + $participantIndexNumber][] = [$participants[$firstPickIndex], $participants[$secondPickIndex]];
                    $turns[$i + 1][] = [$participants[$secondPickIndex], $participants[$firstPickIndex]];
                }
                $firstPickIndex = ($firstPickIndex + 1) % $participantIndexNumber;
            }

            $firstPick = ($firstPick + $shift) % $participantIndexNumber;
        }

        ksort($turns);

        return $turns;
    }

    protected function getRandomShift(int $participantCount): int
    {
        $shift = CoPrimeNumber::get($participantCount);
        return rand(0, 1) ? $participantCount - $shift : $shift;
    }

    protected function prepareParticipants(array $participants): array
    {
        $participantCount = count($participants);

        if ($participantCount % 2 !== 0) {
            // if teams are odd add a fake team to simulate rest turn
            $participants[] = self::FAKE_TEAM;
        }

        shuffle($participants);

        return $this->movePivotTeamToEndOfArray($participants, $participantCount);
    }

    protected function movePivotTeamToEndOfArray(array $participants, int $participantCount): array
    {
        $pivot = rand(1, $participantCount);
        $pivotTeam = array_splice($participants, $pivot - 1, 1)[0];
        $participants[] = $pivotTeam;

        return $participants;
    }
}