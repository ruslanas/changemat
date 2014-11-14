<?php

/**
 * @author Ruslanas Balčiūnas <http://ruslanas.com>
 */
class MoneyCalculator {

    public $digits = [
        1 => 'vienas',
        2 => 'du',
        3 => 'trys',
        4 => 'keturi',
        5 => 'penki',
        6 => 'šeši',
        7 => 'septyni',
        8 => 'aštuoni',
        9 => 'devyni',
        10 => 'dešimt',
        11 => 'vienuolika',
        12 => 'dvylika',
        13 => 'trylika',
        14 => 'keturiolika',
        15 => 'penkiolika',
        16 => 'šešiolika',
        17 => 'septyniolika',
        18 => 'aštuoniolika',
        19 => 'devyniolika',
        20 => 'dvidešimt',
        30 => 'trisdešimt',
        40 => 'keturiasdešimt',
        50 => 'penkiasdešimt',
        60 => 'šešiasdešimt',
        70 => 'septyniasdešimt',
        80 => 'aštuoniasdešimt',
        90 => 'devyniasdešimt',
        100 => 'šimtas',
        1000 => 'tūkstantis',
        1000000 => 'milijonas'
    ];

    public function sumWords($sum, $a = []) {
        $digits = $this->digits;

        $lt = floor($sum);
        $words = '';

        $t = floor($lt % 100000000 / 1000000);
        if ($t > 0) {
            $words .= ' '.$this->sumWords($t, ['milijonas', 'milijonai', 'milijonų']);
        }
        
        $t = floor($lt % 1000000 / 1000);
        if ($t > 0) {
            $words .= ' '.$this->sumWords($t, ['tūkstantis', 'tūkstančiai', 'tūkstančių']);
        }

        $h = floor(($lt % 1000) / 100);
        if ($h > 0) {
            $words .= ' '.$this->sumWords($h, ['šimtas', 'šimtai', 'šimtų']);
        }

        $dd = $lt % 100;

        if (!empty($digits[$dd])) {
            if ($dd != 1 || empty($a)) {
                $words .= ' '.$digits[$dd];
            }
        } elseif ($dd != 0) {
            $words .= ' '.$digits[floor($dd / 10) * 10] . ' ' . $digits[$dd % 10];
        }

        if (!empty($a)) {
            $words .= ' ';
            if ($dd % 10 == 1) {
                $words .= $a[0];
            } elseif ($dd > 9 && $dd < 21) {
                $words .= $a[2];
            } else {
                $words .= $a[1];
            }
        }
        return ltrim($words);
    }

    public function minNotes($amount, $notes = []) {
        rsort($notes); // sort highest to lowest
        // ran out of notes
        if (sizeof($notes) < 1) {
            return 0;
        }

        // multiple of largest bill
        if ($amount % $notes[0] == 0) {
            return $amount / $notes[0];
        } elseif (sizeof($notes) == 1) {
            return 0;
        }

        // exclude largest bill
        if ($amount < $notes[0]) {
            return $this->minNotes($amount, array_slice($notes, 1));
        }

        $minTotal = 0;
        $count = floor($amount / $notes[0]);

        for ($i = 0; $i <= $count; $i++) {

            // break if no better solution possible
            if ($minTotal && ($i > $minTotal - 2)) {
                break;
            }
            $remainder = $amount - $i * $notes[0];

            // remove largest bill from array in next call
            $res = $this->minNotes($remainder, array_slice($notes, 1));

            if ($res !== 0) {
                $minTotal = $minTotal ? min($minTotal, $i + $res) : $i + $res;
            }
        }

        return $minTotal;
    }

}
