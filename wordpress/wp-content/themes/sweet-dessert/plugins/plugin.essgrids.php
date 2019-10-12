<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('sweet_dessert_essgrids_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_essgrids_theme_setup', 1 );
	function sweet_dessert_essgrids_theme_setup() {
		// Register shortcode in the shortcodes list
		if (is_admin()) {
			add_filter( 'sweet_dessert_filter_required_plugins',				'sweet_dessert_essgrids_required_plugins' );
		}
	}
}


// Check if Ess. Grid installed and activated
if ( !function_exists( 'sweet_dessert_exists_essgrids' ) ) {
	function sweet_dessert_exists_essgrids() {
		return defined('EG_PLUGIN_PATH');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'sweet_dessert_essgrids_required_plugins' ) ) {
	function sweet_dessert_essgrids_required_plugins($list=array()) {
		if (in_array('essgrids', sweet_dessert_storage_get('required_plugins'))) {
			$path = sweet_dessert_get_file_dir('plugins/install/essential-grid.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' 		=> esc_html__('Essential Grid', 'sweet-dessert'),
					'slug' 		=> 'essential-grid',
                    'version'  => '2.3.2',
					'source'	=> $path,
					'required' 	=> false
					);
			}
		}
		return $list;
	}
}
?>