<?php 
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $post;
$author = get_user_by( 'id', get_query_var( 'author' ) );
$authorName=get_user_meta($author->ID,'nickname');
$authorDetails=get_userdata($author->ID);
$authorTitle=get_the_author_meta( 'author_page_title', $author->ID );
$authorSubs=get_the_author_meta( 'author_page_subtitle', $author->ID );
$productgridsystem= get_theme_mod( 'product_grid_system','one' );
?>
         <div class="page-head">
            
            <!-- Begin Page Headings Layout -->
    <div class="single_author_box no-margin single_author_page container-fluid">
        <div class="container">
           			<div class="col-md-3">
           			<div class="author_meta_single">
           	<?php echo get_avatar( $author->ID,90 ) ?>
           				<h2>
           				  <i class="fa fa-user" aria-hidden="true"></i><?php echo get_the_author_meta( 'display_name',$author->ID );?>
           				</h2>
           			
          			<div class="author_social_items">
						<h4><?php _e('Network','mayosis') ; ?></h4>
						<ul class="icons">
					<?php 
						$rss_url = get_the_author_meta( 'rss_url',$author->ID );
						if ( $rss_url && $rss_url != '' ) {
							echo '<li class="rss"><a href="' . esc_url($rss_url) . '"><i class="fa fa-rss" aria-hidden="true"></i>
</a></li>';
						}
						
						$google_profile = get_the_author_meta( 'google_profile',$author->ID );
						if ( $google_profile && $google_profile != '' ) {
							echo '<li class="google"><a href="' . esc_url($google_profile) . '" rel="author"><i class="fa fa-google-plus" aria-hidden="true"></i>
</a></li>';
						}
						
						$twitter_profile = get_the_author_meta( 'twitter_profile',$author->ID );
						if ( $twitter_profile && $twitter_profile != '' ) {
							echo '<li class="twitter"><a href="' . esc_url($twitter_profile) . '"><i class="fa fa-twitter" aria-hidden="true"></i>
</a></li>';
						}
						
						$facebook_profile = get_the_author_meta( 'facebook_profile',$author->ID );
						if ( $facebook_profile && $facebook_profile != '' ) {
							echo '<li class="facebook"><a href="' . esc_url($facebook_profile) . '"><i class="fa fa-facebook" aria-hidden="true"></i>
</a></li>';
						}
						
						$linkedin_profile = get_the_author_meta( 'linkedin_profile',$author->ID );
						if ( $linkedin_profile && $linkedin_profile != '' ) {
							echo '<li class="linkedin"><a href="' . esc_url($linkedin_profile) . '"><i class="fa fa-linkedin" aria-hidden="true"></i>
</a></li>';
						}
					?>
				</ul>
				</div>
           			</div>
					</div>
					<div class="col-md-9 author_single_description">
						<h3><?php esc_html_e('Vendor&#39;s Biography','mayosis'); ?></h3>
						<p class="author-description"><?php if(strlen(get_the_author_meta( 'description', $author->ID )) >0) { ?><?php echo get_the_author_meta( 'description', $author->ID ); ?><?php } ?></p>
						
					</div>
					<div class="clearfix"></div>
				</div>
    </div>
    <!-- End Page Headings Layout -->
        </div>
	
	<div class="container author-all-product-box">
	<h3><?php esc_html_e('All Products From','mayosis') ; ?>  <?php echo esc_html(get_the_author_meta('display_name',$author->ID)); ?> </h3>
	<?php if ($productgridsystem=='two'): ?>
		<div class="masonary-brick">
	<?php else: ?>
		<div class="row fix">
	<?php endif; ?>

 <?php   

 $term=get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
 $termSlug=(isset($term->slug))?$term->slug:null;
 $searchTerm= (strlen(get_search_query() ) >0 )?get_search_query():null;
 $args=array("post_type"=>"download","status"=>"publish","author"=> $author->ID,'posts_per_page'=>-1);
 $temp = $wp_query; $wp_query = null; 
 $wp_query = new WP_Query(); $wp_query->query($args); ?>
 <?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
 
<?php if ($productgridsystem=='two'): ?>
<?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large');?>
                       <a href="<?php
                        the_permalink(); ?>" class="masonary-tile">
                          <?php the_post_thumbnail('large');?>
                        </a>
<?php else: ?>

		<div class="col-md-4 col-xs-12 col-sm-4">
					 <div class="grid_dm ribbon-box group edge">
                         <div class="product-box">
                              <?php
            $postdate = get_the_time('Y-m-d');   // Post date
            $postdatestamp = strtotime($postdate);   // Timestamped post date
            $newness = get_theme_mod('dm_days_products_new', '30');  // Newness in days

            if ((time() - (60 * 60 * 24 * $newness)) < $postdatestamp) { // If the product was published within the newness time frame display the new badge
                echo '<div class="wrap-ribbon left-edge point lblue"><span>'. esc_html__('New', 'mayosis') .'</span></div>';
            }
             ?>  
							<figure class="mayosis-fade-in">
						<?php
								// display featured image?
								if ( has_post_thumbnail() ) :
									the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
								endif; 

							?> 
						<figcaption>
						    	<div class="overlay_content_center">	
						<?php 	get_template_part( 'includes/product-hover-content-top' ); ?>
						
						<div class="product_hover_details_button">
								<a href="<?php the_permalink(); ?>" class="button-fill-color"><?php esc_html_e('View Details', 'mayosis'); ?></a>
								</div>
									<?php $demo_link = get_post_meta($post->ID, 'demo_link', true); ?>
							<?php if ( $demo_link ) { ?>
								<div class="product_hover_demo_button">
							<a href="<?php echo esc_url($demo_link); ?>" class="live_demo_onh" target="_blank"><?php esc_html_e('Live Demo', 'mayosis'); ?></a>
								</div>
							<?php } ?>
							
								<?php 	get_template_part( 'includes/product-hover-content-bottom' ); ?>
						</div>
						</figcaption>
									
					</figure>
						<div class="product-meta">
						<?php get_template_part( 'includes/product-meta' ); ?>
						</div>
					</div><!-- .product box -->
					</div>
				</div><!-- .product box Column -->
				<?php endif;?>
			<?php endwhile;?>
			

<?php endif; ?>
</div>
</div>