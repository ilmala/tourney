<?php

declare(strict_types=1);

namespace Tourney;

use Tourney\Generators\DefaultGenerator;
use Tourney\Generators\Generator;
use Tourney\Models\Tournament;
use Tourney\Models\Turn;
use Tourney\Turn\GameTurn;
use Tourney\Turn\RestTurn;

class Tourney
{
    protected Generator $generator;

    public function __construct()
    {
        $this->generator = new DefaultGenerator();
    }

    public function generate(array $participants, int $startCounterFrom = 1): Tournament
    {
        if (count($participants) < 3 || count($participants) > 30) {
            throw new \InvalidArgumentException("Participants must be between 3 and 30");
        }

        $tours = $this->generator->generate(
            participants: $participants,
        );

        $gameCounter = $startCounterFrom;

        foreach ($tours as $index => $turn) {
            $turnModel = new Turn($index);

            foreach ($turn as $gameIndex => $game) {
                if ($this->isRestingTurn($game)) {
                    $turnGame = $this->addRestTurn($game);
                } else {
                    $turnGame = $this->addGameTurn($game, $gameCounter);
                    $gameCounter++;
                }

                $turnModel->addGame($turnGame, $gameIndex + 1);
            }

            $tours[$index] = $turnModel;
        }

        return new Tournament(turns: $tours);
    }

    protected function isFakeParticipant($participant): bool
    {
        return $participant === Generator::FAKE_TEAM;
    }

    protected function isRestingTurn($game): bool
    {
        return $this->isFakeParticipant($game[0]) || $this->isFakeParticipant($game[1]);
    }

    protected function addRestTurn(mixed $game): RestTurn
    {
        return new RestTurn(
            restTeam: $this->isFakeParticipant($game[0]) ? $game[1] : $game[0],
        );
    }

    protected function addGameTurn(mixed $game, int $gameCounter): GameTurn
    {
        return new GameTurn(
            number: $gameCounter,
            homeTeam: $game[0],
            awayTeam: $game[1],
        );
    }

}