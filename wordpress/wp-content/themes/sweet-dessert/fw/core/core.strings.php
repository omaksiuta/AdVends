<?php
/**
 * Sweet Dessert Framework: strings manipulations
 *
 * @package	sweet_dessert
 * @since	sweet_dessert 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Check multibyte functions
if ( ! defined( 'SWEET_DESSERT_MULTIBYTE' ) ) define( 'SWEET_DESSERT_MULTIBYTE', function_exists('mb_strpos') ? 'UTF-8' : false );

if (!function_exists('sweet_dessert_strlen')) {
	function sweet_dessert_strlen($text) {
		return SWEET_DESSERT_MULTIBYTE ? mb_strlen($text) : strlen($text);
	}
}

if (!function_exists('sweet_dessert_strpos')) {
	function sweet_dessert_strpos($text, $char, $from=0) {
		return SWEET_DESSERT_MULTIBYTE ? mb_strpos($text, $char, $from) : strpos($text, $char, $from);
	}
}

if (!function_exists('sweet_dessert_strrpos')) {
	function sweet_dessert_strrpos($text, $char, $from=0) {
		return SWEET_DESSERT_MULTIBYTE ? mb_strrpos($text, $char, $from) : strrpos($text, $char, $from);
	}
}

if (!function_exists('sweet_dessert_substr')) {
	function sweet_dessert_substr($text, $from, $len=-999999) {
		if ($len==-999999) { 
			if ($from < 0)
				$len = -$from; 
			else
				$len = sweet_dessert_strlen($text)-$from;
		}
		return SWEET_DESSERT_MULTIBYTE ? mb_substr($text, $from, $len) : substr($text, $from, $len);
	}
}

if (!function_exists('sweet_dessert_strtolower')) {
	function sweet_dessert_strtolower($text) {
		return SWEET_DESSERT_MULTIBYTE ? mb_strtolower($text) : strtolower($text);
	}
}

if (!function_exists('sweet_dessert_strtoupper')) {
	function sweet_dessert_strtoupper($text) {
		return SWEET_DESSERT_MULTIBYTE ? mb_strtoupper($text) : strtoupper($text);
	}
}

if (!function_exists('sweet_dessert_strtoproper')) {
	function sweet_dessert_strtoproper($text) { 
		$rez = ''; $last = ' ';
		for ($i=0; $i<sweet_dessert_strlen($text); $i++) {
			$ch = sweet_dessert_substr($text, $i, 1);
			$rez .= sweet_dessert_strpos(' .,:;?!()[]{}+=', $last)!==false ? sweet_dessert_strtoupper($ch) : sweet_dessert_strtolower($ch);
			$last = $ch;
		}
		return $rez;
	}
}

if (!function_exists('sweet_dessert_strrepeat')) {
	function sweet_dessert_strrepeat($str, $n) {
		$rez = '';
		for ($i=0; $i<$n; $i++)
			$rez .= $str;
		return $rez;
	}
}

if (!function_exists('sweet_dessert_strshort')) {
	function sweet_dessert_strshort($str, $maxlength, $add='...') {
		if ($maxlength < 0) 
			return $str;
		if ($maxlength == 0) 
			return '';
		if ($maxlength >= sweet_dessert_strlen($str)) 
			return strip_tags($str);
		$str = sweet_dessert_substr(strip_tags($str), 0, $maxlength - sweet_dessert_strlen($add));
		$ch = sweet_dessert_substr($str, $maxlength - sweet_dessert_strlen($add), 1);
		if ($ch != ' ') {
			for ($i = sweet_dessert_strlen($str) - 1; $i > 0; $i--)
				if (sweet_dessert_substr($str, $i, 1) == ' ') break;
			$str = trim(sweet_dessert_substr($str, 0, $i));
		}
		if (!empty($str) && sweet_dessert_strpos(',.:;-', sweet_dessert_substr($str, -1))!==false) $str = sweet_dessert_substr($str, 0, -1);
		return ($str) . ($add);
	}
}

// Clear string from spaces, line breaks and tags (only around text)
if (!function_exists('sweet_dessert_strclear')) {
	function sweet_dessert_strclear($text, $tags=array()) {
		if (empty($text)) return $text;
		if (!is_array($tags)) {
			if ($tags != '')
				$tags = explode($tags, ',');
			else
				$tags = array();
		}
		$text = trim(chop($text));
		if (is_array($tags) && count($tags) > 0) {
			foreach ($tags as $tag) {
				$open  = '<'.esc_attr($tag);
				$close = '</'.esc_attr($tag).'>';
				if (sweet_dessert_substr($text, 0, sweet_dessert_strlen($open))==$open) {
					$pos = sweet_dessert_strpos($text, '>');
					if ($pos!==false) $text = sweet_dessert_substr($text, $pos+1);
				}
				if (sweet_dessert_substr($text, -sweet_dessert_strlen($close))==$close) $text = sweet_dessert_substr($text, 0, sweet_dessert_strlen($text) - sweet_dessert_strlen($close));
				$text = trim(chop($text));
			}
		}
		return $text;
	}
}

// Return slug for the any title string
if (!function_exists('sweet_dessert_get_slug')) {
	function sweet_dessert_get_slug($title) {
		return sweet_dessert_strtolower(str_replace(array('\\','/','-',' ','.'), '_', $title));
	}
}

// Replace macros in the string
if (!function_exists('sweet_dessert_strmacros')) {
	function sweet_dessert_strmacros($str) {
		return str_replace(array("{{", "}}", "((", "))", "||"), array("<i>", "</i>", "<b>", "</b>", "<br>"), $str);
	}
}

// Unserialize string (try replace \n with \r\n)
if (!function_exists('sweet_dessert_unserialize')) {
	function sweet_dessert_unserialize($str) {
		if ( is_serialized($str) ) {
			try {
				$data = unserialize($str);
			} catch (Exception $e) {
				dcl($e->getMessage());
				$data = false;
			}
			if ($data===false) {
				try {
					$data = unserialize(str_replace("\n", "\r\n", $str));
				} catch (Exception $e) {
					dcl($e->getMessage());
					$data = false;
				}
			}
			return $data;
		} else
			return $str;
	}
}
?>