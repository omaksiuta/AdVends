<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'sweet_dessert_template_header_8_theme_setup' ) ) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_template_header_8_theme_setup', 1 );
	function sweet_dessert_template_header_8_theme_setup() {
		sweet_dessert_add_template(array(
			'layout' => 'header_8',
			'mode'   => 'header',
			'title'  => esc_html__('Header 8', 'sweet-dessert'),
			'icon'   => sweet_dessert_get_file_url('templates/headers/images/8.jpg')
			));
	}
}

// Template output
if ( !function_exists( 'sweet_dessert_template_header_8_output' ) ) {
	function sweet_dessert_template_header_8_output($post_options, $post_data) {

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

		<header class="top_panel_wrap top_panel_style_8 scheme_<?php echo esc_attr($post_options['scheme']); ?>">
			
			<div class="top_panel_wrap_inner top_panel_inner_style_8 top_panel_position_<?php echo esc_attr(sweet_dessert_get_custom_option('top_panel_position')); ?>">
			
                    <div class="top_panel_top"></div>

				<div class="top_panel_middle" <?php sweet_dessert_show_layout($header_css); ?>>
					<div class="content_wrap">
                        <div class="columns_wrap columns_fluid">
                            <div class="column-1_4">

                                <div class="menu_pushy_wrap clearfix">
                                    <a href="#" class="menu_pushy_button icon-menu-1"><?php esc_html_e('MENU', 'sweet-dessert'); ?></a>
                                </div>

                            </div><div class="column-2_4">

                                <div class="contact_logo">
                                    <?php sweet_dessert_show_logo(true, true); ?>
                                </div>
                            </div><div class="column-1_4">

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

			</div>

		</header>

		<nav class="menu_pushy_nav_area pushy pushy-left scheme_<?php echo esc_attr(sweet_dessert_get_custom_option('pushy_panel_scheme')); ?>">
			<div class="pushy_inner">
	
				<a href="#" class="close-pushy"></a>
	
				<?php

                echo '<h3>'.esc_html__('Our Menu', 'sweet-dessert').'</h3>';

				$menu_main = sweet_dessert_get_nav_menu('menu_main');
				if (empty($menu_main)) $menu_main = sweet_dessert_get_nav_menu();
				echo str_replace('menu_main', 'menu_pushy', $menu_main);
	
				$address_1 = sweet_dessert_get_theme_option('contact_address_1');
				$address_2 = sweet_dessert_get_theme_option('contact_address_2');
				$phone = sweet_dessert_get_theme_option('contact_phone');
				$fax = sweet_dessert_get_theme_option('contact_fax');
				if (!empty($address_1) || !empty($address_2) || !empty($phone) || !empty($fax)) {
					?>
					<div class="contact_info">
						<?php if (!empty($address_1) || !empty($address_2)) { ?>
							<address class="contact_address">
								<?php sweet_dessert_show_layout($address_1 . (!empty($address_1) ? ', ' : '') . trim($address_2)); ?>
							</address>
						<?php } ?>
						<?php if (!empty($phone) || !empty($fax)) { ?>
							<address class="contact_phones">
								<?php echo esc_html__('Call:', 'sweet-dessert') . ' ' . ($phone) . (!empty($phone) ? ', ' : '') . ($fax); ?>
							</address>
						<?php } ?>
					</div>
					<?php
				}
				?>

			</div>
        </nav>

        <!-- Site Overlay -->
        <div class="site-overlay"></div>
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