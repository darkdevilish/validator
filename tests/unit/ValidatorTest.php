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

    $this->assertContains( "Last name can't be blank", Validator::errors() );
  }

  function test_validate_lengths() {
    $fields_with_options = array(
      'name' => array('max' => 3, 'min' => 10), 
      'username' => array('min' => 5),
      'last-name' => array('exact' => 5),
      );
    $values = array(
      'name' => "John", 
      'username' => "john", 
      'last-name' => 'Doe',
      );
    Validator::validate_lengths($fields_with_options, $values);

    $this->assertContains( "Username is too short (5 characters minimum)", Validator::errors() );
    $this->assertContains( "Name is too long (3 characters maximum)", Validator::errors() );
    $this->assertContains( "Last name does not match 5 characters", Validator::errors() );
  }

  function test_validate_has_max_length() {
    $name = "John";
    $this->assertTrue(Validator::has_length($name, array('max' => 10)));
    $this->assertFalse(Validator::has_length($name, array('max' => 3)));
  }

  function test_validate_has_min_length() {
    $name = "John";

    $this->assertTrue(Validator::has_length($name, array('min' => 4)));
    $this->assertFalse(Validator::has_length($name, array('min' => 10)));
  }

  function test_validate_has_exact_length() {
    $name = "John";

    $this->assertTrue(Validator::has_length($name, array('exact' => 4)));
    $this->assertFalse(Validator::has_length($name, array('exact' => 5)));
  }

  function test_has_min_and_max_length() {
    $name = "John";
    $options = array('min' => 4, 'max' => 10);
    $options2 = array('min' => 1, 'max' => 3);

    $this->assertTrue(Validator::has_length($name, $options));
    $this->assertFalse(Validator::has_length($name, $options2));
  }
}