<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('sweet_dessert_revslider_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_revslider_theme_setup', 1 );
	function sweet_dessert_revslider_theme_setup() {
		if (sweet_dessert_exists_revslider()) {
			add_filter( 'sweet_dessert_filter_list_sliders',					'sweet_dessert_revslider_list_sliders' );
			add_filter( 'sweet_dessert_filter_shortcodes_params',			'sweet_dessert_revslider_shortcodes_params' );
			add_filter( 'sweet_dessert_filter_theme_options_params',			'sweet_dessert_revslider_theme_options_params' );
		}
		if (is_admin()) {
			add_filter( 'sweet_dessert_filter_required_plugins',				'sweet_dessert_revslider_required_plugins' );
		}
	}
}

if ( !function_exists( 'sweet_dessert_revslider_settings_theme_setup2' ) ) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_revslider_settings_theme_setup2', 3 );
	function sweet_dessert_revslider_settings_theme_setup2() {
		if (sweet_dessert_exists_revslider()) {

			// Add Revslider specific options in the Theme Options
			sweet_dessert_storage_set_array_after('options', 'slider_engine', "slider_alias", array(
				"title" => esc_html__('Revolution Slider: Select slider',  'sweet-dessert'),
				"desc" => wp_kses_data( __("Select slider to show (if engine=revo in the field above)", 'sweet-dessert') ),
				"override" => "category,services_group,page",
				"dependency" => array(
					'show_slider' => array('yes'),
					'slider_engine' => array('revo')
				),
				"std" => "",
				"options" => sweet_dessert_get_options_param('list_revo_sliders'),
				"type" => "select"
				)
			);

		}
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'sweet_dessert_exists_revslider' ) ) {
	function sweet_dessert_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'sweet_dessert_revslider_required_plugins' ) ) {
	function sweet_dessert_revslider_required_plugins($list=array()) {
		if (in_array('revslider', sweet_dessert_storage_get('required_plugins'))) {
			$path = sweet_dessert_get_file_dir('plugins/install/revslider.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' 		=> esc_html__('Revolution Slider', 'sweet-dessert'),
					'slug' 		=> 'revslider',
                    'version'  => '6.0.9',
					'source'	=> $path,
					'required' 	=> false
					);
			}
		}
		return $list;
	}
}

// Lists
//------------------------------------------------------------------------

// Add RevSlider in the sliders list, prepended inherit (if need)
if ( !function_exists( 'sweet_dessert_revslider_list_sliders' ) ) {
	function sweet_dessert_revslider_list_sliders($list=array()) {
		$list["revo"] = esc_html__("Layer slider (Revolution)", 'sweet-dessert');
		return $list;
	}
}

// Return Revo Sliders list, prepended inherit (if need)
if ( !function_exists( 'sweet_dessert_get_list_revo_sliders' ) ) {
	function sweet_dessert_get_list_revo_sliders($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_revo_sliders'))=='') {
			$list = array();
			if (sweet_dessert_exists_revslider()) {
				global $wpdb;
				$rows = $wpdb->get_results( "SELECT alias, title FROM " . esc_sql($wpdb->prefix) . "revslider_sliders" );
				if (is_array($rows) && count($rows) > 0) {
					foreach ($rows as $row) {
						$list[$row->alias] = $row->title;
					}
				}
			}
			$list = apply_filters('sweet_dessert_filter_list_revo_sliders', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_revo_sliders', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Add RevSlider in the shortcodes params
if ( !function_exists( 'sweet_dessert_revslider_shortcodes_params' ) ) {
	function sweet_dessert_revslider_shortcodes_params($list=array()) {
		$list["revo_sliders"] = sweet_dessert_get_list_revo_sliders();
		return $list;
	}
}

// Add RevSlider in the Theme Options params
if ( !function_exists( 'sweet_dessert_revslider_theme_options_params' ) ) {
	function sweet_dessert_revslider_theme_options_params($list=array()) {
		$list["list_revo_sliders"] = array('$sweet_dessert_get_list_revo_sliders' => '');
		return $list;
	}
}
?>