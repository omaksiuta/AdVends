<?php
/* WPBakery PageBuilder support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('sweet_dessert_vc_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_vc_theme_setup', 1 );
	function sweet_dessert_vc_theme_setup() {
		if (sweet_dessert_exists_visual_composer()) {
			add_action('sweet_dessert_action_add_styles',		 				'sweet_dessert_vc_frontend_scripts' );
		}
		if (is_admin()) {

			add_filter( 'sweet_dessert_filter_required_plugins',					'sweet_dessert_vc_required_plugins' );
		}
	}
}

// Check if WPBakery PageBuilder installed and activated
if ( !function_exists( 'sweet_dessert_exists_visual_composer' ) ) {
	function sweet_dessert_exists_visual_composer() {
		return class_exists('Vc_Manager');
	}
}

// Check if WPBakery PageBuilder in frontend editor mode
if ( !function_exists( 'sweet_dessert_vc_is_frontend' ) ) {
	function sweet_dessert_vc_is_frontend() {
		return (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true')
			|| (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'sweet_dessert_vc_required_plugins' ) ) {
	function sweet_dessert_vc_required_plugins($list=array()) {
		if (in_array('visual_composer', sweet_dessert_storage_get('required_plugins'))) {
			$path = sweet_dessert_get_file_dir('plugins/install/js_composer.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' 		=> esc_html__('WPBakery PageBuilder', 'sweet-dessert'),
					'slug' 		=> 'js_composer',
                    'version'  => '6.0.5',
					'source'	=> $path,
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Enqueue VC custom styles
if ( !function_exists( 'sweet_dessert_vc_frontend_scripts' ) ) {
	function sweet_dessert_vc_frontend_scripts() {
		if (file_exists(sweet_dessert_get_file_dir('css/plugin.visual-composer.css')))
			wp_enqueue_style( 'sweet-dessert-plugin-visual-composer-style',  sweet_dessert_get_file_url('css/plugin.visual-composer.css'), array(), null );
	}
}
?>