<?php


class ValidatorTest extends \Codeception\TestCase\Test {

  function test_has_presence() {
    $value = Validator::has_presence("value");
    $empty_value_with_spaces = Validator::has_presence( trim("    ") );

    $this->assertFalse($empty_value_with_spaces);
    $this->assertEquals(true, $value);
  }

  function test_validate_presences() {
    $values = array('name' => 'John', 'username' => 'chacala');
    $empty_values = array('name' => '     ', 'username' => '    ');
    $empty_value = array('last-name' => '', 'username' => 'whatever');
    Validator::validate_presences($values);

    $this->assertEmpty( Validator::errors() );
    
    Validator::validate_presences($empty_values);

    $this->assertNotEmpty( Validator::errors() );

    Validator::validate_presences($empty_value);

    $this->assertEquals( "Last name can't be blank", Validator::errors()["last-name"] );
  }

  function test_has_max_length() {
    $value = Validator::has_max_length("Some random", 10);

    $this->assertEquals(true, $value);
  }
}