<?php
/**
 * @author Ruslanas Balčiūnas <http://ruslanas.com>
 */
class ChangeMat {

    public function minNotes($amount, $notes = []) {
        rsort($notes); // sort highest to lowest

        // ran out of notes
        if (sizeof($notes) < 1) {
            return 0;
        }

        // multiple of largest bill
        if ($amount % $notes[0] == 0) {
            return $amount / $notes[0];
        }

        // exclude largest bill
        if ($amount < $notes[0]) {
            return $this->minNotes($amount, array_slice($notes, 1));
        }

        $minTotal = 0;
        $count = floor($amount / $notes[0]);
        
        for ($i = $count; $i >= 0; $i--) {
            
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
