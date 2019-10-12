<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}
?>
<div class="box box-common babystreet-shop-pager<?php if(babystreet_get_option('enable_shop_infinite')) echo ' babystreet-infinite' ?>">

    <div class="babystreet-page-load-status">
        <p class="infinite-scroll-request"><?php esc_html_e( 'Loading', 'babystreet' ); ?>...</p>
        <p class="infinite-scroll-last"><?php esc_html_e( 'No more items available', 'babystreet' ); ?></p>
    </div>

    <?php if(babystreet_get_option('enable_shop_infinite') && babystreet_get_option('use_load_more_on_shop')): ?>
        <div class="babystreet-load-more-container">
            <button class="babystreet-load-more button"><?php esc_html_e( 'Load More', 'babystreet' ); ?></button>
        </div>
    <?php endif; ?>
    <?php babystreet_pagination(); ?>
</div>