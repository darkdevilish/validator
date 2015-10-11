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

  function test_validate_email() {
    $email = array('email' => "some_email");
    Validator::validate_email($email);

    $this->assertEquals("Email address (some_email) is invalid", Validator::errors()['email']);
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
}
