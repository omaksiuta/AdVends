<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('sweet_dessert_mailchimp_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_mailchimp_theme_setup', 1 );
	function sweet_dessert_mailchimp_theme_setup() {
		if (is_admin()) {
			add_filter( 'sweet_dessert_filter_required_plugins',					'sweet_dessert_mailchimp_required_plugins' );
		}
	}
}

// Check if Custom Feeds for Instagram installed and activated
if ( !function_exists( 'sweet_dessert_exists_mailchimp' ) ) {
	function sweet_dessert_exists_mailchimp() {
		return function_exists('mc4wp_load_plugin');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'sweet_dessert_mailchimp_required_plugins' ) ) {
	function sweet_dessert_mailchimp_required_plugins($list=array()) {
		if (in_array('mailchimp', sweet_dessert_storage_get('required_plugins')))
			$list[] = array(
				'name' 		=> esc_html__('MailChimp for WP', 'sweet-dessert'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		return $list;
	}
}
?>