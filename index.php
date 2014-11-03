<?php
header('Content-Type: text/plain');

require 'ChangeMat.php';

$notes = [100, 50, 20, 10, 5, 1];
$amounts = [102, 135, 160, 120, 136, 111, 105, 23, 17];

$changemat = new ChangeMat($notes);

print_r($notes);

foreach ($amounts as $amount) {
    echo "{$amount}->{$changemat->minNotes($amount, $notes)}\n";
}
