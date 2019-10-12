<?php
/**
 * Custom edd
 *
 * Learn more: http://docs.easydigitaldownloads.com/
 *
 */


if ( class_exists( 'Easy_Digital_Downloads' ) ) :


///////////////////////////////////////////////////////////////////////////////////////////
//////////////////////   EDD Sale Count /////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

if( ! function_exists( 'dm_get_edd_sale_count' ) ){
  function mayosis_get_edd_sale_count($postID){
   return get_post_meta( $postID, '_edd_download_sales', true ); 
 }
}


function edd_count_total_file_downloads() {
    global $edd_logs;
    return $edd_logs->get_log_count( null, 'file_download' );
}


endif;

// change avatar on profile page
	if ( ! function_exists( 'edd_profile_avatar' ) ) {
		function edd_profile_avatar(){
			echo do_shortcode('[basic-user-avatars]');
		}
	}
	add_filter( 'edd_profile_editor_before', 'edd_profile_avatar' );
	/**
 * Show the list of products when the cart is empty
 *
 * @since 1.0
 */
function checkout_empty_cart_template() {

	echo ( '<section id="Section_empty_cart">
            <div class="container">
			    <div class="row">
                        
                      <div class="col-md-12 empty_cart_icon">
                      <i class="fa fa-shopping-cart"></i>
                      <h1>Your Cart is Empty</h1>
                      <h2>No Problem, Lets Start Browse</h2>
						</div>

                    </div>
                
            </div>
        </section>' );
	get_template_part( 'content/content', 'product-footer' );
}
add_filter( 'edd_cart_empty', 'checkout_empty_cart_template' );

/**
 * Add wrapper class to EDD [download] shortcode
 *
 * @since mayosis 1.0
 */
function mayosis_edd_download_wrap( $class, $atts ) {
	return 'dm-default-wrapper download-wrapper ' . $class;
}
add_filter( 'edd_downloads_list_wrapper_class', 'mayosis_edd_download_wrap', 10, 2 );
/**
 * Change checkout page image size
 *
 * @since mayosis 1.0
 */
 function mayosis_filter_edd_checkout_image_size( $array ) {
     return array( 120, 80 );
 }
 add_filter( 'edd_checkout_image_size', 'mayosis_filter_edd_checkout_image_size', 10, 1 );
