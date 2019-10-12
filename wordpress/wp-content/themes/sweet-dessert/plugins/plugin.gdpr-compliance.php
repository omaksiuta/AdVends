<?php
/* The GDPR Framework support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('sweet_dessert_gdpr_compliance_theme_setup')) {
    add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_gdpr_compliance_theme_setup', 1 );
    function sweet_dessert_gdpr_compliance_theme_setup() {
        if (is_admin()) {
            add_filter( 'sweet_dessert_filter_required_plugins', 'sweet_dessert_gdpr_compliance_required_plugins' );
        }
    }
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'sweet_dessert_exists_gdpr_compliance' ) ) {
    function sweet_dessert_exists_gdpr_compliance() {
        return defined( 'WP_GDPR_C_SLUG' );
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'sweet_dessert_gdpr_compliance_required_plugins' ) ) {
    //Handler of add_filter('sweet_dessert_filter_required_plugins',    'sweet_dessert_gdpr_compliance_required_plugins');
    function sweet_dessert_gdpr_compliance_required_plugins($list=array()) {
        if (in_array('gdpr-compliance', (array)sweet_dessert_storage_get('required_plugins')))
            $list[] = array(
                'name'         => esc_html__('WP GDPR Compliance', 'sweet-dessert'),
                'slug'         => 'wp-gdpr-compliance',
                'required'     => false
            );
        return $list;
    }
}