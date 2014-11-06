<?php

require '../ChangeMat.php';

class ChangeMatTest extends PHPUnit_Framework_TestCase {

    /**
     * @var ChangeMat
     */
    protected $object;

    protected function setUp() {
        $this->object = new ChangeMat();
    }

    protected function tearDown() {
        unset($this->object);
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
