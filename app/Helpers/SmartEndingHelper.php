<?php

function smart_ending($number, $forms, $base = '') {
	$rest = $number % 10;
	$number = (int) substr($number, -2, 2);
	if ($rest === 1 && $number != 11)
		return $base.$forms[0];
	if (in_array($rest, [2, 3, 4]) && !in_array($number, [12, 13, 14]))
		return $base.$forms[1];
	return $base.$forms[2];
}
