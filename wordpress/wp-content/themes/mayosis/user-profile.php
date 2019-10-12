<?php
/**
 * Template Name:EDD User Dashboard
 *
 * This is EDD User Dashboard .
 *
 * @package mayosis-digital-marketplace-theme
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header();
$mayosis_breadcrumb_color = get_post_meta( $post->ID, 'mayosis_breadcrumb_color', true );
$mayosis_page_bg = get_post_meta( $post->ID, 'mayosis_page_bg', true );  

$mayosis_gradient= get_post_meta( $post->ID, 'breadcrumb_gradient', true );

$mayosis_gradient_a = get_post_meta( $post->ID, 'mayosis_gradient_a', true );

$mayosis_gradient_b = get_post_meta( $post->ID, 'mayosis_gradient_b', true );
?>
<?php if ( is_home() ) {
    $breadcrumb_hide = get_post_meta(get_queried_object_id(), 'breadcrumb_hide', true );
} else {
    $breadcrumb_hide = get_post_meta(get_queried_object_id(), 'breadcrumb_hide', true );
} ?>
<div class="container-fluid">
<?php while ( have_posts() ) : the_post(); ?>
			<?php  if($breadcrumb_hide == "Yes"){ ?>
				<?php  if($mayosis_gradient == "Yes"){ ?>
				<div class="row page_breadcrumb" style="background:linear-gradient(45deg, <?php echo esc_html($mayosis_gradient_a); ?> , <?php echo esc_html($mayosis_gradient_b); ?>);">
				<?php } else { ?>
					<div class="row page_breadcrumb" style="background-color:<?php echo esc_html($mayosis_breadcrumb_color); ?>;background-image:url(<?php echo get_post_meta(get_the_ID(), 'breadcrumb_image', true ); ?>);">
					 <?php } ?>
					 
					<h2 class="page_title_single"><?php the_title(); ?></h2>
						<?php if (function_exists('dm_breadcrumbs')) dm_breadcrumbs(); ?>
						</div>
				<?php } ?>
					</div>
					<div class="dm-column-container" style="background:<?php echo esc_html($mayosis_page_bg); ?>">
					  
					<div class="user-dashboard-page">
					    <div class="dasboard-tab">
					        <div class="container">
        					   <ul class="nav nav-pills">
                                  <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                                  <li><a href="#purchase" data-toggle="tab">Purchase History</a></li>
                                  <li><a href="#download" data-toggle="tab">Download History</a></li>
                                  <li><a href="#discount" data-toggle="tab">Discount</a></li>
                                </ul>
					        </div>
					    </div>
					   
					
					 <div class="container">
					<div class="tab-content clearfix">
			 			 <div class="tab-pane active" id="profile">
			 			      <?php echo do_shortcode('[edd_profile_editor]');?>
			 			     </div>
			 			     
			 			     <div class="tab-pane" id="purchase">
			 			      <?php echo do_shortcode('[purchase_history]');?>
			 			     </div>
			 			     
			 			     <div class="tab-pane" id="download">
			 			      <?php echo do_shortcode('[download_history]');?>
			 			     </div>
			 			     
			 			     <div class="tab-pane" id="discount">
			 			      <?php echo do_shortcode('[download_discounts]');?>
			 			     </div>
					</div>	
					</div>
					
					</div>
						</div>
	
					<?php endwhile; // end of the loop. ?>
<?php
get_footer(); ?>