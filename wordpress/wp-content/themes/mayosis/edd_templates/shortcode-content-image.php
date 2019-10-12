<?php if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( get_the_ID() ) ) : ?>
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
<?php endif; ?>
