<?php
/**
 * @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>   
            <div class="row fix">
                                <?php while (have_posts()) : the_post(); ?>
                                    <div class="col-md-4 col-xs-12 col-sm-4 product-grid">
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
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile ?>


                            </div>