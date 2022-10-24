<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$teamsNumber = 6;

// Primo passo: si genera una permutazione pseudocasuale delle
// squadre, per introdurre un po' di nondeterminismo rispetto
// all'ordine naturale.
$teams = [];
for ($i = 0; $i < $teamsNumber; $i++) {
    $teams[$i] = $i;
}

if ($teamsNumber % 2 !== 0) {
    $teams[] = 999;
    $teamsNumber++;
}

shuffle($teams);

// Secondo passo: si sceglie in modo pseudocasuale anche la
// squadra pivot, ossia il punto fisso richiesto dall'algoritmo
// di Berger.
$pivot = rand(1, $teamsNumber);

// La squadra pivot viene posizionata al termine all'array.
// Se il numero di squadre immesso dall'utente è dispari
// si aggiungerà  una squadra fittizia, codificata in modo univoco (es. 99),
// che rappresenta il turno di "Riposo".
// Chi "incontra" tale squadra salta il turno.
// In questo modo le squadre saranno sempre e comunque in numero pari.

// Estraggo la squadra da l'array
$pivotTeam = array_splice($teams, $pivot - 1, 1)[0];
// metto la squadra pivot in coda
$teams[] = $pivotTeam;

// Si noti che qui il valore viene diminuito di una unita', per
// semplificare i riferimenti in tutto il resto del programma.
$teamsNumber--;
$turn = $teamsNumber;

// ($numSquadre-2) >> 1 .. in pratica divide per 2 e arrotonda all'intero per difetto
$shift = \App\Support\CoPrimeNumber::get($teamsNumber);

// Come ulteriore elemento di dinamizzazione, si sceglie anche il
// verso di rotazione in modo pseudocasuale. La sostanziale
// (e non banale) simmetria dei coprimi inferiori ad un valore
// dato garantisce che, se il naturale 1 < k < n è coprimo a n,
// allora lo sarà anche n - k.
$shift = rand(0, 1) ? $teamsNumber - $shift : $shift;

// Implementazione dell'algoritmo "a cerniera".
// La squadra pivot incontra, a rotazione, tutte le altre.
// Questo vincolo viene esteso meccanicamente alle altre coppie.
$firstPick = 0;
$calendar = [];


$calendarGenerator = new \App\Tourney($teams);
$calendar = $calendarGenerator->generate();

$gameNumber = 1;
foreach ($calendar as $index => $turn) {
    echo "Turn {$index}<br>";
    foreach ($turn as $game) {
        echo "[{$gameNumber}]-- {$game[0]}-{$game[1]}<br>";
        $gameNumber++;
    }
}