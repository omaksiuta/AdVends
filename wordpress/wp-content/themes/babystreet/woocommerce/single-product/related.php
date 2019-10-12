<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// owl carousel
wp_localize_script('babystreet-libs-config', 'babystreet_owl_carousel', array(
		'include' => 'true'
));

if ( $related_products ) : ?>

    <section class="related products">

        <h2><?php esc_html_e( 'Related products', 'babystreet' ); ?></h2>

		<?php woocommerce_product_loop_start(); ?>
        <!-- Container for flex carousel on related products  -->
        <div <?php if ( babystreet_get_option( 'owl_carousel' ) ): ?> class="owl-carousel babystreet-owl-carousel" <?php endif; ?>>

			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				/** @var WC_Product $related_product */
				$post_object = get_post( $related_product->get_id() );

				// Althemist edit - removed pass by ref as it is unnecessary
				setup_postdata( $GLOBALS['post'] = $post_object );

				wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>
            <!-- END Container for flex carousel on related products  -->
        </div>
		<?php woocommerce_product_loop_end(); ?>

    </section>

<?php endif;

wp_reset_postdata();