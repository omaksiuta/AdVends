<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('sweet_dessert_sc_search_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_sc_search_theme_setup' );
	function sweet_dessert_sc_search_theme_setup() {
		add_action('sweet_dessert_action_shortcodes_list', 		'sweet_dessert_sc_search_reg_shortcodes');
		if (function_exists('sweet_dessert_exists_visual_composer') && sweet_dessert_exists_visual_composer())
			add_action('sweet_dessert_action_shortcodes_list_vc','sweet_dessert_sc_search_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_search id="unique_id" open="yes|no"]
*/

if (!function_exists('sweet_dessert_sc_search')) {	
	function sweet_dessert_sc_search($atts, $content=null){	
		if (sweet_dessert_in_shortcode_blogger()) return '';
		extract(sweet_dessert_html_decode(shortcode_atts(array(
			// Individual params
			"style" => "",
			"state" => "",
			"ajax" => "",
			"title" => esc_html__('Search', 'trx_utils'),
			"scheme" => "original",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . sweet_dessert_get_css_position_as_classes($top, $right, $bottom, $left);
		if ($style == 'fullscreen') {
			if (empty($ajax)) $ajax = "no";
			if (empty($state)) $state = "closed";
		} else if ($style == 'expand') {
			if (empty($ajax)) $ajax = sweet_dessert_get_theme_option('use_ajax_search');
			if (empty($state)) $state = "closed";
		} else if ($style == 'slide') {
			if (empty($ajax)) $ajax = sweet_dessert_get_theme_option('use_ajax_search');
			if (empty($state)) $state = "closed";
		} else {
			if (empty($ajax)) $ajax = sweet_dessert_get_theme_option('use_ajax_search');
			if (empty($state)) $state = "fixed";
		}
		// Load core messages
		sweet_dessert_enqueue_messages();
		$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') . ' class="search_wrap search_style_'.esc_attr($style).' search_state_'.esc_attr($state)
						. (sweet_dessert_param_is_on($ajax) ? ' search_ajax' : '')
						. ($class ? ' '.esc_attr($class) : '')
						. '"'
					. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
					. (!sweet_dessert_param_is_off($animation) ? ' data-animation="'.esc_attr(sweet_dessert_get_animation_classes($animation)).'"' : '')
					. '>
						<div class="search_form_wrap">
							<form role="search" method="get" class="search_form" action="' . esc_url(home_url('/')) . '">
								<button type="submit" class="search_submit icon-search" title="' . ($state=='closed' ? esc_attr__('Open search', 'trx_utils') : esc_attr__('Start search', 'trx_utils')) . '"></button>
								<input type="text" class="search_field" placeholder="' . esc_attr($title) . '" value="' . esc_attr(get_search_query()) . '" name="s" />'
								. ($style == 'fullscreen' ? '<a class="search_close icon-cancel"></a>' : '')
							. '</form>
						</div>'
						. (sweet_dessert_param_is_on($ajax) ? '<div class="search_results widget_area' . ($scheme && !sweet_dessert_param_is_off($scheme) && !sweet_dessert_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '') . '"><a class="search_results_close icon-cancel"></a><div class="search_results_content"></div></div>' : '')
					. '</div>';
		return apply_filters('sweet_dessert_shortcode_output', $output, 'trx_search', $atts, $content);
	}
	sweet_dessert_require_shortcode('trx_search', 'sweet_dessert_sc_search');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'sweet_dessert_sc_search_reg_shortcodes' ) ) {
	function sweet_dessert_sc_search_reg_shortcodes() {
	
		sweet_dessert_sc_map("trx_search", array(
			"title" => esc_html__("Search", 'trx_utils'),
			"desc" => wp_kses_data( __("Show search form", 'trx_utils') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"style" => array(
					"title" => esc_html__("Style", 'trx_utils'),
					"desc" => wp_kses_data( __("Select style to display search field", 'trx_utils') ),
					"value" => "regular",
					"options" => sweet_dessert_get_list_search_styles(),
					"type" => "checklist"
				),
				"state" => array(
					"title" => esc_html__("State", 'trx_utils'),
					"desc" => wp_kses_data( __("Select search field initial state", 'trx_utils') ),
					"value" => "fixed",
					"options" => array(
						"fixed"  => esc_html__('Fixed',  'trx_utils'),
						"opened" => esc_html__('Opened', 'trx_utils'),
						"closed" => esc_html__('Closed', 'trx_utils')
					),
					"type" => "checklist"
				),
				"title" => array(
					"title" => esc_html__("Title", 'trx_utils'),
					"desc" => wp_kses_data( __("Title (placeholder) for the search field", 'trx_utils') ),
					"value" => esc_html__("Search &hellip;", 'trx_utils'),
					"type" => "text"
				),
				"ajax" => array(
					"title" => esc_html__("AJAX", 'trx_utils'),
					"desc" => wp_kses_data( __("Search via AJAX or reload page", 'trx_utils') ),
					"value" => "yes",
					"options" => sweet_dessert_get_sc_param('yes_no'),
					"type" => "switch"
				),
				"top" => sweet_dessert_get_sc_param('top'),
				"bottom" => sweet_dessert_get_sc_param('bottom'),
				"left" => sweet_dessert_get_sc_param('left'),
				"right" => sweet_dessert_get_sc_param('right'),
				"id" => sweet_dessert_get_sc_param('id'),
				"class" => sweet_dessert_get_sc_param('class'),
				"animation" => sweet_dessert_get_sc_param('animation'),
				"css" => sweet_dessert_get_sc_param('css')
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'sweet_dessert_sc_search_reg_shortcodes_vc' ) ) {
	function sweet_dessert_sc_search_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_search",
			"name" => esc_html__("Search form", 'trx_utils'),
			"description" => wp_kses_data( __("Insert search form", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_search',
			"class" => "trx_sc_single trx_sc_search",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "style",
					"heading" => esc_html__("Style", 'trx_utils'),
					"description" => wp_kses_data( __("Select style to display search field", 'trx_utils') ),
					"class" => "",
					"value" => sweet_dessert_get_list_search_styles(),
					"type" => "dropdown"
				),
				array(
					"param_name" => "state",
					"heading" => esc_html__("State", 'trx_utils'),
					"description" => wp_kses_data( __("Select search field initial state", 'trx_utils') ),
					"class" => "",
					"value" => array(
						esc_html__('Fixed', 'trx_utils')  => "fixed",
						esc_html__('Opened', 'trx_utils') => "opened",
						esc_html__('Closed', 'trx_utils') => "closed"
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "title",
					"heading" => esc_html__("Title", 'trx_utils'),
					"description" => wp_kses_data( __("Title (placeholder) for the search field", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => esc_html__("Search &hellip;", 'trx_utils'),
					"type" => "textfield"
				),
				array(
					"param_name" => "ajax",
					"heading" => esc_html__("AJAX", 'trx_utils'),
					"description" => wp_kses_data( __("Search via AJAX or reload page", 'trx_utils') ),
					"class" => "",
					"value" => array(esc_html__('Use AJAX search', 'trx_utils') => 'yes'),
					"type" => "checkbox"
				),
				sweet_dessert_get_vc_param('id'),
				sweet_dessert_get_vc_param('class'),
				sweet_dessert_get_vc_param('animation'),
				sweet_dessert_get_vc_param('css'),
				sweet_dessert_get_vc_param('margin_top'),
				sweet_dessert_get_vc_param('margin_bottom'),
				sweet_dessert_get_vc_param('margin_left'),
				sweet_dessert_get_vc_param('margin_right')
			)
		) );
		
		class WPBakeryShortCode_Trx_Search extends Sweet_Dessert_VC_ShortCodeSingle {}
	}
}
?>