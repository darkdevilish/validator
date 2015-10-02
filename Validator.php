<?php

abstract class Validator {

	static function has_presence($value) {
		return isset($value) && $value !== "";
	}

}