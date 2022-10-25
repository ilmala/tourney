<?php

declare(strict_types=1);

use Tourney\Support\ParticipantsCollection;
use Tourney\Tourney;

require __DIR__ . '/../vendor/autoload.php';

$teamNames = [
    'BM-01'=>'Bayern Monaco',
    'OM-02'=>'Olimpia Milano',
    'PZ-03'=>'Partizan',
    'VB-04'=>'Virtus Bologna',
    'OL-05'=>'Olympiacos',
    'AE-06'=>'Anadolu Efes',
    'AB-07'=>'Alba Berlino',
    'RM-08'=>'Real Madrid',
    'BR-09'=>'Barcellona',
];

$participants = ParticipantsCollection::makeFromArray($teamNames);

$tourney = new Tourney();
$tournament = $tourney->generate(
    participants: $participants->collection()->toArray(),
    startCounterFrom: 100,
);

echo "{$tournament->participants()->count()} teams - {$tournament->turns()->count()} Turns <br><br>";

foreach ($tournament->turns() as $turn) {
    echo "Turn {$turn->number()}<br>";
    foreach ($turn->games() as $game) {
        echo "{$game->description()}<br>";
    }
    echo "<br>";
}