<?php

require '../ChangeMat.php';

class ChangeMatTest extends PHPUnit_Framework_TestCase {

    /**
     * @var MoneyCalculator
     */
    protected $object;

    protected function setUp() {
        $this->object = new MoneyCalculator();
    }

    protected function tearDown() {
        unset($this->object);
    }

    /**
     * @covers ChangeMat::sumWords
     */
    public function testSumWords() {
        $this->assertEquals('dešimt milijonų du', $this->object->sumWords(10000002));
        $this->assertEquals('dvidešimt tūkstančių keturiasdešimt', $this->object->sumWords(20040));
        $this->assertEquals('penkiasdešimt vienas tūkstantis', $this->object->sumWords(51000));
        $this->assertEquals('tūkstantis', $this->object->sumWords(1000));
        $this->assertEquals('du tūkstančiai', $this->object->sumWords(2000));
        $this->assertEquals('dvidešimt vienas', $this->object->sumWords(21));
        $this->assertEquals('šimtas vienuolika', $this->object->sumWords(111));
        $this->assertEquals('du šimtai trylika', $this->object->sumWords(213));
        $this->assertEquals('penki tūkstančiai du', $this->object->sumWords(5002));
        $this->assertEquals('trys tūkstančiai du šimtai keturiasdešimt', $this->object->sumWords(3240));
        $this->assertEquals('dvylika tūkstančių du šimtai keturiasdešimt', $this->object->sumWords(12240));
        $this->assertEquals('tūkstantis penki', $this->object->sumWords(1005));
        $this->assertEquals('šimtas dvidešimt trys tūkstančiai vienas', $this->object->sumWords(123001));
    }
    /**
     * @covers ChangeMat::minNotes
     */
    public function testMinNotes() {
        $this->assertEquals(4, $this->object->minNotes(135, [100, 50, 20, 10, 5, 1]));
        // test note input order
        $this->assertEquals(4, $this->object->minNotes(135, [10, 5, 1, 100, 50, 20]));
        $this->assertEquals(1, $this->object->minNotes(100, [100, 50, 20, 10, 5, 1]));
        
        // large amount simple case
        $this->assertEquals(10000000, $this->object->minNotes(1000000000, [100, 50, 20, 10, 5, 1]));
        // performance
        $this->assertEquals(11, $this->object->minNotes(1005, [100, 50, 20, 10, 5, 1]));
        // primary
        $this->assertEquals(0, $this->object->minNotes(13, [100, 50, 20, 10, 5]));
        // it's not always correct to include largest bill
        $this->assertEquals(2, $this->object->minNotes(120, [100, 60, 10]));
        $this->assertEquals(2, $this->object->minNotes(110, [100, 60, 55]));
        $this->assertEquals(2, $this->object->minNotes(102, [100, 51, 60, 55, 1]));
    }

}
