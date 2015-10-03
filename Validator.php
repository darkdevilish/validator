<?php

abstract class Validator {

	private static $errors = array();

	static function errors() {
		return self::$errors;
	}

	static function validate_presences($required_fields) {
		foreach($required_fields as $field=>$value) {
    	$value = trim($value);
  		if (!self::has_presence($value)) {
  			self::$errors[$field] = self::fieldname_as_text($field) . " can't be blank";
  		}
  	}
	}

	static function validate_max_lengths($fields_with_max_lengths, $values) {
		// Expects an assoc. array
		foreach($fields_with_max_lengths as $field => $max) {
			$value = trim($values[$field]);
		  if (!self::has_max_length($value, $max)) {
		    self::$errors[$field] = self::fieldname_as_text($field) . " is too long";
		  }
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

	private static function has_max_length($value, $max) {
		return strlen($value) <= $max;
	}

}