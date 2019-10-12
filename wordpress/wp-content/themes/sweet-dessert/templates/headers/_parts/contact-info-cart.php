<?php
$cart_items = WC()->cart->get_cart_contents_count();
$cart_summa = strip_tags(WC()->cart->get_cart_subtotal());
?>
<a href="#" class="top_panel_cart_button" data-items="<?php echo esc_attr($cart_items); ?>" data-summa="<?php echo esc_attr($cart_summa); ?>">
	<span class="contact_icon icon-cart"></span>
	<span class="contact_label contact_cart_label"><?php esc_html_e('Your cart:', 'sweet-dessert'); ?></span>
	<span class="contact_cart_totals">
		<span class="cart_items"><?php
			echo esc_html($cart_items) . ' ' . ($cart_items == 1 ? esc_html__('Item', 'sweet-dessert') : esc_html__('Items', 'sweet-dessert'));
		?></span>
		- 
		<span class="cart_summa"><?php sweet_dessert_show_layout($cart_summa); ?></span>
	</span>
</a>
<ul class="widget_area sidebar_cart sidebar"><li>
	<?php
	do_action( 'before_sidebar' );
	sweet_dessert_storage_set('current_sidebar', 'cart');
	if ( !dynamic_sidebar( 'sidebar-cart' ) ) { 
		the_widget( 'WC_Widget_Cart', 'title=&hide_if_empty=1' );
	}
	?>
</li></ul>