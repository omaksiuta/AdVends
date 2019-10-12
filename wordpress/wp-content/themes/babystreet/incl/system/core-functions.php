<?php
defined( 'ABSPATH' ) || exit;
/* Register Theme Features */

/* Hook into the 'after_setup_theme' action */
add_action('after_setup_theme', 'babystreet_register_theme_features');
if (!function_exists('babystreet_register_theme_features')) {

	function babystreet_register_theme_features() {

		// Add post-thumbnails support
		add_theme_support('post-thumbnails');

		// Add Content Width theme support
		if (!isset($content_width)) {
			$content_width = 1220;
		}

		// Add Feed Links theme support
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		// Add theme support for Custom Background
		$background_args = array(
				'default-color' => '',
				'default-image' => '',
				'wp-head-callback' => '_custom_background_cb',
				'admin-head-callback' => '',
				'admin-preview-callback' => '',
		);
		add_theme_support('custom-background', $background_args);

		//  Add theme suppport for aside, gallery, link, image, quote, status, video, audio, chat
		add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

		// Gutenberg
		add_theme_support( 'align-wide' );

		if (defined('BABYSTREET_IS_WOOCOMMERCE') && BABYSTREET_IS_WOOCOMMERCE) {
            // Add support for woocommerce
			add_theme_support('woocommerce');
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
        }

	}

}

// BC for title tag
if (!function_exists('_wp_render_title_tag')) {
	add_action('wp_head', 'babystreet_render_title');
	if (!function_exists('babystreet_render_title')) {

		function babystreet_render_title() {
			?>
			<title><?php wp_title('|', true, 'right'); ?></title>
			<?php
		}

	}
}

// Register top navigation menu
register_nav_menu('primary', esc_html__('Main Menu', 'babystreet'));

// Register mobile navigation menu
register_nav_menu('mobile', esc_html__('Mobile Menu', 'babystreet'));

// Register side navigation menu
register_nav_menu('secondary', esc_html__('Top Menu', 'babystreet'));

// Register footer navigation menu
register_nav_menu('tertiary', esc_html__('Footer Menu', 'babystreet'));

add_action('widgets_init', 'babystreet_register_sidebars');
if (!function_exists('babystreet_register_sidebars')) {

	/**
	 * Register sidebars
	 */
	function babystreet_register_sidebars() {
		if (function_exists('register_sidebar')) {

			// Define default sidebar
			register_sidebar(array(
					'name' => esc_html__('Default Sidebar', 'babystreet'),
					'id' => 'right_sidebar',
					'description' => esc_html__('Default Blog widget area', 'babystreet'),
					'before_widget' => '<div id="%1$s" class="widget box %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h3>',
					'after_title' => '</h3>',
			));

			// Define bottom footer widget area
			register_sidebar(array(
					'name' => esc_html__('Footer Sidebar', 'babystreet'),
					'id' => 'bottom_footer_sidebar',
					'description' => esc_html__('Footer widget area', 'babystreet'),
					'before_widget' => '<div id="%1$s" class="widget %2$s ">',
					'after_widget' => '</div>',
					'before_title' => '<h3>',
					'after_title' => '</h3>',
			));

			// Define Pre header widget area
			register_sidebar(array(
					'name' => esc_html__('Pre Header Sidebar', 'babystreet'),
					'id' => 'pre_header_sidebar',
					'description' => esc_html__('Pre header widget area', 'babystreet'),
					'before_widget' => '<div id="%1$s" class="widget %2$s ">',
					'after_widget' => '</div>',
					'before_title' => '<h3>',
					'after_title' => '</h3>',
			));

			if (BABYSTREET_IS_WOOCOMMERCE) {
				// Define shop sidebar if woocommerce is active
				register_sidebar(array(
						'name' => esc_html__('Shop Sidebar', 'babystreet'),
						'id' => 'shop',
						'description' => esc_html__('Default Shop sidebar', 'babystreet'),
						'before_widget' => '<div id="%1$s" class="widget box %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3>',
						'after_title' => '</h3>',
				));

				// Define widget area for product filters
				register_sidebar(array(
					'name' => esc_html__('Product Filters Sidebar', 'babystreet'),
					'id' => 'babystreet_product_filters_sidebar',
					'description' => esc_html__('Product filters widget area, shown on shop and product category pages', 'babystreet'),
					'before_widget' => '<div id="%1$s" class="widget box %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h3>',
					'after_title' => '</h3>',
				));
			}

			if (BABYSTREET_IS_BBPRESS) {
				// Define shop sidebar if BBpress is active
				register_sidebar(array(
						'name' => 'Forum Sidebar',
						'id' => 'babystreet_forum',
						'description' => esc_html__('Default Forum sidebar', 'babystreet'),
						'before_widget' => '<div id="%1$s" class="widget box %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3>',
						'after_title' => '</h3>',
				));
			}

			// Register the custom sidbars
			$babystreet_custom_sdbrs = substr(babystreet_get_option('sidebar_ids'), 0, -1);

			if ($babystreet_custom_sdbrs) {
				$sdbrsArr = explode(';', $babystreet_custom_sdbrs);
				foreach ($sdbrsArr as $sdbr) {
					$sdbr_id = babystreet_generate_slug($sdbr, 45);
					register_sidebar(array(
							'name' => $sdbr,
							'id' => $sdbr_id,
							'before_widget' => '<div id="%1$s" class="widget box %2$s">',
							'after_widget' => '</div>',
							'before_title' => '<h3>',
							'after_title' => '</h3>',
					));
				}
			}
		}
	}

}

add_action('tgmpa_register', 'babystreet_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
if (!function_exists('babystreet_register_required_plugins')) {

	function babystreet_register_required_plugins() {

		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
				array(
						'name' => esc_html__('Babystreet Plugin - Babystreet Theme accompanying plugin ', 'babystreet'), // The plugin name
						'slug' => 'babystreet-plugin', // The plugin slug (typically the folder name)
						'source' => get_template_directory() . '/plugins/babystreet-plugin.zip', // The plugin source
						'required' => true, // If false, the plugin is only 'recommended' instead of required
						'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
						'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
						'version' => '1.1.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				),
                array(
                        'name' => esc_html__('Envato Market - WordPress Theme & Plugin management for the Envato Market', 'babystreet'), // The plugin name
                        'slug' => 'envato-market', // The plugin slug (typically the folder name)
                        'source' => get_template_directory() . '/plugins/envato-market.zip', // The plugin source
                        'required' => false, // If false, the plugin is only 'recommended' instead of required
                        'version' => '2.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                        'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                        'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                ),
				array(
						'name' => esc_html__('WooCommerce - excelling eCommerce', 'babystreet'), // The plugin name
						'slug' => 'woocommerce', // The plugin slug (typically the folder name)
						'required' => false, // If false, the plugin is only 'recommended' instead of required
						'version' => '3.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				),
				array(
						'name' => esc_html__('YITH WooCommerce Wishlist', 'babystreet'), // The plugin name
						'slug' => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
						'required' => false, // If false, the plugin is only 'recommended' instead of required
						'version' => '2.2.13', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				),
				array(
						'name' => esc_html__('Revolution Slider', 'babystreet'), // The plugin name
						'slug' => 'revslider', // The plugin slug (typically the folder name)
						'source' => get_template_directory() . '/plugins/revslider.zip', // The plugin source
						'required' => false, // If false, the plugin is only 'recommended' instead of required
						'version' => '6.0.9', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
						'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
						'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				),
				array(
						'name' => esc_html__('WPBakery Page Builder', 'babystreet'), // The plugin name
						'slug' => 'js_composer', // The plugin slug (typically the folder name)
						'source' => get_template_directory() . '/plugins/js_composer.zip', // The plugin source
						'required' => false, // If false, the plugin is only 'recommended' instead of required
						'version' => '6.0.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
						'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
						'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				),
		);


		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
				'id' => 'babystreet', // Unique ID for hashing notices for multiple instances of TGMPA.
				'default_path' => '', // Default absolute path to bundled plugins.
				'menu' => 'tgmpa-install-plugins', // Menu slug.
				'has_notices' => true, // Show admin notices or not.
				'is_automatic' => false, // Automatically activate plugins after installation or not.
				'dismissable' => true, // If false, a user cannot dismiss the nag message.
				'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
				'message' => '', // Message to output right before the plugins table.
				'strings' => array(
						'page_title' => esc_html__('Install Required Plugins', 'babystreet'),
						'menu_title' => esc_html__('Install Plugins', 'babystreet'),
						/* translators: %s: plugin name. */
						'installing' => esc_html__('Installing Plugin: %s', 'babystreet'),
						/* translators: %s: plugin name. */
						'updating' => esc_html__('Updating Plugin: %s', 'babystreet'),
						'oops' => esc_html__('Something went wrong with the plugin API.', 'babystreet'),
						'notice_can_install_required' => _n_noop(
										/* translators: 1: plugin name(s). */
										'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'babystreet'
						),
						'notice_can_install_recommended' => _n_noop(
										/* translators: 1: plugin name(s). */
										'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'babystreet'
						),
						'notice_ask_to_update' => _n_noop(
										/* translators: 1: plugin name(s). */
										'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'babystreet'
						),
						'notice_ask_to_update_maybe' => _n_noop(
										/* translators: 1: plugin name(s). */
										'There is an update available for: %1$s. Prior update please make sure that the theme is compatible with the new version.', 'There are updates available for the following plugins: %1$s. Prior update please make sure that the theme is compatible with the new version.', 'babystreet'
						),
						'notice_can_activate_required' => _n_noop(
										/* translators: 1: plugin name(s). */
										'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'babystreet'
						),
						'notice_can_activate_recommended' => _n_noop(
										/* translators: 1: plugin name(s). */
										'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'babystreet'
						),
						'install_link' => _n_noop(
										'Begin installing plugin', 'Begin installing plugins', 'babystreet'
						),
						'update_link' => _n_noop(
										'Begin updating plugin', 'Begin updating plugins', 'babystreet'
						),
						'activate_link' => _n_noop(
										'Begin activating plugin', 'Begin activating plugins', 'babystreet'
						),
						'return' => esc_html__('Return to Required Plugins Installer', 'babystreet'),
						'plugin_activated' => esc_html__('Plugin activated successfully.', 'babystreet'),
						'activated_successfully' => esc_html__('The following plugin was activated successfully:', 'babystreet'),
						/* translators: 1: plugin name. */
						'plugin_already_active' => esc_html__('No action taken. Plugin %1$s was already active.', 'babystreet'),
						/* translators: 1: plugin name. */
						'plugin_needs_higher_version' => esc_html__('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'babystreet'),
						/* translators: 1: dashboard link. */
						'complete' => esc_html__('All plugins installed and activated successfully. %1$s', 'babystreet'),
						'dismiss' => esc_html__('Dismiss this notice', 'babystreet'),
						'notice_cannot_install_activate' => esc_html__('There are one or more required or recommended plugins to install, update or activate.', 'babystreet'),
						'contact_admin' => esc_html__('Please contact the administrator of this site for help.', 'babystreet'),
						'nag_type' => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
				),
		);

		tgmpa($plugins, $config);
	}

}

/**
 * Converts the stored id's of the images
 * to be friendly for supersized js plugin
 *
 * @param type $ids
 */
if (!function_exists('babystreet_get_supersized_image_urls')) {

	function babystreet_get_supersized_image_urls($ids) {
		$image_urls = array();

		$ids_arr = explode(';', $ids);

		if (is_array($ids_arr) && count($ids_arr)) {
			foreach ($ids_arr as $id) {
				$image_urls[] = esc_url(wp_get_attachment_url($id));
			}
		}

		return $image_urls;
	}

}

/**
 * Enqueues scripts and styles in the admin
 *
 * @param type $hook
 * @return type
 */
if (!function_exists('babystreet_enqueue_admin_js')) {

	function babystreet_enqueue_admin_js($hook) {
		wp_enqueue_style('babystreet-admin', get_template_directory_uri() . "/styles/babystreet-admin.css");
		wp_register_script('babystreet-medialibrary-uploader', BABYSTREET_OPTIONS_FRAMEWORK_DIRECTORY . 'js/babystreet-medialibrary-uploader.js', array('jquery-ui-accordion', 'media-upload'), false, true);
		wp_enqueue_script('babystreet-medialibrary-uploader');

		// wp-color-picker
		wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker', array('jquery'));
		// font-awesome
		wp_enqueue_style('font-awesome', get_template_directory_uri() . "/styles/font-awesome/css/font-awesome.min.css", array('fonticonpicker'), false, 'screen');
		// et-line-font
		wp_enqueue_style('et-line-font', get_template_directory_uri() . "/styles/et-line-font/style.css", false, false, 'screen');
		// Flaticon
		wp_enqueue_style('flaticon', get_template_directory_uri() . "/styles/flaticon/font/flaticon.css", false, false, 'screen');
		// Fonticonpicker
		wp_enqueue_script('fonticonpicker', get_template_directory_uri() . "/js/fonticonpicker/jquery.fonticonpicker.min.js", array('jquery'), false, true);
		wp_enqueue_style('fonticonpicker', get_template_directory_uri() . "/styles/fonticonpicker/css/jquery.fonticonpicker.min.css");
		wp_enqueue_style('fonticonpicker-gray-theme', get_template_directory_uri() . "/styles/fonticonpicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css", array('fonticonpicker'));
		// nice-select
		wp_enqueue_script('nice-select', get_template_directory_uri() . "/js/jquery.nice-select.min.js", array('jquery'), '1.0.0', true);
        // Backend jS
		wp_enqueue_script('babystreet-back', get_template_directory_uri() . "/js/babystreet-back.js", array('jquery', 'nice-select', 'wp-color-picker'), false, true);
		// Mega Menu script/style
		wp_enqueue_style('babystreet-mega-menu', get_template_directory_uri() . '/styles/babystreet-admin-megamenu.css');
		wp_enqueue_script('babystreet-mega-menu', get_template_directory_uri() . '/js/babystreet-admin-mega-menu.js', array('jquery', 'jquery-ui-sortable'), false, true);
	}

}
add_action('admin_enqueue_scripts', 'babystreet_enqueue_admin_js');

add_action('enqueue_block_editor_assets', 'babystreet_enqueue_gutenberg_styles');
if (!function_exists('babystreet_enqueue_gutenberg_styles')) {
	/**
	 * Enqueue the Gutenberg styles
	 */
	function babystreet_enqueue_gutenberg_styles() {
		wp_enqueue_style('babystreet_block_editor_assets', get_template_directory_uri() . "/styles/babystreet-gutenberg-styles.css");
		babystreet_typography_enqueue_google_font();
	}
}


/**
 * Checks if post has 'babystreet_super_slider_ids' meta
 * and return the supersized slider images ids.
 * If not - returns false
 *
 * @return boolean
 */
if (!function_exists('babystreet_has_post_supersized')) {

	function babystreet_has_post_supersized() {
		$image_urls = array();
		$custom = false;

		if (is_singular()) {
			$custom = get_post_custom();
		}

		if ($custom && array_key_exists('babystreet_super_slider_ids', $custom) && $custom['babystreet_super_slider_ids'][0]) {
			$ids_arr = explode(';', $custom['babystreet_super_slider_ids'][0]);

			foreach ($ids_arr as $id) {
				$image_urls[] = wp_get_attachment_url($id);
			}

			return $image_urls;
		}

		return false;
	}

}

/**
 * Checks if post has 'babystreet_video_bckgr_url' meta
 * and return the custom fields.
 * If not - returns false
 *
 * @return boolean
 */
if (!function_exists('babystreet_has_post_video_bckgr')) {

	function babystreet_has_post_video_bckgr() {

		$custom = false;

		if (is_singular()) {
			$custom = get_post_custom();
		}

		if ($custom && array_key_exists('babystreet_video_bckgr_url', $custom) && $custom['babystreet_video_bckgr_url'][0]) {
			return $custom;
		}

		return false;
	}

}

/**
 * Used to generate slugs
 * Used mainly for custom sidebars
 *
 * @param String $phrase
 * @param Integer $maxLength
 * @return String
 */
if (!function_exists('babystreet_generate_slug')) {

	function babystreet_generate_slug($phrase, $maxLength) {
		$result = strtolower($phrase);

		$result = preg_replace("/[^a-z0-9\s-]/", "", $result);
		$result = trim(preg_replace("/[\s-]+/", " ", $result));
		$result = trim(substr($result, 0, $maxLength));
		$result = preg_replace("/\s/", "-", $result);

		return $result;
	}

}

/**
 * Returns string with links to all parent taxonomies
 */
if (!function_exists('babystreet_get_taxonomy_parents')) {

	function babystreet_get_taxonomy_parents($id, $taxonomy, $link = false, $separator = '/', $nicename = false, $visited = array()) {
		$chain = '';
		$parent = get_term($id, $taxonomy);
		if (is_wp_error($parent))
			return $parent;

		if ($nicename)
			$name = $parent->slug;
		else
			$name = $parent->name;

		if ($parent->parent && ( $parent->parent != $parent->term_id ) && !in_array($parent->parent, $visited)) {
			$visited[] = $parent->parent;
			$chain .= babystreet_get_taxonomy_parents($parent->parent, $taxonomy, $link, $separator, $nicename, $visited);
		}

		if ($link) {
			$term_link = get_term_link($parent, $taxonomy);
			$chain .= '<a href="' . esc_url($term_link) . '">' . $name . '</a>' . $separator;
		} else
			$chain .= $name . $separator;
		return $chain;
	}

}

if (!function_exists('babystreet_get_more_featured_images')) {

	/**
	 * Get custom featured images by post_id
	 *
	 * @param int $post_id
	 * @return array of custom featured images. If not - empty array
	 */
	function babystreet_get_more_featured_images($post_id) {
		$featured_imgs = array();
		$post_meta = get_post_meta($post_id);

		for ($i = 2; $i <= 6; $i++) {
			if (isset($post_meta['babystreet_featured_imgid_' . $i][0]) && $post_meta['babystreet_featured_imgid_' . $i][0]) {
				$featured_imgs['babystreet_featured_imgid_' . $i] = $post_meta['babystreet_featured_imgid_' . $i][0];
			}
		}

		return $featured_imgs;
	}

}

if (!function_exists('babystreet_wp_lang_to_valid_language_code')) {

	function babystreet_wp_lang_to_valid_language_code($wp_lang) {
		$wp_lang = str_replace('_', '-', $wp_lang);
		switch (strtolower($wp_lang)) {
			// arabic
			case 'ar':
			case 'ar-ae':
			case 'ar-bh':
			case 'ar-dz':
			case 'ar-eg':
			case 'ar-iq':
			case 'ar-jo':
			case 'ar-kw':
			case 'ar-lb':
			case 'ar-ly':
			case 'ar-ma':
			case 'ar-om':
			case 'ar-qa':
			case 'ar-sa':
			case 'ar-sy':
			case 'ar-tn':
			case 'ar-ye': return 'ar';

			// bulgarian
			case 'bg':
			case 'bg-bg': return 'bg';

			// bosnian
			case 'bs':
			case 'bs-ba': return 'bs';

			// catalan
			case 'ca':
			case 'ca-es': return 'ca';

			// czech
			case 'cs':
			case 'cs-cz': return 'cs';

			case 'cy': return 'cy';

			// danish
			case 'da':
			case 'da-dk': return 'da';

			// german
			case 'de':
			case 'de-at':
			case 'de-ch':
			case 'de-de':
			case 'de-li':
			case 'de-lu': return 'de';

			// greek
			case 'el':
			case 'el-gr': return 'el';

			// spanish
			case 'es':
			case 'es-ar':
			case 'es-bo':
			case 'es-cl':
			case 'es-co':
			case 'es-cr':
			case 'es-do':
			case 'es-ec':
			case 'es-es':
			case 'es-es':
			case 'es-gt':
			case 'es-hn':
			case 'es-mx':
			case 'es-ni':
			case 'es-pa':
			case 'es-pe':
			case 'es-pr':
			case 'es-py':
			case 'es-sv':
			case 'es-uy':
			case 'es-ve': return 'es';

			// estonian
			case 'et':
			case 'et-ee': return 'et';

			// farsi/persian
			case 'fa':
			case 'fa fa-ir': return 'fa';

			// finnish
			case 'fi':
			case 'fi-fi': return 'fi';

			// french
			case 'fr':
			case 'fr-be':
			case 'fr-ca':
			case 'fr-ch':
			case 'fr-fr':
			case 'fr-lu':
			case 'fr-mc': return 'fr';

			// galician
			case 'gl':
			case 'gl-es': return 'gl';

			// gujarati
			case 'gu':
			case 'gu-in': return 'gu';

			// hebrew
			case 'he':
			case 'he-il': return 'he';

			// croatian
			case 'hr':
			case 'hr-ba':
			case 'hr-hr': return 'hr';

			// hungarian
			case 'hu':
			case 'hu-hu': return 'hu';

			// armenian
			case 'hy':
			case 'hy-am': return 'hy';

			// indonesian
			case 'id':
			case 'id-id': return 'id';

			// italian
			case 'it':
			case 'it-ch':
			case 'it-it': return 'it';

			// japanese
			case 'ja':
			case 'ja-jp': return 'ja';

			// kannada
			case 'kn':
			case 'kn-in': return 'kn';

			// korean
			case 'ko':
			case 'ko-kr': return 'ko';

			// lithuanian
			case 'lt':
			case 'lt-lt': return 'lt';

			// latvian
			case 'lv':
			case 'lv-lv': return 'lv';

			// malay
			case 'ms':
			case 'ms-bn':
			case 'ms-my': return 'ms';

			// burmese
			case 'my': return 'my';

			// norwegian
			case 'nb':
			case 'nb-no': return 'nb';

			// dutch
			case 'nl':
			case 'nl-be':
			case 'nl-nl': return 'nl';

			// polish
			case 'pl':
			case 'pl-pl': return 'pl';

			// portuguese
			case 'pt':
			case 'pt-br':
			case 'pt-pt': return 'pt-br';

			// romanian
			case 'ro':
			case 'ro-ro': return 'ro';

			// russian
			case 'ru':
			case 'ru-ru': return 'ru';

			// slovak
			case 'sk':
			case 'sk-sk': return 'sk';

			// slovenian
			case 'sl':
			case 'sl-si': return 'sl';

			// albanian
			case 'sq':
			case 'sq-al': return 'sq';

			// serbian
			case 'sr-ba':
			case 'sr-sp':
			case 'sr-sr': return 'sr-sr';

			// swedish
			case 'sv':
			case 'sv-fi':
			case 'sv-se': return 'sv';

			// thai
			case 'th':
			case 'th-th': return 'th';

			// turkish
			case 'tr':
			case 'tr-tr': return 'tr';

			// ukranian
			case 'uk':
			case 'uk-ua': return 'uk';

			// urdu
			case 'ur':
			case 'ur-pk': return 'ur';

			// uzbek
			case 'uz':
			case 'uz-uz': return 'uz';

			// vietnamese
			case 'vi':
			case 'vi-vn': return 'vi';

			// chinese/simplified
			case 'zh-cn': return 'zh-cn';

			// chinese/traditional
			case 'zh':
			case 'zh-hk':
			case 'zh-mo':
			case 'zh-sg':
			case 'zh-tw': return 'zh-tw';

			/* these don't exist and have no real language code? */

			// malaylam
			case 'ml': return 'ml';

			// assume english
			default: return '';
		}
	}

}

/**
 * Checks font options to see if a Google font is selected.
 * If so, builds an url to enqueue the styles
 */
if (!function_exists('babystreet_typography_google_fonts_url')) {

	function babystreet_typography_google_fonts_url() {

		$font_families = array();

		/* Translators: If there are characters in your language that are not
		 * supported by that font, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ('off' !== _x('on', 'Google fonts: on or off', 'babystreet')) {
			$all_google_fonts = array_keys(babystreet_typography_get_google_fonts());

			// Define all the options that possibly have a unique Google font
			$body_font = babystreet_get_option('body_font');
			$headings_font = babystreet_get_option('headings_font');

			// Get the font face for each option and put it in an array
			$selected_fonts = array(
					$body_font['face'],
					$headings_font['face']);

			// Remove any duplicates in the list
			$selected_fonts = array_unique($selected_fonts);

			// Check each of the unique fonts against the defined Google fonts
			// If it is a Google font, go ahead and call the function to enqueue it
			foreach ($selected_fonts as $font) {
				if (in_array($font, $all_google_fonts)) {
					$font_families[] = $font;
				}
			}
		}

		$font_url = '';

		if (!empty($font_families)) {
			$font_families_string_to_encode = implode('|', $font_families);
			$font_url = add_query_arg('family', urlencode($font_families_string_to_encode . ':100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&subset=' . babystreet_get_google_subsets()), "//fonts.googleapis.com/css");
		}

		return $font_url;
	}

}
add_action('wp_enqueue_scripts', 'babystreet_typography_enqueue_google_font');
add_action('admin_enqueue_scripts', 'babystreet_typography_enqueue_google_font');

/**
 * Enqueues the Google $font that is passed
 */
function babystreet_typography_enqueue_google_font() {
	wp_enqueue_style('babystreet-fonts', babystreet_typography_google_fonts_url(), array(), '1.0.0');
}

/**
 * Register / Enqueue theme scripts
 */
add_action('wp_enqueue_scripts', 'babystreet_enqueue_scripts_and_styles');
if (!function_exists('babystreet_enqueue_scripts_and_styles')) {

	function babystreet_enqueue_scripts_and_styles() {

		// Preloader style
		if (babystreet_get_option('show_preloader')) {
			wp_enqueue_style('babystreet-preloader', get_template_directory_uri() . "/styles/babystreet-preloader.css");
		}

		// Load the main stylesheet.
		wp_enqueue_style('babystreet-style', get_stylesheet_uri());

		// Load the responsive stylesheet if enabled
		if (babystreet_get_option('is_responsive')) {
			wp_enqueue_style('babystreet-responsive', get_template_directory_uri() . "/styles/babystreet-responsive.css", array('babystreet-style'));
		}

		wp_enqueue_style('font-awesome', get_template_directory_uri() . "/styles/font-awesome/css/font-awesome.min.css");
		wp_enqueue_style('et-line-font', get_template_directory_uri() . "/styles/et-line-font/style.css");
		// Flaticon
		wp_enqueue_style('flaticon', get_template_directory_uri() . "/styles/flaticon/font/flaticon.css", false, false, 'screen');

		// Modernizr
		wp_enqueue_script('modernizr', get_template_directory_uri() . "/js/modernizr.custom.js", array('jquery'));

		// nicescroll
		wp_enqueue_script('nicescroll', get_template_directory_uri() . "/js/jquery.nicescroll/jquery.nicescroll.min.js", array('jquery'), '3.7.6', true);

		/* loading jquery-ui-slider only for price filter */
		if (BABYSTREET_IS_WOOCOMMERCE && babystreet_get_option('show_pricefilter') && is_woocommerce() && !is_product()) {
			wp_enqueue_script('jquery-ui-slider');
		}

		$cart_redirect_after_add = 'no';
		$cart_url                = '';
		if ( BABYSTREET_IS_WOOCOMMERCE && get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
			$cart_redirect_after_add = 'yes';
			$cart_url                = apply_filters( 'woocommerce_add_to_cart_redirect', wc_get_cart_url() );
		}

		$enable_ajax_add_to_cart = 'no';
		if ( BABYSTREET_IS_WOOCOMMERCE && babystreet_get_option('ajax_to_cart_single') ) {
			$enable_ajax_add_to_cart = 'yes';
		}

		$enable_infinite_on_shop = 'no';
		if ( BABYSTREET_IS_WOOCOMMERCE && babystreet_get_option( 'enable_shop_infinite' ) ) {
			$enable_infinite_on_shop = 'yes';
		}

		$use_load_more_on_shop = 'no';
		if ( BABYSTREET_IS_WOOCOMMERCE && babystreet_get_option( 'use_load_more_on_shop' ) ) {
			$use_load_more_on_shop = 'yes';
		}

		$use_product_filter_ajax = 'no';
		if ( BABYSTREET_IS_WOOCOMMERCE && babystreet_get_option( 'use_product_filter_ajax' ) ) {
			$use_product_filter_ajax = 'yes';
		}

		$categories_fancy = 'no';
		if ( BABYSTREET_IS_WOOCOMMERCE && babystreet_get_option( 'categories_fancy' ) ) {
			$categories_fancy = 'yes';
		}

		$babystreet_front_deps = array('jquery', 'jquery-ui-tabs', 'nicescroll');
		if(BABYSTREET_IS_VC) {
			$babystreet_front_deps[] = 'wpb_composer_front_js';
        }

		wp_enqueue_script('babystreet-front', get_template_directory_uri() . "/js/babystreet-front.js", $babystreet_front_deps, false, true);
		wp_localize_script('babystreet-front', 'babystreet_main_js_params', array(
				'img_path' => esc_js(BABYSTREET_IMAGES_PATH),
				'admin_url' => esc_js(admin_url('admin-ajax.php')),
				'product_label' =>  esc_js(__('Product', 'babystreet')),
				'added_to_cart_label' => esc_js(__('was added to the cart', 'babystreet')),
				'show_preloader' => esc_js(babystreet_get_option('show_preloader')),
				'sticky_header' => esc_js(babystreet_get_option('sticky_header')),
				'enable_smooth_scroll' => esc_js(babystreet_get_option('enable_smooth_scroll')),
				'login_label' => esc_js(__('Login', 'babystreet')),
				'register_label' => esc_js(__('Register', 'babystreet')),
				'cart_redirect_after_add' => $cart_redirect_after_add,
				'cart_url' => $cart_url,
				'enable_ajax_add_to_cart' => $enable_ajax_add_to_cart,
				'enable_infinite_on_shop' => $enable_infinite_on_shop,
				'use_load_more_on_shop' => $use_load_more_on_shop,
				'use_product_filter_ajax' => $use_product_filter_ajax,
			    'categories_fancy' => $categories_fancy,
				'is_rtl' => (is_rtl() ? 'true' : 'false')
		));

		/* imagesloaded */
		wp_enqueue_script('imagesloaded', '',array('jquery'), false, true);

		// flexslider
		wp_enqueue_script('flexslider', get_template_directory_uri() . "/js/flex/jquery.flexslider-min.js", array('jquery'), '2.2.2', true);
		wp_enqueue_style('flexslider', get_template_directory_uri() . "/styles/flex/flexslider.css", array(), '2.2.2');

		// owl-carousel
		wp_enqueue_script('owl-carousel', get_template_directory_uri() . "/js/owl-carousel2-dist/owl.carousel.min.js", array('jquery'), '2.0.0', true);
		wp_enqueue_style('owl-carousel', get_template_directory_uri() . "/styles/owl-carousel2-dist/assets/owl.carousel.min.css", array(), '2.0.0');
		wp_enqueue_style('owl-carousel-theme-default', get_template_directory_uri() . "/styles/owl-carousel2-dist/assets/owl.theme.default.min.css", array(), '2.0.0');
		wp_enqueue_style('owl-carousel-animate', get_template_directory_uri() . "/styles/owl-carousel2-dist/assets/animate.css", array(), '2.0.0');

		// cloud-zoom
		wp_enqueue_script('cloud-zoom', get_template_directory_uri() . "/js/cloud-zoom/cloud-zoom.1.0.2.min.js", array('jquery'), '1.0.2', true);
		wp_enqueue_style('cloud-zoom', get_template_directory_uri() . "/styles/cloud-zoom/cloud-zoom.css", array(), '1.0.2');

		// countdown
		wp_enqueue_script('countdown', get_template_directory_uri() . "/js/count/jquery.countdown.min.js", array('jquery'), '2.0.0', true);

        // magnific
		wp_enqueue_script('magnific', get_template_directory_uri() . "/js/magnific/jquery.magnific-popup.min.js", array('jquery'), '1.0.0', true);
		wp_enqueue_style('magnific', get_template_directory_uri() . "/styles/magnific/magnific-popup.css", array(), '1.0.2');

		// appear
		wp_enqueue_script('appear', get_template_directory_uri() . "/js/jquery.appear.min.js", array('jquery'), '1.0.0', true);

		// appear
		wp_enqueue_script('typed', get_template_directory_uri() . "/js/typed.min.js", array('jquery'), '1.0.0', true);

		// nice-select
		wp_enqueue_script('nice-select', get_template_directory_uri() . "/js/jquery.nice-select.min.js", array('jquery'), '1.0.0', true);

		// is-in-viewport
		wp_enqueue_script('is-in-viewport', get_template_directory_uri() . "/js/isInViewport.min.js", array('jquery'), '1.0.0', true);

		// Mega Menu script/style
		wp_register_style('babystreet-mega-menu', get_template_directory_uri() . '/styles/babystreet-admin-megamenu.css');
		wp_register_script('babystreet-mega-menu', get_template_directory_uri() . '/js/babystreet-admin-mega-menu.js', array('jquery', 'jquery-ui-sortable'), false, true);

		// register Isotope
		wp_register_script('isotope', get_template_directory_uri() . "/js/isotope/dist/isotope.pkgd.min.js", array('jquery', 'imagesloaded'), false, true);
		if ( is_post_type_archive( 'babystreet-portfolio' ) || is_tax( 'babystreet_portfolio_category' ) || ( babystreet_get_option( 'general_blog_style' ) === 'babystreet_blog_masonry' && ( is_archive() || is_category() || babystreet_is_blog() ) ) ) {
			// load Isotope
			wp_enqueue_script( 'isotope' );
		}

		// enqueue google map api
		wp_register_script('google-maps', 'https://maps.googleapis.com/maps/api/js?'.( babystreet_get_option('google_maps_api_key') ? 'key='.babystreet_get_option('google_maps_api_key').'&' : '' ).'sensor=false', array('jquery'), false, true);

		$babystreet_local = babystreet_wp_lang_to_valid_language_code(get_locale());
		if ($babystreet_local) {
			wp_enqueue_script('jquery-countdown-local', get_template_directory_uri() . "/js/count/jquery.countdown-$babystreet_local.js", array('jquery', 'countdown'), false, true);
		}

		$is_compare = false;
		if (isset($_GET['action']) && $_GET['action'] === 'yith-woocompare-view-table') {
			$is_compare = true;
		}

		$to_include_supersized = babystreet_has_to_include_supersized($is_compare);
		$to_include_backgr_video = babystreet_has_to_include_backgr_video($is_compare);

		/* JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if (is_singular() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}

		/* Include js configs */
		wp_enqueue_script('babystreet-libs-config', get_template_directory_uri() . "/js/babystreet-libs-config.min.js", array('jquery', 'wp-util', 'flexslider', 'owl-carousel', 'cloud-zoom', 'countdown', 'magnific', 'appear', 'typed', 'nice-select', 'is-in-viewport' ), false, true);

		// send is_rtl to js for owl carousel
		wp_localize_script( 'babystreet-libs-config', 'babystreet_rtl',
			array(
				'is_rtl' => ( is_rtl() ? 'true' : 'false' )
			) );

		if ( BABYSTREET_IS_WOOCOMMERCE && babystreet_get_option( 'use_quickview' ) ) {
			wp_localize_script( 'babystreet-libs-config', 'babystreet_quickview',
				array(
					'babystreet_ajax_url' => esc_js( admin_url( 'admin-ajax.php' ) ),
					'wc_ajax_url'                      => WC_AJAX::get_endpoint( "%%endpoint%%" ),
					'i18n_no_matching_variations_text' => esc_attr__( 'Sorry, no products matched your selection. Please choose a different combination.', 'babystreet' ),
					'i18n_make_a_selection_text'       => esc_attr__( 'Please select some product options before adding this product to your cart.', 'babystreet' ),
					'i18n_unavailable_text'            => esc_attr__( 'Sorry, this product is unavailable. Please choose a different combination.', 'babystreet' ),
				) );
		}

		$search_options = babystreet_get_option('search_options');
		if (babystreet_get_option('show_searchform') && $search_options['use_ajax']) {
			wp_localize_script('babystreet-libs-config', 'babystreet_ajax_search', array(
					'include' => 'true'
			));
		}

		if (BABYSTREET_IS_WOOCOMMERCE && is_product()) {
			wp_localize_script('babystreet-libs-config', 'babystreet_variation_prod_cloudzoom', array(
					'include' => 'true',
			));
		}

		// Register video background plugin
		wp_register_style('ytplayer', get_template_directory_uri() . "/styles/jquery.mb.YTPlayer/css/jquery.mb.YTPlayer.min.css");
		wp_register_script('ytplayer', get_template_directory_uri() . "/js/jquery.mb.YTPlayer/jquery.mb.YTPlayer.min.js", array('jquery'), '3.2.5', true);

		// Load video background plugin
		if ($to_include_backgr_video) {
			wp_enqueue_style('ytplayer');
			wp_enqueue_script('ytplayer');
			wp_localize_script('babystreet-libs-config', 'babystreet_ytplayer_conf', array(
					'include' => 'true',
			));
			// Load supersized plugin if a slider is set up
		} elseif ($to_include_supersized) {
			wp_enqueue_style('supersized', get_template_directory_uri() . "/styles/supersized/css/supersized.css");
			wp_enqueue_script('supersized-min', get_template_directory_uri() . "/js/supersized/js/supersized.3.2.7.min.js", array('jquery'), '3.2.7', true);
			if ($to_include_supersized == 'postmeta') {
				wp_localize_script('babystreet-libs-config', 'babystreet_supersized_conf', array(
						'images' => babystreet_has_post_supersized(),
				));
			} elseif ($to_include_supersized == 'global') {
				wp_localize_script('babystreet-libs-config', 'babystreet_supersized_conf', array(
						'images' => babystreet_get_supersized_image_urls(esc_attr(babystreet_get_option('supersized_images'))),
				));
			} elseif ($to_include_supersized == 'blog') {
				wp_localize_script('babystreet-libs-config', 'babystreet_supersized_conf', array(
						'images' => babystreet_get_supersized_image_urls(esc_attr(babystreet_get_option('blog_supersized_images'))),
				));
			} elseif (in_array($to_include_supersized, array('shop', 'shopwide'))) {
				wp_localize_script('babystreet-libs-config', 'babystreet_supersized_conf', array(
						'images' => babystreet_get_supersized_image_urls(esc_attr(babystreet_get_option('shop_supersized_images'))),
				));
			}
		}
	}

}

if (!function_exists('babystreet_generate_excerpt')) {

	/**
	 * Return excerpt
	 *
	 * @param string $input	input to truncate
	 * @param number $limit	 number of chars to reach to tuncate
	 * @param string $break
	 * @param string $more more string
	 * @param boolean $strip_it strip tags
	 * @param string $exclude exclude tags
	 * @param boolean $safe_truncate use mb_strimwidth()
	 * @return string the generated excerpt
	 */
	function babystreet_generate_excerpt($input, $limit, $break = ".", $more = "...", $strip_it = false, $exclude = '<strong><em><span>', $safe_truncate = false) {
		if ($strip_it) {
			$input = strip_shortcodes(strip_tags($input, $exclude));
		}

		if (strlen($input) <= $limit) {
			return $input;
		}

		$breakpoint = strpos($input, $break, $limit);

		if ($breakpoint != false) {
			if ($breakpoint < strlen($input) - 1) {
				if ($safe_truncate || is_rtl()) {
					$input = mb_strimwidth($input, 0, $breakpoint) . $more;
				} else {
					$input = substr($input, 0, $breakpoint) . $more;
				}
			}
		}

		// prevent accidental word break
		if (!$breakpoint && strlen(strip_tags($input)) == strlen($input)) {
			if ($safe_truncate || is_rtl()) {
				$input = mb_strimwidth($input, 0, $limit) . $more;
			} else {
				$input = substr($input, 0, $limit) . $more;
			}
		}

		return $input;
	}

}

if (!function_exists('babystreet_get_option')) {

	/**
	 * Get Option.
	 *
	 * The function is in use
	 * This should be starting point when implementing skins
	 */
	function babystreet_get_option($name, $default = false) {

		$option_name = 'babystreet';

		// In case the option is in url return that value
		if ( array_key_exists( $name, $_GET ) ) {
			return esc_attr( $_GET[ $name ] );
		}

        // else get it from stored options
		if (get_option($option_name)) {
			$options = get_option($option_name);
		}

		if (isset($options) && isset($options[$name])) {
			return $options[$name];
		} else {
			if($default) {
				return $default;
			}

			$all_options_def = babystreet_get_default_values();
			if (is_array($all_options_def) && isset($all_options_def[$name])) {
				return $all_options_def[$name];
			} else {
				return false;
			}
		}
	}

}

if (!function_exists('babystreet_has_to_include_supersized')) {

	/**
	 * Checks if supersized js plugin has to be included
	 * and returns the places that is should appear, or
	 * false if not.
	 *
	 * @global type $post
	 * @param type $is_compare
	 * @return string|boolean
	 */
	function babystreet_has_to_include_supersized($is_compare = false) {

		if (!$is_compare) {
			// The post has supersized
			if (babystreet_has_post_supersized()) {
				return 'postmeta';
				// If is blog page and supersized is set
			} elseif (babystreet_is_blog() && babystreet_get_option('show_blog_super_gallery') && babystreet_get_option('blog_supersized_images')) {
				return 'blog';
				// If is shopwide
			} elseif (BABYSTREET_IS_WOOCOMMERCE && is_woocommerce() && babystreet_get_option('show_shop_super_gallery') && babystreet_get_option('shopwide_super_gallery') && babystreet_get_option('shop_supersized_images')) {
				return 'shopwide';
				// If is shop page and supersized is set
			} elseif (BABYSTREET_IS_WOOCOMMERCE && is_shop() && babystreet_get_option('show_shop_super_gallery') && babystreet_get_option('shop_supersized_images')) {
				return 'shop';
				// If Global supersized is set
			} elseif (babystreet_get_option('show_super_gallery') && babystreet_get_option('supersized_images')) {
				return 'global';
			}
		}

		return false;
	}

}

if (!function_exists('babystreet_has_to_include_backgr_video')) {

	/**
	 * Checks if video background js plugin has to be included
	 * and returns the places that is should appear, or
	 * false if not.
	 *
	 * @global type $post
	 * @param type $is_compare
	 * @return string|boolean
	 */
	function babystreet_has_to_include_backgr_video($is_compare = false) {

		// The post has video background
		if (babystreet_has_post_video_bckgr()) {
			return 'postmeta';
			// If is blog page and video background is set
		} elseif (babystreet_is_blog() && babystreet_get_option('show_blog_video_bckgr') && babystreet_get_option('blog_video_bckgr_url')) {
			return 'blog';
			// If is shopwide
		} elseif (!$is_compare && BABYSTREET_IS_WOOCOMMERCE && is_woocommerce() && babystreet_get_option('show_shop_video_bckgr') && babystreet_get_option('shopwide_video_bckgr') && babystreet_get_option('shop_video_bckgr_url')) {
			return 'shopwide';
			// If is shop page and video background is set
		} elseif (!$is_compare && BABYSTREET_IS_WOOCOMMERCE && is_shop() && babystreet_get_option('show_shop_video_bckgr') && babystreet_get_option('shop_video_bckgr_url')) {
			return 'shop';
			// If Global video background is set
		} elseif (!$is_compare && babystreet_get_option('show_video_bckgr') && babystreet_get_option('video_bckgr_url')) {
			return 'global';
		}

		return false;
	}

}

if (!function_exists('babystreet_is_blog')) {

	/**
	 * Return true if this is the Blog page
	 * @return boolean
	 */
	function babystreet_is_blog() {

		if (is_front_page() && is_home()) {
			return false;
		} elseif (is_front_page()) {
			return false;
		} elseif (is_home()) {
			// BLOG - return true
			return true;
		} else {
			return false;
		}
	}

}

add_action('after_switch_theme', 'babystreet_redirect_to_options', 99);
if (!function_exists('babystreet_redirect_to_options')) {

	// Redirect to theme options on theme activation
	function babystreet_redirect_to_options() {
		wp_redirect(admin_url("themes.php?page=babystreet-optionsframework"));
	}

}

add_action('init', 'babystreet_mega_menu_init');
if (!function_exists('babystreet_mega_menu_init')) {

	// Initialise BabystreetMegaMenu class
	function babystreet_mega_menu_init() {
		$init_mega_menu = new BabystreetMegaMenu();
	}

}

add_filter('wp_nav_menu_args', 'babystreet_set_menu_on_primary');
if (!function_exists('babystreet_set_menu_on_primary')) {

	/**
	 * Set selected menu for 'top_menu' location
	 *
	 * @param Array $args
	 * @return Array
	 */
	function babystreet_set_menu_on_primary($args) {
		if ($args['theme_location'] === 'primary') {
			if (babystreet_is_blog()) {
				return babystreet_set_menu_on_primary_helper($args, babystreet_get_option('blog_top_menu'));
			}
			if (BABYSTREET_IS_WOOCOMMERCE && is_shop()) {
				return babystreet_set_menu_on_primary_helper($args, babystreet_get_option('shop_top_menu'));
			}
			if (BABYSTREET_IS_BBPRESS && bbp_is_forum_archive()) {
				return babystreet_set_menu_on_primary_helper($args, babystreet_get_option('forum_top_menu'));
			}
			if (BABYSTREET_IS_EVENTS) {
				$mode_and_title = babystreet_get_current_events_display_mode_and_title();
				$events_mode = $mode_and_title['display_mode'];
				if(in_array($events_mode, array('MAIN_CALENDAR', 'CALENDAR_CATEGORY', 'MAIN_EVENTS', 'CATEGORY_EVENTS', 'SINGLE_EVENT_DAYS'))) {
					return babystreet_set_menu_on_primary_helper( $args, babystreet_get_option( 'events_top_menu' ) );
				}
			}

			$chosen_menu = get_post_meta(get_the_ID(), 'babystreet_top_menu', true);
			return babystreet_set_menu_on_primary_helper($args, $chosen_menu);
		} else {
			return $args;
		}
	}

}

if (!function_exists('babystreet_set_menu_on_primary_helper')) {

	/**
	 * Helper
	 *
	 * @param array $args
	 * @param string $chosen_menu
	 * @return string
	 */
	function babystreet_set_menu_on_primary_helper($args, $chosen_menu) {
		if ('default' === $chosen_menu) {
			return $args;
		} else if ('none' === $chosen_menu) {
			$args['theme_location'] = 'babystreet_none_existing_location';
			return $args;
		} else {
			$args['menu'] = (int) $chosen_menu;
			return $args;
		}
	}

}
/*
 * Check for sidebar
 */
add_filter('babystreet_has_sidebar', 'babystreet_check_for_sidebar');
if (!function_exists('babystreet_check_for_sidebar')) {

	function babystreet_check_for_sidebar() {

		$options = array();
		$is_cat_tag_tax_archive = false;

		if (is_category() || is_tag() || is_tax() || is_archive() || is_search() || (is_home())) {
			$is_cat_tag_tax_archive = true;
		}

		$blog_categoty_sidebar = babystreet_get_option('blog_categoty_sidebar');
		$portfolio_categoty_sidebar = babystreet_get_option('portfolio_categoty_sidebar');

		if (BABYSTREET_IS_WOOCOMMERCE) {
			$woocommerce_sidebar = babystreet_get_option('woocommerce_sidebar');
		}

		if (BABYSTREET_IS_BBPRESS) {
			$bbpress_sidebar = babystreet_get_option('bbpress_sidebar');
		}

		if(BABYSTREET_IS_EVENTS) {
			$events_sidebar = babystreet_get_option('events_sidebar');
		}

		if (is_single() || is_page()) {
			$options = get_post_custom(get_queried_object_id());
		}

		$show_sidebar_from_meta = 'yes';
		if (isset($options['babystreet_show_sidebar']) && trim($options['babystreet_show_sidebar'][0]) != '') {
			$show_sidebar_from_meta = $options['babystreet_show_sidebar'][0];
		}

		$sidebar_choice = 'none';

		if (BABYSTREET_IS_WOOCOMMERCE && is_woocommerce() && isset($woocommerce_sidebar)) {
			$sidebar_choice = $woocommerce_sidebar;
		} elseif (BABYSTREET_IS_BBPRESS && is_bbpress() && isset($bbpress_sidebar) && (empty($options) || (isset($options['babystreet_custom_sidebar']) && $options['babystreet_custom_sidebar'][0] == 'default' && $show_sidebar_from_meta == 'yes'))) {
			$sidebar_choice = $bbpress_sidebar;
		} elseif ( BABYSTREET_IS_EVENTS && babystreet_is_events_part() && isset($events_sidebar) && ( empty($options) || ( isset($options['babystreet_custom_sidebar']) && $options['babystreet_custom_sidebar'][0] == 'default' && $show_sidebar_from_meta == 'yes'))) {
			$sidebar_choice = $events_sidebar;
		} elseif (is_tax('babystreet_portfolio_category') || is_post_type_archive('babystreet-portfolio')) {
			$sidebar_choice = $portfolio_categoty_sidebar;
		} elseif ($is_cat_tag_tax_archive) {
			$sidebar_choice = $blog_categoty_sidebar;
		} elseif (isset($options['babystreet_custom_sidebar']) && $show_sidebar_from_meta == 'yes') {
			if ($options['babystreet_custom_sidebar'][0] == 'default') {
				$sidebar_choice = 'right_sidebar';
			} else {
				$sidebar_choice = $options['babystreet_custom_sidebar'][0];
			}
		} else {
			$sidebar_choice = 'none';
		}

		return $sidebar_choice;
	}

}

/*
 * Check for sidebar
 */
add_filter('babystreet_has_offcanvas_sidebar', 'babystreet_check_for_offcanvas_sidebar');
if (!function_exists('babystreet_check_for_offcanvas_sidebar')) {

	function babystreet_check_for_offcanvas_sidebar() {
		$meta_options = array();
		if (is_single() || is_page()) {
			$meta_options = get_post_custom(get_queried_object_id());
		}

		if (isset($meta_options['babystreet_show_offcanvas_sidebar']) && trim($meta_options['babystreet_show_offcanvas_sidebar'][0]) === 'no') {
			return 'none';
		}

		$offcanvas_sidebar_choice = babystreet_get_option('offcanvas_sidebar');
		if (isset($meta_options['babystreet_custom_offcanvas_sidebar']) && $meta_options['babystreet_custom_offcanvas_sidebar'][0] !== 'default') {
			$offcanvas_sidebar_choice = $meta_options['babystreet_custom_offcanvas_sidebar'][0];
		}

		return $offcanvas_sidebar_choice;
	}

}

add_filter('babystreet_left_sidebar_position_class', 'babystreet_check_for_sidebar_position');
if (!function_exists('babystreet_check_for_sidebar_position')) {

	/**
	 * Check position of sidebar
	 *
	 * @return string - Empty string for left and the class name for right
	 */
	function babystreet_check_for_sidebar_position() {
		$meta_options = array();
		if (is_single() || is_page()) {
			$meta_options = get_post_custom(get_queried_object_id());
		}

		$sidebar_position = babystreet_get_option('sidebar_position');
		if (isset($meta_options['babystreet_sidebar_position']) && $meta_options['babystreet_sidebar_position'][0] !== 'default') {
			$sidebar_position = $meta_options['babystreet_sidebar_position'][0];
		}

		if ( defined( 'BABYSTREET_IS_WOOCOMMERCE' ) && BABYSTREET_IS_WOOCOMMERCE && is_woocommerce() ) {
			if ( ! is_product() && babystreet_get_option( 'shop_sidebar_position' ) !== 'default' ) {
				$sidebar_position = babystreet_get_option( 'shop_sidebar_position' );
			} elseif ( is_product() && babystreet_get_option( 'product_sidebar_position' ) !== 'default' ) {
				$sidebar_position = babystreet_get_option( 'product_sidebar_position' );
			}
		} elseif ( babystreet_get_option( 'blog_sidebar_position' ) !== 'default' && ( is_category() || is_tag() || is_author() || is_date() || is_search() || is_home() ) ) {
			$sidebar_position = babystreet_get_option( 'blog_sidebar_position' );
		}

		return $sidebar_position;
	}

}


if (!function_exists('babystreet_get_choose_menu_options')) {

	/**
	 * Get options to use for choose menu select
	 *
	 * @return Array
	 */
	function babystreet_get_choose_menu_options() {
		$registered_menus = wp_get_nav_menus();
		$choose_menu_options = array(
				'none' => esc_html__('- No menu -', 'babystreet'),
				'default' => esc_html__('- Use global set top menu -', 'babystreet')
		);

		foreach ($registered_menus as $menu) {
			$choose_menu_options[$menu->term_id] = $menu->name;
		}

		return $choose_menu_options;
	}

}

// Disable BBPress breadcrumb
add_filter('bbp_no_breadcrumb', '__return_true');

if ( ! function_exists( 'babystreet_get_current_events_display_mode_and_title' ) ) {

	/**
	 * Returns current events display mode and page title specific for the Events Calendar Plugin
	 *
	 * @param $id int  post/page id
	 *
	 * @return array Array[display_mode, title]
	 */
	function babystreet_get_current_events_display_mode_and_title( $id = 0 ) {

		if ( $id == 0 ) {
			global $wp_query;

			if ( isset($wp_query->post) ) {
				$id = $wp_query->post->ID;
			}
		}

		$return_arr = array(
			'display_mode' => '',
			'title'        => ''
		);

		// If Event calendar is active follow the procedure to display the title
		if ( function_exists( 'tribe_is_month' ) ) {
			if ( tribe_is_month() && ! is_tax('', $id) ) { // The Main Calendar Page
				if ( babystreet_get_option( 'events_title' ) ) {
					$title = babystreet_get_option( 'events_title' );
				} else {
					$title = esc_html__( 'The Main Calendar', 'babystreet' );
				}
				$mode = 'MAIN_CALENDAR';
			} elseif ( tribe_is_month() && is_tax('', $id) ) { // Calendar Category Pages
				$title = esc_html__( 'Calendar Category', 'babystreet' ) . ': ' . tribe_meta_event_category_name();
				$mode  = 'CALENDAR_CATEGORY';
			} elseif ( tribe_is_event( $id ) && ! tribe_is_day() && ! is_singular() && ! is_tax('', $id) ) { // The Main Events List
				if ( babystreet_get_option( 'events_title' ) ) {
					$title = babystreet_get_option( 'events_title' );
				} else {
					$title = esc_html__( 'Events List', 'babystreet' );
				}
				$mode = 'MAIN_EVENTS';
			} elseif ( tribe_is_event( $id ) && ! tribe_is_day() && ! is_singular() && is_tax('', $id) ) { // Category Events List
				$title = esc_html__( 'Events List', 'babystreet' ) . ': ' . tribe_meta_event_category_name();
				$mode  = 'CATEGORY_EVENTS';
			} elseif ( tribe_is_event( $id ) && is_singular() ) { // Single Events
				$title = get_the_title( $id );
				$mode  = 'SINGLE_EVENTS';
			} elseif ( tribe_is_day() ) { // Single Event Days
				$title = esc_html__( 'Events on', 'babystreet' ) . ': ' . date( 'F j, Y', strtotime( get_query_var( 'eventDate' ) ) );
				$mode  = 'SINGLE_EVENT_DAYS';
			} elseif ( tribe_is_venue( $id ) ) { // Single Venues
				$title = get_the_title( $id );
				$mode  = 'VENUE';
			} else {
				$title = get_the_title( $id );
				$mode  = '';
			}
		} else {
			$title = get_the_title( $id );
			$mode  = '';
		}

		$return_arr['title']        = $title;
		$return_arr['display_mode'] = $mode;

		return $return_arr;
	}
}

if ( ! function_exists( 'babystreet_is_events_part' ) ) {

	/**
	 * Detect if we are on an Events Calendar page
	 *
	 * @return bool
	 */
	function babystreet_is_events_part() {

		if ( BABYSTREET_IS_EVENTS && function_exists( 'tribe_is_event' ) && ( tribe_is_month() || tribe_is_event() || tribe_is_event_category() || tribe_is_in_main_loop() || tribe_is_view() || 'tribe_events' == get_post_type() || is_singular( 'tribe_events' ) ) ) {
			return true;
		}

		return false;
	}
}


/**
 * Strip the "script" tag from given string
 * Used for inline js code given to wp_add_inline_script
 *
 * @param string $source JS source code
 *
 * @return string The string without "script" tag
 */
function babystreet_strip_script_tag_from_js_block( $source ) {
	return trim( preg_replace( '#<script[^>]*>(.*)</script>#is', '$1', $source ) );
}

if ( ! function_exists('babystreet_write_log')) {
	function babystreet_write_log ( $log )  {
		if ( is_array( $log ) || is_object( $log ) ) {
			error_log( print_r( $log, true ) );
		} else {
			error_log( $log );
		}
	}
}