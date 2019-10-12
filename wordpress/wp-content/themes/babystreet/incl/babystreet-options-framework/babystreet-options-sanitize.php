<?php

/* Text */

add_filter('babystreet_sanitize_text', 'sanitize_text_field');

/* Sidebars */

add_filter('babystreet_sanitize_sidebar', 'sanitize_text_field');

/* Textarea */

function babystreet_sanitize_textarea($input) {
	global $allowedposttags;
	$output = wp_kses($input, $allowedposttags);
	return $output;
}

add_filter('babystreet_sanitize_textarea', 'babystreet_sanitize_textarea');

/* Select */

add_filter('babystreet_sanitize_select', 'babystreet_sanitize_enum', 10, 2);

/* Radio */

add_filter('babystreet_sanitize_radio', 'babystreet_sanitize_enum', 10, 2);

/* Images */

add_filter('babystreet_sanitize_images', 'babystreet_sanitize_enum', 10, 2);

/* Checkbox */

function babystreet_sanitize_checkbox($input) {
	if ($input) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}

add_filter('babystreet_sanitize_checkbox', 'babystreet_sanitize_checkbox');

/* Multicheck */

function babystreet_sanitize_multicheck($input, $option) {
	$output = array();
	if (is_array($input)) {
		foreach ($option['options'] as $key => $value) {
			$output[$key] = "0";
		}
		foreach ($input as $key => $value) {
			if (array_key_exists($key, $option['options']) && $value) {
				$output[$key] = "1";
			}
		}
	}
	return $output;
}

add_filter('babystreet_sanitize_multicheck', 'babystreet_sanitize_multicheck', 10, 2);

/* Color Picker */

add_filter('babystreet_sanitize_color', 'babystreet_sanitize_hex');

/* Uploader */

function babystreet_sanitize_upload($input) {
	$output = esc_attr($input);
	return $output;
}

add_filter('babystreet_sanitize_upload', 'babystreet_sanitize_upload');

/* babystreet_upload */

function babystreet_sanitize_babystreet_upload($input) {
	$output = esc_attr($input);

	return $output;
}

add_filter('babystreet_sanitize_babystreet_upload', 'babystreet_sanitize_babystreet_upload');

/* Editor */

function babystreet_sanitize_editor($input) {
	if (current_user_can('unfiltered_html')) {
		$output = $input;
	} else {
		global $allowedtags;
		$output = wpautop(wp_kses($input, $allowedtags));
	}
	return $output;
}

add_filter('babystreet_sanitize_editor', 'babystreet_sanitize_editor');

/* Allowed Tags */

function babystreet_sanitize_allowedtags($input) {
	global $allowedtags;
	$output = wpautop(wp_kses($input, $allowedtags));
	return $output;
}

/* Allowed Post Tags */

function babystreet_sanitize_allowedposttags($input) {
	global $allowedposttags;
	$output = wpautop(wp_kses($input, $allowedposttags));
	return $output;
}

add_filter('babystreet_sanitize_info', 'babystreet_sanitize_allowedposttags');


/* Check that the key value sent is valid */

function babystreet_sanitize_enum($input, $option) {
	$output = '';
	if (array_key_exists($input, $option['options'])) {
		$output = $input;
	}
	return $output;
}

/* Background */

function babystreet_sanitize_background($input) {
	$output = wp_parse_args($input, array(
			'color' => '',
			'image' => '',
			'repeat' => 'repeat',
			'position' => 'top center',
			'attachment' => 'scroll'
	));

	$output['color'] = apply_filters('babystreet_sanitize_hex', $input['color']);
	$output['image'] = apply_filters('babystreet_sanitize_upload', $input['image']);
	$output['repeat'] = apply_filters('babystreet_background_repeat', $input['repeat']);
	$output['position'] = apply_filters('babystreet_background_position', $input['position']);
	$output['attachment'] = apply_filters('babystreet_background_attachment', $input['attachment']);

	return $output;
}

add_filter('babystreet_sanitize_background', 'babystreet_sanitize_background');

function babystreet_sanitize_background_repeat($value) {
	$recognized = babystreet_recognized_background_repeat();
	if (array_key_exists($value, $recognized)) {
		return $value;
	}
	return apply_filters('babystreet_default_background_repeat', current($recognized));
}

add_filter('babystreet_background_repeat', 'babystreet_sanitize_background_repeat');

function babystreet_sanitize_background_position($value) {
	$recognized = babystreet_recognized_background_position();
	if (array_key_exists($value, $recognized)) {
		return $value;
	}
	return apply_filters('babystreet_default_background_position', current($recognized));
}

add_filter('babystreet_background_position', 'babystreet_sanitize_background_position');

function babystreet_sanitize_background_attachment($value) {
	$recognized = babystreet_recognized_background_attachment();
	if (array_key_exists($value, $recognized)) {
		return $value;
	}
	return apply_filters('babystreet_default_background_attachment', current($recognized));
}

add_filter('babystreet_background_attachment', 'babystreet_sanitize_background_attachment');


/* Typography */

function babystreet_sanitize_typography($input, $option) {

	$output = wp_parse_args($input, array(
			'size' => '',
			'face' => '',
			'style' => '',
			'color' => ''
	));

	if (isset($option['options']['faces']) && isset($input['face'])) {
		if (is_array($option['options']['faces']) && !( array_key_exists($input['face'], $option['options']['faces']) )) {
			$output['face'] = '';
		}
	} else {
		$output['face'] = apply_filters('babystreet_font_face', $output['face']);
	}

	$output['size'] = apply_filters('babystreet_font_size', $output['size']);
	$output['style'] = apply_filters('babystreet_font_style', $output['style']);
	$output['color'] = apply_filters('babystreet_sanitize_color', $output['color']);
	return $output;
}

add_filter('babystreet_sanitize_typography', 'babystreet_sanitize_typography', 10, 2);

function babystreet_sanitize_font_size($value) {
	$recognized = babystreet_recognized_font_sizes();
	$value_check = preg_replace('/px/', '', $value);
	if (in_array((int) $value_check, $recognized)) {
		return $value;
	}
	return apply_filters('babystreet_default_font_size', $recognized);
}

add_filter('babystreet_font_size', 'babystreet_sanitize_font_size');

function babystreet_sanitize_font_style($value) {
	$recognized = babystreet_recognized_font_styles();
	if (array_key_exists($value, $recognized)) {
		return $value;
	}
	return $value;
}

add_filter('babystreet_font_style', 'babystreet_sanitize_font_style');

function babystreet_sanitize_font_face($value) {
	$recognized = babystreet_recognized_font_faces();
	if (array_key_exists($value, $recognized)) {
		return $value;
	}
	return apply_filters('babystreet_default_font_face', current($recognized));
}

add_filter('babystreet_font_face', 'babystreet_sanitize_font_face');

/**
 * Get recognized background repeat settings
 *
 * @return   array
 *
 */
function babystreet_recognized_background_repeat() {
	$default = array(
			'no-repeat' => esc_html__('No Repeat', 'babystreet'),
			'repeat-x' => esc_html__('Repeat Horizontally', 'babystreet'),
			'repeat-y' => esc_html__('Repeat Vertically', 'babystreet'),
			'repeat' => esc_html__('Repeat All', 'babystreet'),
	);
	return apply_filters('babystreet_recognized_background_repeat', $default);
}

/**
 * Get recognized background positions
 *
 * @return   array
 *
 */
function babystreet_recognized_background_position() {
	$default = array(
			'top left' => esc_html__('Top Left', 'babystreet'),
			'top center' => esc_html__('Top Center', 'babystreet'),
			'top right' => esc_html__('Top Right', 'babystreet'),
			'center left' => esc_html__('Middle Left', 'babystreet'),
			'center center' => esc_html__('Middle Center', 'babystreet'),
			'center right' => esc_html__('Middle Right', 'babystreet'),
			'bottom left' => esc_html__('Bottom Left', 'babystreet'),
			'bottom center' => esc_html__('Bottom Center', 'babystreet'),
			'bottom right' => esc_html__('Bottom Right', 'babystreet')
	);
	return apply_filters('babystreet_recognized_background_position', $default);
}

/**
 * Get recognized background attachment
 *
 * @return   array
 *
 */
function babystreet_recognized_background_attachment() {
	$default = array(
			'scroll' => esc_html__('Scroll Normally', 'babystreet'),
			'fixed' => esc_html__('Fixed in Place', 'babystreet')
	);
	return apply_filters('babystreet_recognized_background_attachment', $default);
}

/**
 * Sanitize a color represented in hexidecimal notation.
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @param    string    The value that this function should return if it cannot be recognized as a color.
 * @return   string
 *
 */
function babystreet_sanitize_hex($hex, $default = '') {
	if (babystreet_validate_hex($hex)) {
		return $hex;
	}
	return $default;
}

/**
 * Get recognized font sizes.
 *
 * Returns an indexed array of all recognized font sizes.
 * Values are integers and represent a range of sizes from
 * smallest to largest.
 *
 * @return   array
 */
function babystreet_recognized_font_sizes() {
	$sizes = range(9, 71);
	$sizes = apply_filters('babystreet_recognized_font_sizes', $sizes);
	$sizes = array_map('absint', $sizes);
	return $sizes;
}

/**
 * Get recognized font faces.
 *
 * Returns an array of all recognized font faces.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 *
 */
function babystreet_recognized_font_faces() {
	$default = array(
			'arial' => 'Arial',
			'verdana' => 'Verdana, Geneva',
			'trebuchet' => 'Trebuchet',
			'georgia' => 'Georgia',
			'times' => 'Times New Roman',
			'tahoma' => 'Tahoma, Geneva',
			'palatino' => 'Palatino',
			'helvetica' => 'Helvetica*'
	);
	return apply_filters('babystreet_recognized_font_faces', $default);
}

/**
 * Get recognized font styles.
 *
 * Returns an array of all recognized font styles.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 *
 */
function babystreet_recognized_font_styles() {
	$default = array(
			'normal' => esc_html__('Normal', 'babystreet'),
			'italic' => esc_html__('Italic', 'babystreet'),
			'bold' => esc_html__('Bold', 'babystreet'),
			'bold italic' => esc_html__('Bold Italic', 'babystreet')
	);
	return apply_filters('babystreet_recognized_font_styles', $default);
}

/**
 * Is a given string a color formatted in hexidecimal notation?
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @return   bool
 *
 */
function babystreet_validate_hex($hex) {
	$hex = trim($hex);
	/* Strip recognized prefixes. */
	if (0 === strpos($hex, '#')) {
		$hex = substr($hex, 1);
	} elseif (0 === strpos($hex, '%23')) {
		$hex = substr($hex, 3);
	}
	/* Regex match. */
	if (0 === preg_match('/^[0-9a-fA-F]{6}$/', $hex)) {
		return false;
	} else {
		return true;
	}
}
