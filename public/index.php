<?php

declare(strict_types=1);

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
for ($i = 0; $i < count($teamNames); $i++) {
    $teams[$i] = new \App\Team(name: $teamNames[$i], key: $i+1);
}

$calendarGenerator = new \App\Tourney();
$calendar = $calendarGenerator->generate(
    participants: $teams,
    startCounterFrom: 100,
);

$teamsCount = count($teams);
echo "{$teamsCount} teams <br><br>";

foreach ($calendar as $turn) {
    echo "Turn {$turn->number()}<br>";
    foreach ($turn->games() as $game) {
            echo "{$game->description()}<br>";
    }
    echo "<br>";
}