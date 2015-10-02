<?php


class ValidatorTest extends \Codeception\TestCase\Test {

  function test_has_presence() {
    $value = Validator::has_presence("value");
    $empty_value_with_spaces = Validator::has_presence( trim("    ") );

    $this->assertFalse($empty_value_with_spaces);
    $this->assertEquals(true, $value);
  }

  function test_validates_presences() {
    //$values = array('name' => 'John', 'username' => 'chacala');

  }
}