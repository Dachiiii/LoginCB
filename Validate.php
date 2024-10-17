<?php

class Validate {

	public static function IsValidArguments(array $excepted_arguments, array $post) {
		/*
		make sure we have all excepted arguments from post data.
		email, password, in this case.
		*/
		$arguments = [];
		// var_dump($post);
		// die();
		foreach ($post as $name => $value) {

			if (in_array($name, $excepted_arguments) && !(in_array($name, $arguments)) && !empty($value)) {
				$arguments[$name] = $value;
			}
		}
		return count($arguments) === count($excepted_arguments) ? true : false;
	} 

	public static function GetErrorsForMissingArguments(array $excepted_arguments, array $post) {
		$errors = [];
		foreach ($excepted_arguments as $argument) {
			if (!isset($post[$argument]) || (isset($post[$argument]) && empty($post[$argument]))) {
				$errors[$argument.'_error'] = "Field {$argument} Is Requierd!";
			}
		}
		return $errors;
	}

	public static function ValidateConfirmedPassword(string $password1, string $password2) {
		return ($password1===$password2) ? true : false;
	}

	public static function isValidLength(string $name, string $str, int $min_length = 0, int $max_length = 1024) {
		if (strlen($str) <= $max_length && strlen($str) >= $min_length) {
			return true;
		}
		return [$name, "{$name} Must Be Between {$min_length}-{$max_length}"];

	}

	public static function GetErrorsForInvalidInput(...$args) {
		$errors = [];
		foreach($args as $arg) {
			if (!is_bool($arg)) {
				$errors[$arg[0]."_error"] = $arg[1];;
			} 
		}

		return $errors;
	}
}