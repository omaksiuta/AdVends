<?php
/**
 * template for displaying all single downloads
 * @package mayosis
 */
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$download_id = get_the_ID();
get_header(); ?>
<?php if(function_exists('mayosis_setPostViews')){
   mayosis_setPostViews();
} ?>


		<main id="main" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content/content', 'download' ); ?>
			<?php get_template_part( 'content/footer-widget', 'download' ); ?>
			<div class="container" id="comment_box">
			<?php if ( comments_open() || '0' != get_comments_number() ) { ?>
								<?php comments_template(); ?>
							<?php } ?>
			</div>
		<?php endwhile;  ?>

		</main>



<?php get_footer(); ?>