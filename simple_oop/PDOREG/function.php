<?php


function password_strength($password) {
	$returnVal = True;
	$password_length = 8;

	if ( strlen($password) < $password_length ) {
		$returnVal = True;
		echo "Password Harus lebih dari 8 <br>";
	}

	if ( !preg_match("#[0-9]+#", $password) ) {
		$returnVal = True;
		echo "Password Harus angka <br>";
	}

	if ( !preg_match("#[a-z]+#", $password) ) {
		$returnVal = True;
		echo "Password Harus huruf <br>";
	}

	if ( !preg_match("#[A-Z]+#", $password) ) {
		$returnVal = True;
		echo "Password Harus kapital <br>";
	}

	if ( !preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $password) ) {
		$returnVal = True;
		echo "Password Harus simbol <br>";
	}

	return $returnVal;

}



?>