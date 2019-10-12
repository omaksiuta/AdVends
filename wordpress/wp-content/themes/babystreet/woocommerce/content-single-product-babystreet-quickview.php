<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

/** @var  $product WC_Product $product is coming from the ajax call param */
global $product;

$attachment_ids = $product->get_gallery_image_ids();

$schema = "Product";

// Downloadable product schema handling
if ( $product->is_downloadable() ) {
	switch ( $product->get_type()) {
		case 'application' :
			$schema = "SoftwareApplication";
			break;
		case 'music' :
			$schema = "MusicAlbum";
			break;
		default :
			$schema = "Product";
			break;
	}
}
?>

<div itemscope itemtype="<?php echo esc_url('http://schema.org/' . $schema); ?>" id="product-<?php the_ID(); ?>" <?php post_class('box box-common fixed babystreet-single-product'); ?>>

	<?php
	remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
	/**
	 * woocommerce_before_single_product_summary hook
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20 - removed for the quickview
	 */
	do_action('woocommerce_before_single_product_summary');
	?>
	<div class="babystreet-quickview-images <?php if (count($attachment_ids)): ?>owl-carousel babystreet-owl-carousel<?php endif; ?>">

		<?php
		if (has_post_thumbnail()) {
			?>
			<?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'woocommerce_single'); ?>
			<?php foreach ($attachment_ids as $img_att_id): ?>

				<?php echo wp_get_attachment_image($img_att_id, 'woocommerce_single'); ?>

			<?php endforeach; ?>
			<?php
		} else {

			echo apply_filters('woocommerce_single_product_image_html', sprintf('<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__('Placeholder', 'babystreet')), $post->get_id());
		}
		?>
	</div>
	<?php if (count($attachment_ids)): ?>
		<script>
			jQuery(".babystreet-quickview-images").owlCarousel({
				rtl: <?php echo is_rtl() ? 'true' : 'false'; ?>,
				items: 1,
				dots: false,
				loop: true,
				nav: true,
				navText: [
					"<i class='fa fa-angle-left'></i>",
					"<i class='fa fa-angle-right'></i>"
				],
			});
		</script>
	<?php endif; ?>
	<div class="summary entry-summary">
		<?php
		/**
		 * woocommerce_single_product_summary hook
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 */
		do_action('woocommerce_single_product_summary');
		?>

	</div><!-- .summary -->
	<div class="clear"></div>
	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</div><!-- closing div of content-holder -->