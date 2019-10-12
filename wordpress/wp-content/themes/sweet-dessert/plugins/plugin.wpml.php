<?php
/* WPML support functions
------------------------------------------------------------------------------- */

// Check if WPML installed and activated
if ( !function_exists( 'sweet_dessert_exists_wpml' ) ) {
	function sweet_dessert_exists_wpml() {
		return defined('ICL_SITEPRESS_VERSION') && class_exists('sitepress');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'sweet_dessert_wpml_required_plugins' ) ) {
	function sweet_dessert_wpml_required_plugins($list=array()) {
		if (in_array('wpml', sweet_dessert_storage_get('required_plugins'))) {
			$path = sweet_dessert_get_file_dir('plugins/install/wpml.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' 		=> esc_html__('WPML', 'sweet-dessert'),
					'slug' 		=> 'wpml',
					'source'	=> $path,
					'required' 	=> false
					);
			}
		}
		return $list;
	}
}
?>