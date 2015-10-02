<?php

abstract class Validator {

	private static $errors = array();

	static function errors() {
		return self::$errors;
	}

	static function has_presence($value) {
		return isset($value) && $value !== "";
	}

	static function validate_presences($required_fields) {
		foreach($required_fields as $field=>$value) {
    	$value = trim($value);
  		if (!self::has_presence($value)) {
  			self::$errors[$field] = self::fieldname_as_text($field) . " can't be blank";
  		}
  	}
	}

	static function has_max_length($value, $max) {
		return strlen($value) <= $max;
	}

	private static function fieldname_as_text($fieldname) {
		$fieldname = str_replace("-", " ", $fieldname);
  	$fieldname = ucfirst($fieldname);
  	return $fieldname;
	}

}