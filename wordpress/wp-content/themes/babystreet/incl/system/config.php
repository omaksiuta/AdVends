<?php

if (!defined('BABYSTREET_IMAGES_PATH')) {
	define('BABYSTREET_IMAGES_PATH', get_template_directory_uri() . '/image/');
}

if (!defined('BABYSTREET_BACKGROUNDS_PATH')) {
	define('BABYSTREET_BACKGROUNDS_PATH', BABYSTREET_IMAGES_PATH . 'backgrounds/');
}

if (class_exists('bbPress')) {
	define('BABYSTREET_IS_BBPRESS', TRUE);
} else {
	define('BABYSTREET_IS_BBPRESS', FALSE);
}

// Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || class_exists('WooCommerce') ) {
	define('BABYSTREET_IS_WOOCOMMERCE', TRUE);
	require_once(get_template_directory() . '/incl/woocommerce-functions.php');
} else {
	define('BABYSTREET_IS_WOOCOMMERCE', FALSE);
}

if (class_exists('Tribe__Events__Main')) {
	define('BABYSTREET_IS_EVENTS', TRUE);
} else {
	define('BABYSTREET_IS_EVENTS', FALSE);
}

if (class_exists('YITH_WCWL')) {
	define('BABYSTREET_IS_WISHLIST', TRUE);
} else {
	define('BABYSTREET_IS_WISHLIST', FALSE);
}

if ( in_array( 'revslider/revslider.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || class_exists('RevSliderBase') ) {
	define('BABYSTREET_IS_REVOLUTION', TRUE);
} else {
	define('BABYSTREET_IS_REVOLUTION', FALSE);
}

// Check if WC Marketplace is active
if ( class_exists('WCMp') || function_exists('wcmp_plugin_init') ) {
	define('BABYSTREET_IS_WC_MARKETPLACE', TRUE);
} else {
	define('BABYSTREET_IS_WC_MARKETPLACE', FALSE);
}

// Check if WC Vendors is active
if ( class_exists('WC_Vendors') || function_exists('wcvendors_activate')) {
	define('BABYSTREET_IS_WC_VENDORS', TRUE);
} else {
	define('BABYSTREET_IS_WC_VENDORS', FALSE);
}

// Check if WC Vendors Pro is active
if ( class_exists('WCVendors_Pro') || function_exists('activate_wcvendors_pro') ) {
	define('BABYSTREET_IS_WC_VENDORS_PRO', TRUE);
} else {
	define('BABYSTREET_IS_WC_VENDORS_PRO', FALSE);
}

if (class_exists('Vc_Manager')) {
	define('BABYSTREET_IS_VC', TRUE);
} else {
	define('BABYSTREET_IS_VC', FALSE);
}

if (class_exists('Envato_Market')) {
	define('BABYSTREET_IS_ENVATO_MARKET', TRUE);
} else {
	define('BABYSTREET_IS_ENVATO_MARKET', FALSE);
}

// Is blank page template
global $babystreet_is_blank;
$babystreet_is_blank = false;

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if (!function_exists('babystreet_set_vc_as_theme')) {
	add_action('vc_before_init', 'babystreet_set_vc_as_theme');

	function babystreet_set_vc_as_theme() {
		vc_set_as_theme(true);
	}

}

add_action('init', 'babystreet_vc_set_cpt');
if (!function_exists('babystreet_vc_set_cpt')) {

	/**
	 * Define the post types that will use VC
	 */
	function babystreet_vc_set_cpt() {
		if (class_exists('WPBakeryVisualComposerAbstract')) {
			$list = array(
					'post',
					'page',
					'product',
					'product_variation',
					'babystreet-portfolio'
			);
			vc_set_default_editor_post_types($list);
		}
	}

}

/**
 * Include TGM-Plugin-Activation
 */
require_once(get_template_directory() . '/incl/tgm-plugin-activation/class-tgm-plugin-activation.php');

/**
 * Include Babystreet_Transfer_Content
 */
require_once(get_template_directory() . '/incl/BabystreetTransferContent.class.php');

/**
 * Include BabystreetWalker
 */
require_once(get_template_directory() . '/incl/BabystreetMegaMenu.php');

/**
 * Include BabystreetMobileMenuWalker
 */
require_once(get_template_directory() . '/incl/BabystreetMobileMenuWalker.php');

/*
 * Register theme text domain
 */
add_action('after_setup_theme', 'babystreet_lang_setup');
if (!function_exists('babystreet_lang_setup')) {

	function babystreet_lang_setup() {
		load_theme_textdomain('babystreet', get_template_directory() . '/languages');
	}

}

/**
 * Include the dynamic css
 */
require_once(get_template_directory() . '/styles/dynamic-css.php');

/**
 * Include the dynamic css for Gutenberg in the admin area
 */
require_once(get_template_directory() . '/styles/babystreet-gutenberg-dynamic-css.php');
