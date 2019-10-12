<?php
/**
 * Sweet Dessert Framework: Theme options custom fields
 *
 * @package	sweet_dessert
 * @since	sweet_dessert 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'sweet_dessert_options_custom_theme_setup' ) ) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_options_custom_theme_setup' );
	function sweet_dessert_options_custom_theme_setup() {

		if ( is_admin() ) {
			add_action("admin_enqueue_scripts",	'sweet_dessert_options_custom_load_scripts');
		}
		
	}
}

// Load required styles and scripts for custom options fields
if ( !function_exists( 'sweet_dessert_options_custom_load_scripts' ) ) {
	function sweet_dessert_options_custom_load_scripts() {
		wp_enqueue_script( 'sweet-dessert-options-custom-script',	sweet_dessert_get_file_url('core/core.options/js/core.options-custom.js'), array(), null, true );
	}
}


// Show theme specific fields in Post (and Page) options
if ( !function_exists( 'sweet_dessert_show_custom_field' ) ) {
	function sweet_dessert_show_custom_field($id, $field, $value) {
		$output = '';
		switch ($field['type']) {
			case 'reviews':
				$output .= '<div class="reviews_block">' . trim(sweet_dessert_reviews_get_markup($field, $value, true)) . '</div>';
				break;
	
			case 'mediamanager':
				wp_enqueue_media( );
				$output .= '<a id="'.esc_attr($id).'" class="button mediamanager sweet_dessert_media_selector"
					data-param="' . esc_attr($id) . '"
					data-choose="'.esc_attr(isset($field['multiple']) && $field['multiple'] ? esc_html__( 'Choose Images', 'sweet-dessert') : esc_html__( 'Choose Image', 'sweet-dessert')).'"
					data-update="'.esc_attr(isset($field['multiple']) && $field['multiple'] ? esc_html__( 'Add to Gallery', 'sweet-dessert') : esc_html__( 'Choose Image', 'sweet-dessert')).'"
					data-multiple="'.esc_attr(isset($field['multiple']) && $field['multiple'] ? 'true' : 'false').'"
					data-linked-field="'.esc_attr($field['media_field_id']).'"
					>' . (isset($field['multiple']) && $field['multiple'] ? esc_html__( 'Choose Images', 'sweet-dessert') : esc_html__( 'Choose Image', 'sweet-dessert')) . '</a>';
				break;
		}
		return apply_filters('sweet_dessert_filter_show_custom_field', $output, $id, $field, $value);
	}
}
?>