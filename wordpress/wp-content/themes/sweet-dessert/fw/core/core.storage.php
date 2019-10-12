<?php
/**
 * Sweet Dessert Framework: theme variables storage
 *
 * @package	sweet_dessert
 * @since	sweet_dessert 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('sweet_dessert_storage_get')) {
	function sweet_dessert_storage_get($var_name, $default='') {
		global $SWEET_DESSERT_STORAGE;
		return isset($SWEET_DESSERT_STORAGE[$var_name]) ? $SWEET_DESSERT_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('sweet_dessert_storage_set')) {
	function sweet_dessert_storage_set($var_name, $value) {
		global $SWEET_DESSERT_STORAGE;
		$SWEET_DESSERT_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('sweet_dessert_storage_empty')) {
	function sweet_dessert_storage_empty($var_name, $key='', $key2='') {
		global $SWEET_DESSERT_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($SWEET_DESSERT_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($SWEET_DESSERT_STORAGE[$var_name][$key]);
		else
			return empty($SWEET_DESSERT_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('sweet_dessert_storage_isset')) {
	function sweet_dessert_storage_isset($var_name, $key='', $key2='') {
		global $SWEET_DESSERT_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($SWEET_DESSERT_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($SWEET_DESSERT_STORAGE[$var_name][$key]);
		else
			return isset($SWEET_DESSERT_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('sweet_dessert_storage_inc')) {
	function sweet_dessert_storage_inc($var_name, $value=1) {
		global $SWEET_DESSERT_STORAGE;
		if (empty($SWEET_DESSERT_STORAGE[$var_name])) $SWEET_DESSERT_STORAGE[$var_name] = 0;
		$SWEET_DESSERT_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('sweet_dessert_storage_concat')) {
	function sweet_dessert_storage_concat($var_name, $value) {
		global $SWEET_DESSERT_STORAGE;
		if (empty($SWEET_DESSERT_STORAGE[$var_name])) $SWEET_DESSERT_STORAGE[$var_name] = '';
		$SWEET_DESSERT_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('sweet_dessert_storage_get_array')) {
	function sweet_dessert_storage_get_array($var_name, $key, $key2='', $default='') {
		global $SWEET_DESSERT_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($SWEET_DESSERT_STORAGE[$var_name][$key]) ? $SWEET_DESSERT_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($SWEET_DESSERT_STORAGE[$var_name][$key][$key2]) ? $SWEET_DESSERT_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('sweet_dessert_storage_set_array')) {
	function sweet_dessert_storage_set_array($var_name, $key, $value) {
		global $SWEET_DESSERT_STORAGE;
		if (!isset($SWEET_DESSERT_STORAGE[$var_name])) $SWEET_DESSERT_STORAGE[$var_name] = array();
		if ($key==='')
			$SWEET_DESSERT_STORAGE[$var_name][] = $value;
		else
			$SWEET_DESSERT_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('sweet_dessert_storage_set_array2')) {
	function sweet_dessert_storage_set_array2($var_name, $key, $key2, $value) {
		global $SWEET_DESSERT_STORAGE;
		if (!isset($SWEET_DESSERT_STORAGE[$var_name])) $SWEET_DESSERT_STORAGE[$var_name] = array();
		if (!isset($SWEET_DESSERT_STORAGE[$var_name][$key])) $SWEET_DESSERT_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$SWEET_DESSERT_STORAGE[$var_name][$key][] = $value;
		else
			$SWEET_DESSERT_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Add array element after the key
if (!function_exists('sweet_dessert_storage_set_array_after')) {
	function sweet_dessert_storage_set_array_after($var_name, $after, $key, $value='') {
		global $SWEET_DESSERT_STORAGE;
		if (!isset($SWEET_DESSERT_STORAGE[$var_name])) $SWEET_DESSERT_STORAGE[$var_name] = array();
		if (is_array($key))
			sweet_dessert_array_insert_after($SWEET_DESSERT_STORAGE[$var_name], $after, $key);
		else
			sweet_dessert_array_insert_after($SWEET_DESSERT_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('sweet_dessert_storage_set_array_before')) {
	function sweet_dessert_storage_set_array_before($var_name, $before, $key, $value='') {
		global $SWEET_DESSERT_STORAGE;
		if (!isset($SWEET_DESSERT_STORAGE[$var_name])) $SWEET_DESSERT_STORAGE[$var_name] = array();
		if (is_array($key))
			sweet_dessert_array_insert_before($SWEET_DESSERT_STORAGE[$var_name], $before, $key);
		else
			sweet_dessert_array_insert_before($SWEET_DESSERT_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('sweet_dessert_storage_push_array')) {
	function sweet_dessert_storage_push_array($var_name, $key, $value) {
		global $SWEET_DESSERT_STORAGE;
		if (!isset($SWEET_DESSERT_STORAGE[$var_name])) $SWEET_DESSERT_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($SWEET_DESSERT_STORAGE[$var_name], $value);
		else {
			if (!isset($SWEET_DESSERT_STORAGE[$var_name][$key])) $SWEET_DESSERT_STORAGE[$var_name][$key] = array();
			array_push($SWEET_DESSERT_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('sweet_dessert_storage_pop_array')) {
	function sweet_dessert_storage_pop_array($var_name, $key='', $defa='') {
		global $SWEET_DESSERT_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($SWEET_DESSERT_STORAGE[$var_name]) && is_array($SWEET_DESSERT_STORAGE[$var_name]) && count($SWEET_DESSERT_STORAGE[$var_name]) > 0) 
				$rez = array_pop($SWEET_DESSERT_STORAGE[$var_name]);
		} else {
			if (isset($SWEET_DESSERT_STORAGE[$var_name][$key]) && is_array($SWEET_DESSERT_STORAGE[$var_name][$key]) && count($SWEET_DESSERT_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($SWEET_DESSERT_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('sweet_dessert_storage_inc_array')) {
	function sweet_dessert_storage_inc_array($var_name, $key, $value=1) {
		global $SWEET_DESSERT_STORAGE;
		if (!isset($SWEET_DESSERT_STORAGE[$var_name])) $SWEET_DESSERT_STORAGE[$var_name] = array();
		if (empty($SWEET_DESSERT_STORAGE[$var_name][$key])) $SWEET_DESSERT_STORAGE[$var_name][$key] = 0;
		$SWEET_DESSERT_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('sweet_dessert_storage_concat_array')) {
	function sweet_dessert_storage_concat_array($var_name, $key, $value) {
		global $SWEET_DESSERT_STORAGE;
		if (!isset($SWEET_DESSERT_STORAGE[$var_name])) $SWEET_DESSERT_STORAGE[$var_name] = array();
		if (empty($SWEET_DESSERT_STORAGE[$var_name][$key])) $SWEET_DESSERT_STORAGE[$var_name][$key] = '';
		$SWEET_DESSERT_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('sweet_dessert_storage_call_obj_method')) {
	function sweet_dessert_storage_call_obj_method($var_name, $method, $param=null) {
		global $SWEET_DESSERT_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($SWEET_DESSERT_STORAGE[$var_name]) ? $SWEET_DESSERT_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($SWEET_DESSERT_STORAGE[$var_name]) ? $SWEET_DESSERT_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('sweet_dessert_storage_get_obj_property')) {
	function sweet_dessert_storage_get_obj_property($var_name, $prop, $default='') {
		global $SWEET_DESSERT_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($SWEET_DESSERT_STORAGE[$var_name]->$prop) ? $SWEET_DESSERT_STORAGE[$var_name]->$prop : $default;
	}
}
?>