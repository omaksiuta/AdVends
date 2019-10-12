<?php
$header_options = sweet_dessert_storage_get('header_mobile');
$contact_address_1 = trim(sweet_dessert_get_custom_option('contact_address_1'));
$contact_address_2 = trim(sweet_dessert_get_custom_option('contact_address_2'));
$contact_phone = trim(sweet_dessert_get_custom_option('contact_phone'));
$contact_email = trim(sweet_dessert_get_custom_option('contact_email'));
?>
	<div class="header_mobile">
		<div class="content_wrap">
			<div class="menu_button icon-menu"></div>
			<?php 
			sweet_dessert_show_logo(); 
			if ($header_options['woo_cart']){
				if (function_exists('sweet_dessert_exists_woocommerce') && sweet_dessert_exists_woocommerce() && (sweet_dessert_is_woocommerce_page() && sweet_dessert_get_custom_option('show_cart')=='shop' || sweet_dessert_get_custom_option('show_cart')=='always') && !(is_checkout() || is_cart() || defined('WOOCOMMERCE_CHECKOUT') || defined('WOOCOMMERCE_CART'))) { 
					?>
					<div class="menu_main_cart top_panel_icon">
						<?php get_template_part(sweet_dessert_get_file_slug('templates/headers/_parts/contact-info-cart.php')); ?>
					</div>
					<?php
				}
			}
			?>
		</div>
		<div class="side_wrap">
			<div class="close"><?php esc_html_e('Close', 'sweet-dessert'); ?></div>
			<div class="panel_top">
				<nav class="menu_main_nav_area">
					<?php
						$menu_main = sweet_dessert_get_nav_menu('menu_main');
						if (empty($menu_main)) $menu_main = sweet_dessert_get_nav_menu();
						$menu_main = sweet_dessert_set_tag_attrib($menu_main, '<ul>', 'id', 'menu_mobile');
						sweet_dessert_show_layout($menu_main);
					?>
				</nav>
			</div>
			<div class="panel_bottom">
				<?php if ($header_options['socials'] && sweet_dessert_get_custom_option('show_socials')=='yes' && function_exists('sweet_dessert_sc_socials')) { ?>
					<div class="contact_socials">
						<?php sweet_dessert_show_layout(sweet_dessert_sc_socials(array('size'=>'small'))); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="mask"></div>
	</div>