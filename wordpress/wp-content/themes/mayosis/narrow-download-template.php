<?php
/*
 * Template Name: Narrow Content
 * Template Post Type: download, product
 */
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 $download_id = get_the_ID();
 get_header();  ?>
 
<?php mayosis_setPostViews() ?>


		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content/content', 'narrow-template' ); ?>
			<?php get_template_part( 'content/footer-widget', 'download' ); ?>
			<div class="container" id="comment_box">
			<?php if ( comments_open() || '0' != get_comments_number() ) { ?>
								<?php comments_template(); ?>
							<?php } ?>
			</div>
		<?php endwhile; // end of the loop. ?>

		</main>



<?php get_footer(); ?>