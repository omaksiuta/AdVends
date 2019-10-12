<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
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
 * @version     3.3.0
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
global $wp_query;
$woocommerce_sidebar = babystreet_get_option('woocommerce_sidebar');

$show_sidebar_class = '';

if (babystreet_get_option('show_sidebar_shop') && $woocommerce_sidebar && $woocommerce_sidebar != 'none' && !is_product()) {
	$show_sidebar_class = 'has-sidebar';
} elseif (babystreet_get_option('show_sidebar_product') && $woocommerce_sidebar && $woocommerce_sidebar != 'none' && is_product()) {
	$show_sidebar_class = 'has-sidebar';
}

$babystreet_offcanvas_sidebar_choice = apply_filters('babystreet_has_offcanvas_sidebar', '');

if ($babystreet_offcanvas_sidebar_choice != 'none') {
	$babystreet_has_offcanvas_sidebar = is_active_sidebar($babystreet_offcanvas_sidebar_choice);
} else {
	$babystreet_has_offcanvas_sidebar = false;
}

$sidebar_classes[] = $show_sidebar_class;

// Sidebar position
$sidebar_classes[] = apply_filters('babystreet_left_sidebar_position_class', '');

if ($babystreet_has_offcanvas_sidebar) {
	$sidebar_classes[] = 'has-off-canvas-sidebar';
}

// get Shop subtitle
$shop_subtitle = babystreet_get_option('shop_subtitle');
$title_background_image = babystreet_get_option('shop_title_background_imgid');

if ($title_background_image) {
	$img = wp_get_attachment_image_src($title_background_image, 'full');
	$title_background_image = $img[0];
}

// If it is product category or tag - check if it has header image
$babystreet_prod_category_header_img_id = 0;
$babystreet_prod_category_header_alignment = '';
$babystreet_prod_category_subtitle = '';

if (is_product_category() || is_product_tag()) {
    $babystreet_current_cat = $wp_query->get_queried_object();

    if (isset($babystreet_current_cat->term_id)) {
        $babystreet_prod_category_header_img_id = absint( get_term_meta( $babystreet_current_cat->term_id, 'babystreet_term_header_img_id', true ) );
        $babystreet_prod_category_header_alignment = get_term_meta( $babystreet_current_cat->term_id, 'babystreet_term_header_alignment', true );
        $babystreet_prod_category_subtitle = get_term_meta( $babystreet_current_cat->term_id, 'babystreet_term_header_subtitle', true );;
    }
}

?>
<?php if ($babystreet_has_offcanvas_sidebar): ?>
	<?php get_sidebar('offcanvas'); ?>
<?php endif; ?>

<div id="content" class="content-area <?php echo esc_attr(implode(' ', $sidebar_classes)) ?>">

    <?php if (!is_product()): // For single product don't show title div ?>
        <?php if (is_shop()): // For SHOP page ?>
            <div id="babystreet_page_title" class="babystreet_title_holder <?php echo esc_attr(babystreet_get_option('shop_title_alignment')) ?> <?php if ($title_background_image): ?>title_has_image<?php endif; ?>">
            <?php if ($title_background_image): ?>
                <div class="babystreet-zoomable-background" style="background-image: url('<?php echo esc_url($title_background_image) ?>');"></div>
            <?php endif; ?>
   		<?php elseif(is_product_category() || is_product_tag()):  // For Category page ?>
            <div id="babystreet_page_title" class="<?php echo implode(" ", array("babystreet_title_holder", esc_attr($babystreet_prod_category_header_alignment))) ?><?php if ($babystreet_prod_category_header_img_id): ?> title_has_image<?php endif; ?>">
            <?php if($babystreet_prod_category_header_img_id): ?>
                <?php $babystreet_prod_category_header_img = wp_get_attachment_image_src($babystreet_prod_category_header_img_id, 'full'); ?>
                <div class="babystreet-zoomable-background" style="background-image: url('<?php echo esc_url($babystreet_prod_category_header_img[0]) ?>');"></div>
            <?php endif; ?>
        <?php else: // For the rest?>
            <div id="babystreet_page_title" class="babystreet_title_holder" >
        <?php endif; ?>

                <div class="inner fixed">
                    <div class="babystreet-title-text-container">
                        <!-- BREADCRUMB -->
                        <?php woocommerce_breadcrumb() ?>
                        <!-- END OF BREADCRUMB -->

                        <!-- TITLE -->
                        <?php if (!is_product() && apply_filters('woocommerce_show_page_title', true)): ?>
                            <h1 class="product_title entry-title heading-title"><?php woocommerce_page_title(); ?></h1>
                            <?php if (is_shop() && $shop_subtitle): ?>
                                <h6><?php echo esc_html($shop_subtitle) ?></h6>
                            <?php elseif ((is_product_category() || is_product_tag()) && $babystreet_prod_category_subtitle): ?>
                                <h6><?php echo esc_html($babystreet_prod_category_subtitle) ?></h6>
                            <?php endif; ?>
                        <?php endif; ?>
                        <!-- END OF TITLE -->
                    </div>
                </div>
            </div>

    <?php endif; ?>

    <div id="products-wrapper" class="inner site-main" role="main">
        <?php if ($babystreet_has_offcanvas_sidebar): ?>
            <a class="sidebar-trigger" href="#"><?php echo esc_html__('show', 'babystreet') ?></a>
        <?php endif; ?>