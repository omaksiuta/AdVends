<?php
/**
 * The template for displaying Download Search Results pages.
 *
 * @package mayosis
 */
get_header(); ?>

			
					<div class="row page_breadcrumb">
					<h2 class="page_title_single"><?php esc_html_e('Search Result','mayosis'); ?></h2>
						<?php if (function_exists('dm_breadcrumbs')) dm_breadcrumbs(); ?>
						</div>
			
        <div class="container">
            <?php $searchresults = get_search_query(); ?>
            
            <?php 

              $temp = $wp_query; 
              $wp_query = null; 
              $wp_query = new WP_Query(); 
              $wp_query->query('post_type=download&posts_per_page=6'.'&s='.$searchresults); 
            ?>
                
                            
            <ul class="search_list">
                            
                <?php while ($wp_query->have_posts()) : $wp_query->the_post();  ?>

                            <div class="col-md-4 col-xs-12 col-sm-4">
					<div class="product-box">
						<div class="product-thumb"> 
							<a href="#"> 
								  	<?php
								// display featured image?
								if ( has_post_thumbnail() ) :
									the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
								endif; 

							?>                                                    
								<div class="hover_effect"></div>
							</a>
						</div>
						<div class="product-meta">
							<h4 class="product-title"><?php the_title(); ?></h4>
							<div class="meta-bottom">
								<div class="product-tag">
									<p><?php the_terms( $post->ID, 'download_category','' ); ?></p>
								</div>
								<?php 
																	global $edd_logs;
															$single_count = $edd_logs->get_log_count(66, 'file_download');
															$total_count  = $edd_logs->get_log_count('*', 'file_download');
																$price = edd_get_download_price(get_the_ID());
																	?>
								<div class="count-download">
									 <?php if( $price == "0.00"  ){ ?>
									<p><?php $download = $edd_logs->get_log_count(get_the_ID(), 'file_download'); echo ( is_null( $download ) ? '0' : $download ); ?> <i class="fa fa-arrow-circle-down" aria-hidden="true"></i></p>
								
									 <?php } else { ?>
                       <div class="product-price promo_price"><?php edd_price(get_the_ID()); ?></div>
                    <?php } ?>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div><!-- .product box -->
				</div><!-- .product box Column -->

                          <?php endwhile; ?>

                      </ul>            
            
                <!-- Start of edd_download_pagination -->
                <div id="edd_download_pagination" class="navigation">
                

                </div><!-- End of edd_download_pagination -->
            
                <?php $wp_query = null; $wp_query = $temp; wp_reset_query;  // Reset ?>

        </div>
 <?php get_footer(); ?>