<?php

abstract class Validator {

	static function has_presence($value) {
		$trim_value = trim($value);
		return isset($trim_value) && $trim_value !== "";
	}

}