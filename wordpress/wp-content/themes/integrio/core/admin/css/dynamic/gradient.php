<?php
if ( !defined( 'ABSPATH' ) ) { exit; }

$css .= '
.theme-gradient input[type="submit"],
.rev_slider .rev-btn.gradient-button,
.blog-post_meta-categories a,
.wgl_portfolio_single-item .portfolio-category,
body .widget .widget-title .widget-title_wrapper:before,
.inside_image.sub_layer_animation .wgl_portfolio_item-description,
.inside_image.always_info_animation .wgl_portfolio_item-description,
.wgl_module_team .team-info_icons,
.wpb-js-composer .wgl-container .vc_row .vc_general.vc_tta.vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab:before,
.wpb-js-composer .wgl-container .vc_row .vc_general.vc_tta.vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading .vc_tta-panel-title:before,
.integrio_module_progress_bar .progress_bar,
.integrio_module_testimonials.type_inline_top .testimonials_meta_wrap:after,
.page_404_wrapper .integrio_404_button.wgl_button .wgl_button_link,
.banner-widget_button,
.load_more_wrapper .load_more_item,
.woocommerce .widget_price_filter .price_slider_amount .button,
.widget_shopping_cart .buttons a:not(.checkout),
.wgl-theme-header .woo_mini_cart .woocommerce-mini-cart__buttons a:not(.checkout),
.woocommerce div.product form.cart .button,
.woocommerce #review_form #respond .form-submit input,
.theme-gradient .woocommerce-message a.button,
.woocommerce table.shop_table.cart input.button,
.woocommerce button.button[name="update_cart"],
.theme-gradient.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
.woocommerce form.checkout_coupon .form-row button.button,
.woocommerce-page #payment #place_order,
.integrio_module_demo_item .di_button .wgl_button_link{';
if ( (bool)$use_gradient_switch ) {
	$css .= '
		background: -webkit-linear-gradient(left, '.$theme_gradient_from.' 0%, '.$theme_gradient_to.' 50%, '.$theme_gradient_from.' 100%);
		background: -ms-linear-gradient(left, '.$theme_gradient_from.' 0%, '.$theme_gradient_to.' 50%, '.$theme_gradient_from.' 100%);
		background-size: 300%, 1px;
		background-position: 0%;
	}';
} else {
	$css .= 'background-color:'.$theme_color.';}';
}

?>