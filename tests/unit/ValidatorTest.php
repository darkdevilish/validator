<?php


class ValidatorTest extends \Codeception\TestCase\Test {

  function test_has_presence() {
    $value = Validator::has_presence("value");
    $empty_value_with_spaces = Validator::has_presence("    ");

    $this->assertFalse($empty_value_with_spaces);
    $this->assertEquals(true, $value);
  }
}