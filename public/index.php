<?php

declare(strict_types=1);

use Tourney\Tourney;

require __DIR__ . '/../vendor/autoload.php';

$teamNames = [
    'Bayern Monaco',
    'Olimpia Milano',
    'Partizan',
    'Virtus Bologna',
    'Olympiacos',
    'Anadolu Efes',
    'Alba Berlino',
    'Real Madrid',
    'Barcellona',
];

$teams = [];
foreach ($teamNames as $index=> $teamName) {
    $teams[$index] = new \Tourney\Models\Team(
        name: $teamName,
        key: $index + 1
    );
}

$tourney = new Tourney();
$tournament = $tourney->generate(
    participants: $teams,
//startCounterFrom: 100,
);

$teamsCount = count($teams);
echo "{$teamsCount} teams <br><br>";

foreach ($tournament->turns() as $turn) {
    echo "Turn {$turn->number()}<br>";
    foreach ($turn->games() as $game) {
        echo "{$game->description()}<br>";
    }
    echo "<br>";
}