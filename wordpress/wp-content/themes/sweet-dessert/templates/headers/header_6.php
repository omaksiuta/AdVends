<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'sweet_dessert_template_header_6_theme_setup' ) ) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_template_header_6_theme_setup', 1 );
	function sweet_dessert_template_header_6_theme_setup() {
		sweet_dessert_add_template(array(
			'layout' => 'header_6',
			'mode'   => 'header',
			'title'  => esc_html__('Header 6', 'sweet-dessert'),
			'icon'   => sweet_dessert_get_file_url('templates/headers/images/6.jpg')
			));
	}
}

// Template output
if ( !function_exists( 'sweet_dessert_template_header_6_output' ) ) {
	function sweet_dessert_template_header_6_output($post_options, $post_data) {

		// WP custom header
		$header_css = '';
		if ($post_options['position'] != 'over') {
			$header_image = get_header_image();
			$header_css = $header_image!='' 
				? ' style="background-image: url('.esc_url($header_image).')"' 
				: '';
		}
		?>

		<div class="top_panel_fixed_wrap"></div>

		<header class="top_panel_wrap top_panel_style_6 scheme_<?php echo esc_attr($post_options['scheme']); ?>">
			<div class="top_panel_wrap_inner top_panel_inner_style_6 top_panel_position_<?php echo esc_attr(sweet_dessert_get_custom_option('top_panel_position')); ?>">

			<div class="top_panel_middle" <?php sweet_dessert_show_layout($header_css); ?>>
				<div class="content_wrap">
					<div class="contact_logo">
						<?php sweet_dessert_show_logo(true, true, false, false, true, false); ?>
					</div>
					<div class="menu_main_wrap">
						<nav class="menu_main_nav_area menu_hover_<?php echo esc_attr(sweet_dessert_get_theme_option('menu_hover')); ?>">
							<?php
							$menu_main = sweet_dessert_get_nav_menu('menu_main');
							if (empty($menu_main)) $menu_main = sweet_dessert_get_nav_menu();
							sweet_dessert_show_layout($menu_main);
							?>
						</nav>
                        <div class="top_panel_buttons">
						<?php
						if (function_exists('sweet_dessert_exists_woocommerce') && sweet_dessert_exists_woocommerce() && (sweet_dessert_is_woocommerce_page() && sweet_dessert_get_custom_option('show_cart')=='shop' || sweet_dessert_get_custom_option('show_cart')=='always') && !(is_checkout() || is_cart() || defined('WOOCOMMERCE_CHECKOUT') || defined('WOOCOMMERCE_CART'))) { 
							?>
							<div class="menu_main_cart top_panel_icon">
								<?php get_template_part(sweet_dessert_get_file_slug('templates/headers/_parts/contact-info-cart.php')); ?>
							</div>
							<?php
						}
						?>
                        </div>
					</div>
				</div>
			</div>

			</div>
		</header>

		<?php
		sweet_dessert_storage_set('header_mobile', array(
				 'open_hours' => false,
				 'login' => false,
				 'socials' => false,
				 'bookmarks' => false,
				 'contact_address' => false,
				 'contact_phone_email' => false,
				 'woo_cart' => false,
				 'search' => false
			)
		);
	}
}
?>