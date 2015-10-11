<?php

abstract class Validator {

  private static $errors = array();

  static function errors() {
    if(!empty(self::$errors)) {
      return self::$errors;
    }
    return false;
  }

  static function validate_presences($required_fields) {
    foreach($required_fields as $field=>$value) {
      $value = trim($value);
      if (!self::has_presence($value)) {
        self::$errors[$field] = self::fieldname_as_text($field) . " can't be blank";
      }
    }
  }

  static function validate_email($required_field) {
    foreach($required_field as $field => $email) {
      $email = trim($email);
      if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        $msg = " address ({$email}) is invalid";
        self::$errors[$field] = self::fieldname_as_text($field) . $msg;
      }
    }
  }

  static function validate_lengths($fields_with_options, $values) {
    // Expects an assoc. array
    foreach($fields_with_options as $field => $option) {
      $value = trim($values[$field]);
      if (!self::has_length($value, $option)) {
        self::$errors[$field] = self::fieldname_as_text($field).self::length_error_msg($option);
      }
    }
  }

  private static function has_length($value, $options=array()) {
    if(isset($options['max']) && (strlen($value) > (int)$options['max'])) {
      return false;
    }
    if(isset($options['min']) && (strlen($value) < (int)$options['min'])) {
      return false;
    }
    if(isset($options['exact']) && (strlen($value) != (int)$options['exact'])) {
      return false;
    }
    return true;
  }

  private static function length_error_msg($options) {
    if(isset( $options['max'] )) {
      return " is too long ({$options['max']} characters maximum)";
    }
    if(isset( $options['min'] )) {
      return " is too short ({$options['min']} characters minimum)";
    }
    if(isset( $options['exact'] )) {
      return " does not match {$options['exact']} characters";
    }
  }

  private static function fieldname_as_text($fieldname) {
    $fieldname = str_replace("-", " ", $fieldname);
    $fieldname = ucfirst($fieldname);
    return $fieldname;
  }

  private static function has_presence($value) {
    return isset($value) && $value !== "";
  }

}
