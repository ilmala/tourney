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
    $teams[$i] = new \App\Team($i+1, $teamNames[$i]);
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
        if($game instanceof \App\Turn\RestTurn){
            echo "[] - Rest {$game->getRestTeam()->getName()}<br>";
        }else{
            echo "[{$game->getNumber()}] - {$game->getHomeTeam()->getName()} vs {$game->getAwayTeam()->getName()}<br>";
        }
    }
    echo "<br>";
}