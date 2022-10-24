# Tourney
A simple random tournament generator

Features:
- From 3 to 30 teams tournament
- Even and Odd team number with rest turn

How to use:

``` php
use Tourney\Tourney;

$teamNames = [
    'Bayern Monaco',
    'Olimpia Milano',
    'Partizan',
    'Virtus Bologna'
];

$tournament = (new Tourney())->generate(
    participants: $teams,
);
```

Print out results:
```php
// Basic Loop 
foreach ($tournament->turns() as $turn) {
    echo "Turn {$turn->number()}<br>";
    foreach ($turn->games() as $game) {
        echo "{$game->description()}<br>";
    }
    echo "<br>";
}
```

Team can be an instance of `Tourney\Models\Team` class:
```php
$team = new \Tourney\Models\Team(
    name: 'Olimpia Milano',
    key: 'OM-01',
);

$team->name(); // The name of the Team
$team->key(); // Maybe a reference key of your application team model
```