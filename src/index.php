<?php
header('Content-Type: text/plain;charset=utf-8');

require_once 'Lib/MoneyCalculator.php';

$notes = [100, 50, 20, 10, 5, 1];
$amounts = [102, 135, 160, 120, 136, 111, 105, 23, 17];

$changemat = new MoneyCalculator($notes);

print_r($notes);

foreach ($amounts as $amount) {
    echo "{$amount}->{$changemat->minNotes($amount, $notes)}\n";
}

for($i=0;$i<10;$i++) {
    $sum = rand();
    echo $sum . '->' . $changemat->sumWords($sum)."\n";
}