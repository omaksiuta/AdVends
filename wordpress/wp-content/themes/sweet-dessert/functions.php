<?php
/**
 * Theme sprecific functions and definitions
 */

/* Theme setup section
------------------------------------------------------------------- */

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) $content_width = 1170; /* pixels */


// Add theme specific actions and filters
// Attention! Function were add theme specific actions and filters handlers must have priority 1
if ( !function_exists( 'sweet_dessert_theme_setup' ) ) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_theme_setup', 1 );
	function sweet_dessert_theme_setup() {

        // Add default posts and comments RSS feed links to head
        add_theme_support( 'automatic-feed-links' );

        // Enable support for Post Thumbnails
        add_theme_support( 'post-thumbnails' );

        // Custom header setup
        add_theme_support( 'custom-header', array('header-text'=>false));

        // Custom backgrounds setup
        add_theme_support( 'custom-background');

        // Supported posts formats
        add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') );

        // Autogenerate title tag
        add_theme_support('title-tag');

        // Add user menu
        add_theme_support('nav-menus');

        // WooCommerce Support
        add_theme_support( 'woocommerce' );

		// Register theme menus
		add_filter( 'sweet_dessert_filter_add_theme_menus',		'sweet_dessert_add_theme_menus' );

		// Register theme sidebars
		add_filter( 'sweet_dessert_filter_add_theme_sidebars',	'sweet_dessert_add_theme_sidebars' );

		// Set options for importer
		add_filter( 'sweet_dessert_filter_importer_options',		'sweet_dessert_set_importer_options' );

		// Add theme required plugins
		add_filter( 'sweet_dessert_filter_required_plugins',		'sweet_dessert_add_required_plugins' );
		
		// Add preloader styles
		add_filter('sweet_dessert_filter_add_styles_inline',		'sweet_dessert_head_add_page_preloader_styles');

		// Init theme after WP is created
		add_action( 'wp',									'sweet_dessert_core_init_theme' );

		// Add theme specified classes into the body
		add_filter( 'body_class', 							'sweet_dessert_body_classes' );

		// Add data to the head and to the beginning of the body
		add_action('wp_head',								'sweet_dessert_head_add_page_meta', 1);
		add_action('before',								'sweet_dessert_body_add_gtm');
		add_action('before',								'sweet_dessert_body_add_toc');
		add_action('before',								'sweet_dessert_body_add_page_preloader');

		// Add data to the footer (priority 1, because priority 2 used for localize scripts)
		add_action('wp_footer',								'sweet_dessert_footer_add_views_counter', 1);
		add_action('wp_footer',								'sweet_dessert_footer_add_theme_customizer', 1);
		add_action('wp_footer',								'sweet_dessert_footer_add_scroll_to_top', 1);
		add_action('wp_footer',								'sweet_dessert_footer_add_custom_html', 1);
		add_action('wp_footer',								'sweet_dessert_footer_add_gtm2', 1);

		// Set list of the theme required plugins
		sweet_dessert_storage_set('required_plugins', array(
			'essgrids',
			'revslider',
			'trx_utils',
			'visual_composer',
			'woocommerce',
            'mailchimp',
            'gdpr-compliance',
            'contact_form_7'

            )
		);

        // Gutenberg support
        add_theme_support( 'align-wide' );

		// Set list of the theme required custom fonts from folder /css/font-faces
		// Attention! Font's folder must have name equal to the font's name
		sweet_dessert_storage_set('required_custom_fonts', array(
			'Amadeus'
			)
		);

        sweet_dessert_storage_set('demo_data_url',  esc_url(sweet_dessert_get_protocol() . '://sweet-dessert.axiomthemes.com/demo/'));
		
	}
}


// Add/Remove theme nav menus
if ( !function_exists( 'sweet_dessert_add_theme_menus' ) ) {
	function sweet_dessert_add_theme_menus($menus) {
		return $menus;
	}
}


// Add theme specific widgetized areas
if ( !function_exists( 'sweet_dessert_add_theme_sidebars' ) ) {
	function sweet_dessert_add_theme_sidebars($sidebars=array()) {
		if (is_array($sidebars)) {
			$theme_sidebars = array(
				'sidebar_main'		=> esc_html__( 'Main Sidebar', 'sweet-dessert' ),
				'sidebar_footer'	=> esc_html__( 'Footer Sidebar', 'sweet-dessert' )
			);
			if (function_exists('sweet_dessert_exists_woocommerce') && sweet_dessert_exists_woocommerce()) {
				$theme_sidebars['sidebar_cart']  = esc_html__( 'WooCommerce Cart Sidebar', 'sweet-dessert' );
			}
			$sidebars = array_merge($theme_sidebars, $sidebars);
		}
		return $sidebars;
	}
}


// Add theme required plugins
if ( !function_exists( 'sweet_dessert_add_required_plugins' ) ) {
	function sweet_dessert_add_required_plugins($plugins) {
		$plugins[] = array(
			'name' 		=> esc_html__('Sweet Dessert Utilities', 'sweet-dessert'),
			'version'	=> '3.2.1',					// Minimal required version
			'slug' 		=> 'trx_utils',
			'source'	=> sweet_dessert_get_file_dir('plugins/install/trx_utils.zip'),
			'required' 	=> true
		);
		return $plugins;
	}
}

// Return text for the Privacy Policy checkbox
if ( ! function_exists('sweet_dessert_get_privacy_text' ) ) {
    function sweet_dessert_get_privacy_text() {
        $page = get_option( 'wp_page_for_privacy_policy' );
        $privacy_text = sweet_dessert_get_theme_option( 'privacy_text' );
        return apply_filters( 'sweet_dessert_filter_privacy_text', wp_kses_post(
                $privacy_text
                . ( ! empty( $page ) && ! empty( $privacy_text )
                    // Translators: Add url to the Privacy Policy page
                    ? ' ' . sprintf( esc_html__( 'For further details on handling user data, see our %s', 'sweet-dessert' ),
                        '<a href="' . esc_url( get_permalink( $page ) ) . '" target="_blank">'
                        . esc_html__( 'Privacy Policy', 'sweet-dessert' )
                        . '</a>' )
                    : ''
                )
            )
        );
    }
}

// Return text for the "I agree ..." checkbox
if ( ! function_exists( 'sweet_dessert_trx_utils_privacy_text' ) ) {
    add_filter( 'trx_utils_filter_privacy_text', 'sweet_dessert_trx_utils_privacy_text' );
    function sweet_dessert_trx_utils_privacy_text( $text='' ) {
        return sweet_dessert_get_privacy_text();
    }
}

//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'sweet_dessert_importer_set_options' ) ) {
    add_filter( 'trx_utils_filter_importer_options', 'sweet_dessert_importer_set_options', 9 );
    function sweet_dessert_importer_set_options( $options=array() ) {
        if ( is_array( $options ) ) {
            // Save or not installer's messages to the log-file
            $options['debug'] = false;
            // Prepare demo data
            if ( is_dir( SWEET_DESSERT_THEME_PATH . 'demo/' ) ) {
                $options['demo_url'] = SWEET_DESSERT_THEME_PATH . 'demo/';
            } else {
                $options['demo_url'] = esc_url( sweet_dessert_get_protocol().'://demofiles.axiomthemes.com/sweet-dessert/' ); // Demo-site domain
            }

            // Required plugins
            $options['required_plugins'] =  array(
                'essential-grid',
                'revslider',
                'mailchimp-for-wp',
                'js_composer',
                'woocommerce',
                'contact-form-7'

            );

            $options['theme_slug'] = 'sweet_dessert';

            // Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
            // Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
            $options['regenerate_thumbnails'] = 3;
            // Default demo
            $options['files']['default']['title'] = esc_html__( 'Sweet Dessert Demo', 'sweet-dessert' );
            $options['files']['default']['domain_dev'] = esc_url(sweet_dessert_get_protocol().'://sweet-dessert.axiomthemes.com'); // Developers domain
            $options['files']['default']['domain_demo']= esc_url(sweet_dessert_get_protocol().'://sweet-dessert.axiomthemes.com'); // Demo-site domain

        }
        return $options;
    }
}


// Add data to the head and to the beginning of the body
//------------------------------------------------------------------------

// Add theme specified classes to the body tag
if ( !function_exists('sweet_dessert_body_classes') ) {
	function sweet_dessert_body_classes( $classes ) {

		$classes[] = 'sweet_dessert_body';
		$classes[] = 'body_style_' . trim(sweet_dessert_get_custom_option('body_style'));
		$classes[] = 'body_' . (sweet_dessert_get_custom_option('body_filled')=='yes' ? 'filled' : 'transparent');
		$classes[] = 'article_style_' . trim(sweet_dessert_get_custom_option('article_style'));
		
		$blog_style = sweet_dessert_get_custom_option(is_singular() && !sweet_dessert_storage_get('blog_streampage') ? 'single_style' : 'blog_style');
		$classes[] = 'layout_' . trim($blog_style);
		$classes[] = 'template_' . trim(sweet_dessert_get_template_name($blog_style));
		
		$body_scheme = sweet_dessert_get_custom_option('body_scheme');
		if (empty($body_scheme)  || sweet_dessert_is_inherit_option($body_scheme)) $body_scheme = 'original';
		$classes[] = 'scheme_' . $body_scheme;

		$top_panel_position = sweet_dessert_get_custom_option('top_panel_position');
		if (!sweet_dessert_param_is_off($top_panel_position)) {
			$classes[] = 'top_panel_show';
			$classes[] = 'top_panel_' . trim($top_panel_position);
		} else 
			$classes[] = 'top_panel_hide';
		$classes[] = sweet_dessert_get_sidebar_class();

		if (sweet_dessert_get_custom_option('show_video_bg')=='yes' && (sweet_dessert_get_custom_option('video_bg_youtube_code')!='' || sweet_dessert_get_custom_option('video_bg_url')!=''))
			$classes[] = 'video_bg_show';

		if (!sweet_dessert_param_is_off(sweet_dessert_get_theme_option('page_preloader')))
			$classes[] = 'preloader';

		return $classes;
	}
}


// Add page meta to the head
if (!function_exists('sweet_dessert_head_add_page_meta')) {
	function sweet_dessert_head_add_page_meta() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1<?php if (sweet_dessert_get_theme_option('responsive_layouts')=='yes') echo ', maximum-scale=1'; ?>">
		<meta name="format-detection" content="telephone=no">
	
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>" />
		<?php
	}
}

// Add page preloader styles to the head
if (!function_exists('sweet_dessert_head_add_page_preloader_styles')) {
	function sweet_dessert_head_add_page_preloader_styles($css) {
		if (($preloader=sweet_dessert_get_theme_option('page_preloader'))!='none') {
			$image = sweet_dessert_get_theme_option('page_preloader_image');
			$bg_clr = sweet_dessert_get_scheme_color('bg_color');
			$link_clr = sweet_dessert_get_scheme_color('text_link');
			$css .= '
				#page_preloader {
					background-color: '. esc_attr($bg_clr) . ';'
					. ($preloader=='custom' && $image
						? 'background-image:url('.esc_url($image).');'
						: ''
						)
				    . '
				}
				.preloader_wrap > div {
					background-color: '.esc_attr($link_clr).';
				}';
		}
		return $css;
	}
}

// Add gtm code to the beginning of the body 
if (!function_exists('sweet_dessert_body_add_gtm')) {
	function sweet_dessert_body_add_gtm() {
		echo wp_kses_data(force_balance_tags(sweet_dessert_get_custom_option('gtm_code')));
	}
}

// Add TOC anchors to the beginning of the body 
if (!function_exists('sweet_dessert_body_add_toc')) {
	function sweet_dessert_body_add_toc() {
		// Add TOC items 'Home' and "To top"
		if (sweet_dessert_get_custom_option('menu_toc_home')=='yes' && function_exists('sweet_dessert_sc_anchor'))
			sweet_dessert_show_layout(sweet_dessert_sc_anchor(array(
				'id' => "toc_home",
				'title' => esc_html__('Home', 'sweet-dessert'),
				'description' => esc_html__('{{Return to Home}} - ||navigate to home page of the site', 'sweet-dessert'),
				'icon' => "icon-home",
				'separator' => "yes",
				'url' => esc_url(home_url('/'))
				)
			)); 
		if (sweet_dessert_get_custom_option('menu_toc_top')=='yes' && function_exists('sweet_dessert_sc_anchor'))
			sweet_dessert_show_layout(sweet_dessert_sc_anchor(array(
				'id' => "toc_top",
				'title' => esc_html__('To Top', 'sweet-dessert'),
				'description' => esc_html__('{{Back to top}} - ||scroll to top of the page', 'sweet-dessert'),
				'icon' => "icon-double-up",
				'separator' => "yes")
				)); 
	}
}

// Add page preloader to the beginning of the body
if (!function_exists('sweet_dessert_body_add_page_preloader')) {
	function sweet_dessert_body_add_page_preloader() {
		if ( ($preloader=sweet_dessert_get_theme_option('page_preloader')) != 'none' && ( $preloader != 'custom' || ($image=sweet_dessert_get_theme_option('page_preloader_image')) != '')) {
			?><div id="page_preloader"><?php
				if ($preloader == 'circle') {
					?><div class="preloader_wrap preloader_<?php echo esc_attr($preloader); ?>"><div class="preloader_circ1"></div><div class="preloader_circ2"></div><div class="preloader_circ3"></div><div class="preloader_circ4"></div></div><?php
				} else if ($preloader == 'square') {
					?><div class="preloader_wrap preloader_<?php echo esc_attr($preloader); ?>"><div class="preloader_square1"></div><div class="preloader_square2"></div></div><?php
				}
			?></div><?php
		}
	}
}

// Add theme required plugins
if ( !function_exists( 'sweet_dessert_add_trx_utils' ) ) {
    add_filter( 'trx_utils_active', 'sweet_dessert_add_trx_utils' );
    function sweet_dessert_add_trx_utils($enable=true) {
        return true;
    }
}

// Add data to the footer
//------------------------------------------------------------------------

// Add post/page views counter
if (!function_exists('sweet_dessert_footer_add_views_counter')) {
	function sweet_dessert_footer_add_views_counter() {
		// Post/Page views counter
		get_template_part(sweet_dessert_get_file_slug('templates/_parts/views-counter.php'));
	}
}

// Add theme customizer
if (!function_exists('sweet_dessert_footer_add_theme_customizer')) {
	function sweet_dessert_footer_add_theme_customizer() {
		// Front customizer
		if (sweet_dessert_get_custom_option('show_theme_customizer')=='yes') {
			require_once SWEET_DESSERT_FW_PATH . 'core/core.customizer/front.customizer.php';
		}
	}
}

// Add scroll to top button
if (!function_exists('sweet_dessert_footer_add_scroll_to_top')) {
	function sweet_dessert_footer_add_scroll_to_top() {
		?><a href="#" class="scroll_to_top icon-up" title="<?php esc_attr_e('Scroll to top', 'sweet-dessert'); ?>"></a><?php
	}
}

// Add custom html
if (!function_exists('sweet_dessert_footer_add_custom_html')) {
	function sweet_dessert_footer_add_custom_html() {
		?><div class="custom_html_section"><?php
			echo wp_kses_data(force_balance_tags(sweet_dessert_get_custom_option('custom_code')));
		?></div><?php
	}
}

// Add gtm code
if (!function_exists('sweet_dessert_footer_add_gtm2')) {
	function sweet_dessert_footer_add_gtm2() {
		echo wp_kses_data(force_balance_tags(sweet_dessert_get_custom_option('gtm_code2')));
	}
}
function sweet_dessert_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter( 'comment_form_fields', 'sweet_dessert_move_comment_field_to_bottom' );


/* GET, POST, COOKIE, SESSION manipulations
----------------------------------------------------------------------------------------------------- */

// Strip slashes if Magic Quotes is on
if (!function_exists('sweet_dessert_stripslashes')) {
    function sweet_dessert_stripslashes($val) {
        static $magic = 0;
        if ($magic === 0) {
            $magic = version_compare(phpversion(), '5.4', '>=')
                || (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()==1)
                || (function_exists('get_magic_quotes_runtime') && get_magic_quotes_runtime()==1)
                || strtolower(ini_get('magic_quotes_sybase'))=='on';
        }
        if (is_array($val)) {
            foreach($val as $k=>$v)
                $val[$k] = sweet_dessert_stripslashes($v);
        } else
            $val = $magic ? stripslashes(trim($val)) : trim($val);
        return $val;
    }
}

// Get GET, POST value
if (!function_exists('sweet_dessert_get_value_gp')) {
    function sweet_dessert_get_value_gp($name, $defa='') {
        if (isset($_GET[$name]))        $rez = $_GET[$name];
        else if (isset($_POST[$name]))  $rez = $_POST[$name];
        else                            $rez = $defa;
        return sweet_dessert_stripslashes($rez);
    }
}

// Get GET, POST, COOKIE value and save it (if need)
if (!function_exists('sweet_dessert_get_value_gpc')) {
    function sweet_dessert_get_value_gpc($name, $defa='', $page='', $exp=0) {
        if (isset($_GET[$name]))         $rez = $_GET[$name];
        else if (isset($_POST[$name]))   $rez = $_POST[$name];
        else if (isset($_COOKIE[$name])) $rez = $_COOKIE[$name];
        else                             $rez = $defa;
        return sweet_dessert_stripslashes($rez);
    }
}

// Get GET, POST, SESSION value and save it (if need)
if (!function_exists('sweet_dessert_get_value_gps')) {
    function sweet_dessert_get_value_gps($name, $defa='', $page='') {
        if (isset($_GET[$name]))          $rez = $_GET[$name];
        else if (isset($_POST[$name]))    $rez = $_POST[$name];
        else if (isset($_SESSION[$name])) $rez = $_SESSION[$name];
        else                              $rez = $defa;
        return sweet_dessert_stripslashes($rez);
    }
}

// Include framework core files
//-------------------------------------------------------------------
require_once trailingslashit( get_template_directory() ) . 'fw/loader.php';
?>