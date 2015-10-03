<?php


class ValidatorTest extends \Codeception\TestCase\Test {

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

  function test_validate_max_lengths() {
    $fields_with_max_lengths = array('name' => '10', 'username' => '5');
    $values = array('name' => "John", 'username' => "userjohn");
    Validator::validate_max_lengths($fields_with_max_lengths, $values);

    $this->assertEquals( "Username is too long", Validator::errors()['username'] );
  }
}