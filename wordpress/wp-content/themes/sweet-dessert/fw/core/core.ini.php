<?php
/**
 * Sweet Dessert Framework: ini-files manipulations
 *
 * @package	sweet_dessert
 * @since	sweet_dessert 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


//  Get value by name from .ini-file
if (!function_exists('sweet_dessert_ini_get_value')) {
	function sweet_dessert_ini_get_value($file, $name, $defa='') {
		if (!is_array($file)) {
			if (file_exists($file)) {
				$file = sweet_dessert_fga($file);
			} else
				return $defa;
		}
		$name = sweet_dessert_strtolower($name);
		$rez = $defa;
		for ($i=0; $i<count($file); $i++) {
			$file[$i] = trim($file[$i]);
			if (($pos = sweet_dessert_strpos($file[$i], ';'))!==false)
				$file[$i] = trim(sweet_dessert_substr($file[$i], 0, $pos));
			$parts = explode('=', $file[$i]);
			if (count($parts)!=2) continue;
			if (sweet_dessert_strtolower(trim(chop($parts[0])))==$name) {
				$rez = trim(chop($parts[1]));
				if (sweet_dessert_substr($rez, 0, 1)=='"')
					$rez = sweet_dessert_substr($rez, 1, sweet_dessert_strlen($rez)-2);
				else
					$rez *= 1;
				break;
			}
		}
		return $rez;
	}
}

//  Retrieve all values from .ini-file as assoc array
if (!function_exists('sweet_dessert_ini_get_values')) {
	function sweet_dessert_ini_get_values($file) {
		$rez = array();
		if (!is_array($file)) {
			if (file_exists($file)) {
				$file = sweet_dessert_fga($file);
			} else
				return $rez;
		}
		for ($i=0; $i<count($file); $i++) {
			$file[$i] = trim(chop($file[$i]));
			if (($pos = sweet_dessert_strpos($file[$i], ';'))!==false)
				$file[$i] = trim(sweet_dessert_substr($file[$i], 0, $pos));
			$parts = explode('=', $file[$i]);
			if (count($parts)!=2) continue;
			$key = trim(chop($parts[0]));
			$rez[$key] = trim($parts[1]);
			if (sweet_dessert_substr($rez[$key], 0, 1)=='"')
				$rez[$key] = sweet_dessert_substr($rez[$key], 1, sweet_dessert_strlen($rez[$key])-2);
			else
				$rez[$key] *= 1;
		}
		return $rez;
	}
}
?>