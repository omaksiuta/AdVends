<?php
/**
 * Sweet Dessert Framework: Registered Users
 *
 * @package	sweet_dessert
 * @since	sweet_dessert 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('sweet_dessert_users_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_users_theme_setup' );
	function sweet_dessert_users_theme_setup() {

		if ( is_admin() ) {
			// Add extra fields in the user profile
			add_action( 'show_user_profile',		'sweet_dessert_add_fields_in_user_profile' );
			add_action( 'edit_user_profile',		'sweet_dessert_add_fields_in_user_profile' );
	
			// Save / update additional fields from profile
			add_action( 'personal_options_update',	'sweet_dessert_save_fields_in_user_profile' );
			add_action( 'edit_user_profile_update',	'sweet_dessert_save_fields_in_user_profile' );
        } else {

            // Social Login support
            add_filter( 'trx_utils_filter_social_login', 'sweet_dessert_social_login');
        }

	}
}

// Return Social Login layout (if present)
if (!function_exists('sweet_dessert_social_login')) {
    function sweet_dessert_social_login($sc) {
        return sweet_dessert_get_theme_option('social_login');
    }
}

// Return (and show) user profiles links
if (!function_exists('sweet_dessert_show_user_socials')) {
	function sweet_dessert_show_user_socials($args) {
		$args = array_merge(array(
			'author_id' => 0,										// author's ID
			'allowed' => array(),									// list of allowed social
			'size' => 'small',										// icons size: tiny|small|big
			'shape' => 'square',									// icons shape: square|round
			'style' => sweet_dessert_get_theme_setting('socials_type')=='images' ? 'bg' : 'icons',	// style for show icons: icons|images|bg
			'echo' => true											// if true - show on page, else - only return as string
			), is_array($args) ? $args 
				: array('author_id' => $args));						// If send one number parameter - use it as author's ID
		$output = '';
		$upload_info = wp_upload_dir();
		$upload_url = $upload_info['baseurl'];
		$social_list = sweet_dessert_get_theme_option('social_icons');
		$list = array();
		if (is_array($social_list) && count($social_list) > 0) {
			foreach ($social_list as $soc) {
				if ($args['style'] == 'icons') {
					$parts = explode('-', $soc['icon'], 2);
					$sn = isset($parts[1]) ? $parts[1] : $soc['icon'];
				} else {
					$sn = basename($soc['icon']);
					$sn = sweet_dessert_substr($sn, 0, sweet_dessert_strrpos($sn, '.'));
					if (($pos=sweet_dessert_strrpos($sn, '_'))!==false)
						$sn = sweet_dessert_substr($sn, 0, $pos);
				}
				if (count($args['allowed'])==0 || in_array($sn, $args['allowed'])) {
					$link = get_the_author_meta('user_' . ($sn), $args['author_id']);
					if ($link) {
						$icon = $args['style']=='icons' || sweet_dessert_strpos($soc['icon'], $upload_url)!==false ? $soc['icon'] : sweet_dessert_get_socials_url(basename($soc['icon']));
						$list[] = array(
							'icon'	=> $icon,
							'url'	=> $link
						);
					}
				}
			}
		}
		if (count($list) > 0) {
			$output = '<div class="sc_socials sc_socials_size_'.esc_attr($args['size']).' sc_socials_shape_'.esc_attr($args['shape']).' sc_socials_type_' . esc_attr($args['style']) . '">' 
							. trim(sweet_dessert_prepare_socials($list, $args['style'])) 
						. '</div>';
			if ($args['echo']) sweet_dessert_show_layout($output);
		}
		return $output;
	}
}


// Save / update additional fields
if (!function_exists('sweet_dessert_save_fields_in_user_profile')) {
	function sweet_dessert_save_fields_in_user_profile( $user_id ) {
		if ( !current_user_can( 'edit_user', $user_id ) )
			return false;

		if (isset($_POST['user_position'])) 
			update_user_meta( $user_id, 'user_position', $_POST['user_position'] );
		
		$socials_type = sweet_dessert_get_theme_setting('socials_type');
		$social_list = sweet_dessert_get_theme_option('social_icons');
		if (is_array($social_list) && count($social_list) > 0) {
			foreach ($social_list as $soc) {
				if ($socials_type == 'icons') {
					$parts = explode('-', $soc['icon'], 2);
					$sn = isset($parts[1]) ? $parts[1] : $soc['icon'];
				} else {
					$sn = basename($soc['icon']);
					$sn = sweet_dessert_substr($sn, 0, sweet_dessert_strrpos($sn, '.'));
					if (($pos=sweet_dessert_strrpos($sn, '_'))!==false)
						$sn = sweet_dessert_substr($sn, 0, $pos);
				}
				if (isset($_POST['user_'.($sn)]))
					update_user_meta( $user_id, 'user_'.($sn), $_POST['user_'.($sn)] );
			}
		}
	}
}
?>