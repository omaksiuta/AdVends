<?php
/**
 * @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
       <div class="row">
        <div class="masonary-brick">
                                <?php while (have_posts()) : the_post(); ?>
                                    <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large');?>
                       <a href="<?php
                        the_permalink(); ?>" class="masonary-tile">
                            <?php the_post_thumbnail('large');?>
                        </a>
                                <?php endwhile ?>


                            </div>
    </div>