<?php

/**
 * Generates the tabs that are used in the options menu
 */
function babystreet_optionsframework_tabs() {

	$options = babystreet_optionsframework_options();
	$menu = '';

	foreach ($options as $value) {
		// Heading for Navigation
		if ($value['type'] == "heading") {
			$jquery_click_hook = $value['tab_id'];
			$jquery_click_hook = "of-option-" . $jquery_click_hook;
			$menu .= '<a id="' . esc_attr($jquery_click_hook) . '-tab" class="nav-tab" title="' . esc_attr($value['name']) . '" href="' . esc_url('#' . $jquery_click_hook) . '">' . esc_html($value['name']) . '</a>';
		}
	}

	return $menu;
}

/**
 * Generates the options fields that are used in the form.
 */
function babystreet_optionsframework_fields() {

	//global $allowedtags;
	$desc_allowed_html = array(
			'a' => array(
					'target' => array(),
					'href' => array(),
					'title' => array()
			),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
			'b' => array(),
			'p' => array()
	);

	$option_name = 'babystreet';

	$settings = get_option($option_name);
	$options = babystreet_optionsframework_options();

	$counter = 0;
	$menu = '';

	foreach ($options as $value) {

		$counter++;
		$val = '';
		$select_value = '';
		$checked = '';
		$output_escaped = '';

		// Wrap all options
		if (!in_array($value['type'], array('heading', 'info', 'start_section', 'end_section'))) {

			// Keep all ids lowercase with no spaces
			$value['id'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['id']));

			$id = 'section-' . esc_attr($value['id']);

			$class = 'section ';
			if (isset($value['type'])) {
				$class .= ' section-' . esc_attr($value['type']);
			}
			if (isset($value['class'])) {
				$class .= ' ' . esc_attr($value['class']);
			}

			$output_escaped .= '<div id="' . esc_attr($id) . '" class="' . esc_attr($class) . '">' . "\n";
			if (isset($value['name'])) {
				$output_escaped .= '<h4 class="heading">' . esc_html($value['name']) . '</h4>' . "\n";
			}
			if ($value['type'] != 'editor') {
				$output_escaped .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
			} else {
				$output_escaped .= '<div class="option">' . "\n" . '<div>' . "\n";
			}
		}

		// Set default value to $val
		if (isset($value['std'])) {
			$val = $value['std'];
		}

		// If the option is already saved, ovveride $val
		if (!in_array($value['type'], array('heading', 'info', 'start_section', 'end_section'))) {
			if (isset($settings[($value['id'])])) {
				$val = $settings[($value['id'])];
				// Striping slashes of non-array options
				if (!is_array($val)) {
					$val = stripslashes($val);
				}
			}
		}

		// If there is a description save it for labels
		$explain_value = '';
		if (isset($value['desc'])) {
			$explain_value = $value['desc'];
		}

		switch ($value['type']) {

			// Basic text input
			case 'text':
				$output_escaped .= '<input id="' . esc_attr($value['id']) . '" class="of-input" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" type="text" value="' . esc_attr($val) . '" />';
				break;

			// Textarea
			case 'textarea':
				$rows = '8';

				if (isset($value['settings']['rows'])) {
					$custom_rows = $value['settings']['rows'];
					if (is_numeric($custom_rows)) {
						$rows = $custom_rows;
					}
				}

				$val = stripslashes($val);
				$output_escaped .= '<textarea id="' . esc_attr($value['id']) . '" class="of-input" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" rows="' . $rows . '">' . esc_textarea($val) . '</textarea>';
				break;

			// Select Box
			case ($value['type'] == 'select'):
				$output_escaped .= '<select class="of-input" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" id="' . esc_attr($value['id']) . '">';

				foreach ($value['options'] as $key => $option) {
					$selected = '';
					if ($val != '') {
						if ($val == $key) {
							$selected = ' selected="selected"';
						}
					}
					$output_escaped .= '<option' . $selected . ' value="' . esc_attr($key) . '">' . esc_html($option) . '</option>';
				}
				$output_escaped .= '</select>';
				break;


			// Radio Box
			case "radio":
				$name = $option_name . '[' . $value['id'] . ']';
				foreach ($value['options'] as $key => $option) {
					$id = $option_name . '-' . $value['id'] . '-' . $key;
					$output_escaped .= '<input class="of-input of-radio" type="radio" name="' . esc_attr($name) . '" id="' . esc_attr($id) . '" value="' . esc_attr($key) . '" ' . checked($val, $key, false) . ' /><label for="' . esc_attr($id) . '">' . esc_html($option) . '</label>';
				}
				break;

			// Image Selectors
			case "images":
				$name = $option_name . '[' . $value['id'] . ']';
				foreach ($value['options'] as $key => $option) {
					$selected = '';
					$checked = '';
					if ($val != '') {
						if ($val == $key) {
							$selected = ' of-radio-img-selected';
							$checked = ' checked="checked"';
						}
					}
					$output_escaped .= '<input type="radio" id="' . esc_attr($value['id'] . '_' . $key) . '" class="of-radio-img-radio" value="' . esc_attr($key) . '" name="' . esc_attr($name) . '" ' . $checked . ' />';

					$output_escaped .= '<span class="of-radio-img-img' . esc_attr($selected) . '" onclick="document.getElementById(\'' . esc_js($value['id'] . '_' . $key) . '\').checked=true;"><img src="' . esc_url($option) . '" /><span class="babystreet-of-radio-img-label">' . esc_html(ucwords(str_replace('_', ' ',str_replace('babystreet_', '', $key)))) . '</span></span>';
				}
				break;

			// Checkbox
			case "checkbox":
				$class = isset($value['class']) ? esc_attr($value['class']) : '';
				$output_escaped .= '<input id="' . esc_attr($value['id']) . '" class="checkbox of-input ' . $class . '" type="checkbox" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" ' . checked($val, 1, false) . ' />';
				$output_escaped .= '<label class="explain" for="' . esc_attr($value['id']) . '">' . wp_kses($explain_value, $desc_allowed_html) . '</label>';
				break;

			// Multicheck
			case "multicheck":
				foreach ($value['options'] as $key => $option) {
					$checked = '';
					$label = $option;
					$option = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($key));

					$id = $option_name . '-' . $value['id'] . '-' . $option;
					$name = $option_name . '[' . $value['id'] . '][' . $option . ']';

					if (isset($val[$option])) {
						$checked = checked($val[$option], 1, false);
					}

					$output_escaped .= '<input id="' . esc_attr($id) . '" class="checkbox of-input" type="checkbox" name="' . esc_attr($name) . '" ' . $checked . ' /><label for="' . esc_attr($id) . '">' . esc_html($label) . '</label>';
				}
				break;

			// Color picker
			case "color":
				$output_escaped .= '<input class="babystreet-theme-options-colorpicker" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" id="' . esc_attr($value['id']) . '" type="text" value="' . esc_attr($val) . '" />';
				break;

			// Uploader
			case "upload":
				$output_escaped .= babystreet_optionsframework_medialibrary_uploader($value['id'], $val, null);
				break;

			// babystreet Uploader
			case "babystreet_upload":
				$is_multiple = array_key_exists('is_multiple', $value) && $value['is_multiple'] ? true : false;
				$output_escaped .= babystreet_medialibrary_uploader($value['id'], $val, null, '', 0, '', $is_multiple);
				break;

			// Typography
			case 'typography':

				$font_size = $font_style = $font_face = $font_color = $font_preview = null;

				$typography_defaults = array(
						'size' => '',
						'face' => '',
						'style' => '',
						'color' => '',
						'preview' => ''
				);

				$typography_stored = wp_parse_args($val, $typography_defaults);

				$typography_options = array(
						'sizes' => babystreet_recognized_font_sizes(),
						'faces' => babystreet_recognized_font_faces(),
						'styles' => babystreet_recognized_font_styles(),
						'color' => true,
						'preview' => false
				);

				if (isset($value['options'])) {
					$typography_options = wp_parse_args($value['options'], $typography_options);
				}

				// Font Size
				if ($typography_options['sizes']) {
					$font_size = '<select class="of-typography of-typography-size" name="' . esc_attr($option_name . '[' . $value['id'] . '][size]') . '" id="' . esc_attr($value['id'] . '_size') . '">';
					$sizes = $typography_options['sizes'];
					foreach ($sizes as $i) {
						$size = $i . 'px';
						$font_size .= '<option value="' . esc_attr($size) . '" ' . selected($typography_stored['size'], $size, false) . '>' . esc_html($size) . '</option>';
					}
					$font_size .= '</select>';
				}

				// Font Face
				if ($typography_options['faces']) {
					$font_face = '<select class="of-typography of-typography-face" name="' . esc_attr($option_name . '[' . $value['id'] . '][face]') . '" id="' . esc_attr($value['id'] . '_face') . '">';
					$faces = $typography_options['faces'];
					foreach ($faces as $key => $face) {
						$font_face .= '<option value="' . esc_attr($key) . '" ' . selected($typography_stored['face'], $key, false) . '>' . esc_html($face) . '</option>';
					}
					$font_face .= '</select>';
				}

				// Font Styles
				if ($typography_options['styles']) {
					$font_style = '<select class="of-typography of-typography-style" name="' . $option_name . '[' . $value['id'] . '][style]" id="' . $value['id'] . '_style">';
					$styles = $typography_options['styles'];
					foreach ($styles as $key => $style) {
						$font_style .= '<option value="' . esc_attr($key) . '" ' . selected($typography_stored['style'], $key, false) . '>' . $style . '</option>';
					}
					$font_style .= '</select>';
				}

				// Font Color
				if ($typography_options['color']) {
					$font_color = '<input class="of-color of-typography of-typography-color babystreet-theme-options-colorpicker" name="' . esc_attr($option_name . '[' . $value['id'] . '][color]') . '" id="' . esc_attr($value['id'] . '_color') . '" type="text" value="' . esc_attr($typography_stored['color']) . '" />';
				}

				// Font Preview
				if ($typography_options['preview']) {

					if ($value['id'] == 'body_font') {
						$preview_face = str_replace('+', ' ', $typography_stored['face']);
					} else {
						$headings_font = babystreet_get_option('headings_font', array('face' => 'Oswald'));
						$preview_face = str_replace('+', ' ', $headings_font['face']);
					}

					$preview_size = $typography_stored['size'];
					$preview_color = $typography_stored['color'];
					$preview_style = json_decode($typography_stored['style'], true);

					$html_style = '';
					if ($preview_style) {
						$html_style = 'font-weight:' . esc_attr($preview_style['font-weight'] . ';font-style:' . $preview_style['font-style'] . ';');
					}

					$font_preview = '<div id="' . esc_attr($value['id']) . '_preview" class="babystreet_font_preview">';
					$font_preview .= '<p style="font-family:' . $preview_face . ';font-size:' . $preview_size . ';color:' . $preview_color . ';' . $html_style . '">Sample Text</p>';
					$font_preview .= '</div>';
				}

				// Allow modification/injection of typography fields
				$typography_fields = compact('font_size', 'font_face', 'font_style', 'font_color', 'font_preview');
				$typography_fields = apply_filters('babystreet_typography_fields', $typography_fields, $typography_stored, $option_name, $value);
				$output_escaped .= implode('', $typography_fields);

				break;

			// Background
			case 'background':

				$background = $val;

				// Background Color
				$output_escaped .= '<input class="of-color of-background of-background-color babystreet-theme-options-colorpicker" name="' . esc_attr($option_name . '[' . $value['id'] . '][color]') . '" id="' . esc_attr($value['id'] . '_color') . '" type="text" value="' . esc_attr($background['color']) . '" />';

				$output_escaped .= babystreet_medialibrary_uploader($value['id'], $background['image'], null, '', 0, 'image', false);

				// Background Image - New AJAX Uploader using Media Library
				if (!isset($background['image'])) {
					$background['image'] = '';
				}

				$class = 'of-background-properties';
				if ('' == $background['image']) {
					$class .= ' hide';
				}
				$output_escaped .= '<div class="' . esc_attr($class) . '">';

				// Background Repeat
				$output_escaped .= '<select class="of-background of-background-repeat" name="' . esc_attr($option_name . '[' . $value['id'] . '][repeat]') . '" id="' . esc_attr($value['id'] . '_repeat') . '">';
				$repeats = babystreet_recognized_background_repeat();

				foreach ($repeats as $key => $repeat) {
					$output_escaped .= '<option value="' . esc_attr($key) . '" ' . selected($background['repeat'], $key, false) . '>' . esc_html($repeat) . '</option>';
				}
				$output_escaped .= '</select>';

				// Background Position
				$output_escaped .= '<select class="of-background of-background-position" name="' . esc_attr($option_name . '[' . $value['id'] . '][position]') . '" id="' . esc_attr($value['id'] . '_position') . '">';
				$positions = babystreet_recognized_background_position();

				foreach ($positions as $key => $position) {
					$output_escaped .= '<option value="' . esc_attr($key) . '" ' . selected($background['position'], $key, false) . '>' . esc_html($position) . '</option>';
				}
				$output_escaped .= '</select>';

				// Background Attachment
				$output_escaped .= '<select class="of-background of-background-attachment" name="' . esc_attr($option_name . '[' . $value['id'] . '][attachment]') . '" id="' . esc_attr($value['id'] . '_attachment') . '">';
				$attachments = babystreet_recognized_background_attachment();

				foreach ($attachments as $key => $attachment) {
					$output_escaped .= '<option value="' . esc_attr($key) . '" ' . selected($background['attachment'], $key, false) . '>' . esc_html($attachment) . '</option>';
				}
				$output_escaped .= '</select>';
				$output_escaped .= '</div>';

				break;

			// Editor
			case 'editor':
				$output_escaped .= '<div class="explain">' . wp_kses($explain_value, $desc_allowed_html) . '</div>' . "\n";
				echo wp_kses_post($output_escaped);
				$textarea_name = esc_attr($option_name . '[' . $value['id'] . ']');
				$default_editor_settings = array(
						'textarea_name' => $textarea_name,
						'media_buttons' => false,
						'tinymce' => array('plugins' => 'wordpress')
				);
				$editor_settings = array();
				if (isset($value['settings'])) {
					$editor_settings = $value['settings'];
				}
				$editor_settings = array_merge($default_editor_settings, $editor_settings);
				wp_editor($val, $value['id'], $editor_settings);
				$output_escaped = '';
				break;

			// Info
			case "info":
				$id = '';
				$class = 'section';
				if (isset($value['id'])) {
					$id = 'id="' . esc_attr($value['id']) . '" ';
				}
				if (isset($value['type'])) {
					$class .= ' section-' . $value['type'];
				}
				if (isset($value['class'])) {
					$class .= ' ' . $value['class'];
				}

				$output_escaped .= '<div ' . $id . 'class="' . esc_attr($class) . '">' . "\n";
				if (isset($value['name'])) {
					$output_escaped .= '<h4 class="heading">' . esc_html($value['name']) . '</h4>' . "\n";
				}
				if ($value['desc']) {
					$output_escaped .= apply_filters('babystreet_sanitize_info', $value['desc']) . "\n";
				}
				$output_escaped .= '</div>' . "\n";
				break;

			// Section start
			case "start_section":
				$id = '';
				$class = 'block';
				if (isset($value['id'])) {
					$id = 'id="' . esc_attr($value['id']) . '" ';
				}
				if (isset($value['type'])) {
					$class .= ' block-' . $value['type'];
				}
				if (isset($value['class'])) {
					$class .= ' ' . $value['class'];
				}

				if (isset($value['name'])) {
					$output_escaped .= '<h4 class="babystreet-accordion-heading"><strong>' . esc_html($value['name']) . '</strong></h4>' . "\n";
				}

				$output_escaped .= '<div ' . $id . 'class="' . esc_attr($class) . '">' . "\n";

				if (isset($value['desc'])) {
					$output_escaped .= apply_filters('babystreet_sanitize_info', $value['desc']) . "\n";
				}
				break;

			// Section end
			case "end_section":
				$output_escaped .= '</div>';
				break;

			// Heading for Navigation
			case "heading":
				if ($counter >= 2) {
					$output_escaped .= '</div>' . "\n";
				}
				$class = 'group';
				if (isset($value['class'])) {
					$class .= ' ' . $value['class'];
				}

				$jquery_click_hook = $value['tab_id'];
				$jquery_click_hook = "of-option-" . $jquery_click_hook;
				$menu .= '<a id="' . esc_attr($jquery_click_hook) . '-tab" class="nav-tab" title="' . esc_attr($value['name']) . '" href="' . esc_url('#' . $jquery_click_hook) . '">' . esc_html($value['name']) . '</a>';
				$output_escaped .= '<div class="' . esc_attr($class) . '" id="' . esc_attr($jquery_click_hook) . '">';
				$output_escaped .= '<h3>' . esc_html($value['name']) . '</h3>' . "\n";
				break;

			// Custom sidebars
			case 'sidebar':

				$custom_sidebars = explode(';', esc_attr($val));
				if (!end($custom_sidebars)) {
					array_pop($custom_sidebars);
				}

				reset($custom_sidebars);

				$output_escaped .= '<input id="new_' . esc_attr($value['id']) . '" class="of-input" name="new_' . esc_attr($option_name . '[' . $value['id'] . ']') . '" type="text" />';
				$output_escaped .= '<input type="button" value="' . esc_html__('Add', 'babystreet') . '" class="button" id="add_custom_sidebar">';
				$output_escaped .= '<input id="' . esc_attr($value['id']) . '" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" type="hidden" value="' . esc_attr($val) . '" />';

				if (count($custom_sidebars)) {
					$output_escaped .= '<h4>' . esc_html__('List of created custom sidebars:', 'babystreet') . '</h4>';

					$output_escaped .= '<div id="babystreet_custom_sidebars_list">';

					foreach ($custom_sidebars as $sidebar) {
						$output_escaped .= '<div><a class="babystreet_del_sdbr" data-sidebar-name="' . $sidebar . '" href="#"></a> ' . $sidebar . '</div>';
					}

					$output_escaped .= '</div>';
				} else {
					$output_escaped .= '<h4 class="babystreet_no_custom_sidebars">' . esc_html__('No custom sidebars.', 'babystreet') . '</h4>';
					$output_escaped .= '<div id="babystreet_custom_sidebars_list"></div>';
				}


				break;
		}

		if (!in_array($value['type'], array('heading', 'info', 'start_section', 'end_section'))) {
			$output_escaped .= '</div>';
			if (( $value['type'] != "checkbox" ) && ( $value['type'] != "editor" )) {
				$output_escaped .= '<div class="explain">' . wp_kses($explain_value, $desc_allowed_html) . '</div>' . "\n";
			}
			$output_escaped .= '</div></div>' . "\n";
		}

		// This variable has been safely escaped in the following file: babystreet/incl/babystreet-options-framework/babystreet-options-interface.php Line: 74 - 485
		echo $output_escaped; // All dynamic data escaped. Rendered in the backend.
	}
	echo '</div>';
}
