<?php
get_header();

// Default to single post
// Get the babystreet custom options
$babystreet_page_options = get_post_custom(get_the_ID());

$babystreet_show_title_page = 'yes';
$babystreet_show_breadcrumb = 'yes';
$babystreet_featured_slider = 'none';
$babystreet_subtitle = '';
$babystreet_show_title_background = 0;
$babystreet_title_background_image = '';
$babystreet_title_alignment = 'left_title';

if (isset($babystreet_page_options['babystreet_show_title_page']) && trim($babystreet_page_options['babystreet_show_title_page'][0]) != '') {
	$babystreet_show_title_page = $babystreet_page_options['babystreet_show_title_page'][0];
}

if (isset($babystreet_page_options['babystreet_show_breadcrumb']) && trim($babystreet_page_options['babystreet_show_breadcrumb'][0]) != '') {
	$babystreet_show_breadcrumb = $babystreet_page_options['babystreet_show_breadcrumb'][0];
}

if (isset($babystreet_page_options['babystreet_rev_slider']) && trim($babystreet_page_options['babystreet_rev_slider'][0]) != '') {
	$babystreet_featured_slider = $babystreet_page_options['babystreet_rev_slider'][0];
}


if (isset($babystreet_page_options['babystreet_page_subtitle']) && trim($babystreet_page_options['babystreet_page_subtitle'][0]) != '') {
	$babystreet_subtitle = $babystreet_page_options['babystreet_page_subtitle'][0];
}

if (isset($babystreet_page_options['babystreet_title_background_imgid']) && trim($babystreet_page_options['babystreet_title_background_imgid'][0]) != '') {
	$babystreet_img = wp_get_attachment_image_src($babystreet_page_options['babystreet_title_background_imgid'][0], 'full');
	$babystreet_title_background_image = $babystreet_img[0];
}

if (isset($babystreet_page_options['babystreet_title_alignment']) && trim($babystreet_page_options['babystreet_title_alignment'][0]) != '') {
	$babystreet_title_alignment = $babystreet_page_options['babystreet_title_alignment'][0];
}

$babystreet_sidebar_choice = apply_filters('babystreet_has_sidebar', '');

if ($babystreet_sidebar_choice != 'none') {
	$babystreet_has_sidebar = is_active_sidebar($babystreet_sidebar_choice);
} else {
	$babystreet_has_sidebar = false;
}


$babystreet_offcanvas_sidebar_choice = apply_filters('babystreet_has_offcanvas_sidebar', '');

if ($babystreet_offcanvas_sidebar_choice != 'none') {
	$babystreet_has_offcanvas_sidebar = is_active_sidebar($babystreet_offcanvas_sidebar_choice);
} else {
	$babystreet_has_offcanvas_sidebar = false;
}

$babystreet_sidebar_classes = array();
if ($babystreet_has_sidebar) {
	$babystreet_sidebar_classes[] = 'has-sidebar';
}
if ($babystreet_has_offcanvas_sidebar) {
	$babystreet_sidebar_classes[] = 'has-off-canvas-sidebar';
}

// Sidebar position
$babystreet_sidebar_classes[] = apply_filters('babystreet_left_sidebar_position_class', '');
?>
<?php if ($babystreet_has_offcanvas_sidebar): ?>
	<?php get_sidebar('offcanvas'); ?>
<?php endif; ?>
<div id="content" <?php if (!empty($babystreet_sidebar_classes)) echo 'class="' . esc_attr(implode(' ', $babystreet_sidebar_classes)) . '"'; ?> >
	<?php while (have_posts()) : the_post(); ?>
		<?php if ($babystreet_show_title_page == 'yes' || $babystreet_show_breadcrumb == 'yes'): ?>
			<div id="babystreet_page_title" class="babystreet_title_holder <?php echo esc_attr($babystreet_title_alignment) ?> <?php if ($babystreet_title_background_image): ?>title_has_image<?php endif; ?>">
				<?php if ($babystreet_title_background_image): ?><div class="babystreet-zoomable-background" style="background-image: url('<?php echo esc_url($babystreet_title_background_image) ?>');"></div><?php endif; ?>
				<div class="inner fixed">
                    <div class="babystreet-title-text-container">
                        <!-- BREADCRUMB -->
                        <?php if ($babystreet_show_breadcrumb == 'yes'): ?>
                            <?php babystreet_breadcrumb() ?>
                        <?php endif; ?>
                        <!-- END OF BREADCRUMB -->
                        <?php if ($babystreet_show_title_page == 'yes'): ?>
                            <h1	class="heading-title">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                            </h1>
                            <?php if ($babystreet_subtitle): ?>
                                <h6><?php echo esc_html($babystreet_subtitle) ?></h6>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php get_template_part( 'partials/blog-post-meta-bottom' ); ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="inner">
			<!-- CONTENT WRAPPER -->
			<div id="main" class="fixed box box-common">
				<div class="content_holder">
					<?php get_template_part('content', get_post_format()); ?>
					<?php
					if (comments_open() || get_comments_number()) :
						comments_template('', true);
					endif;
					?>
					<?php if (babystreet_get_option('show_related_posts')): ?>
						<?php
						// Get random post from the same category as the current one
						$babystreet_related_posts_args = array(
								'nopaging' => true,
								'post__not_in' => array($post->ID),
								'orderby' => 'rand',
								'post_type' => 'post',
								'post_status' => 'publish'
						);
						$babystreet_get_terms_args = array(
								'orderby' => 'name',
								'order' => 'ASC',
								'fields' => 'slugs'
						);
						$babystreet_categories = wp_get_post_terms($post->ID, 'category', $babystreet_get_terms_args);
						if (!$babystreet_categories instanceof WP_Error && !empty($babystreet_categories)) {
							$babystreet_related_posts_args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'slug', 'terms' => $babystreet_categories));
						}

						$babystreet_is_latest_posts = true;
						query_posts($babystreet_related_posts_args);
						?>
						<?php if (have_posts()) : ?>
							<?php
							// owl carousel
							wp_localize_script('babystreet-libs-config', 'babystreet_owl_carousel', array(
									'include' => 'true'
							));
							?>
							<div class="babystreet-related-blog-posts babystreet_shortcode_latest_posts babystreet_blog_masonry full_width">
								<h4><?php esc_html_e('Related posts', 'babystreet') ?></h4>
								<div <?php if (babystreet_get_option('owl_carousel')): ?> class="owl-carousel babystreet-owl-carousel" <?php endif; ?>>

								<?php while (have_posts()) : ?>
									<?php the_post(); ?>
							        <?php get_template_part('content', 'related-posts'); ?>
								<?php endwhile; ?>

								</div>
								<div class="clear"></div>
							</div>
						<?php endif; ?>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
				</div>

				<!-- SIDEBARS -->
				<?php if ($babystreet_has_sidebar): ?>
					<?php get_sidebar(); ?>
				<?php endif; ?>
				<?php if ($babystreet_has_offcanvas_sidebar): ?>
					<a class="sidebar-trigger" href="#"><?php echo esc_html__('show', 'babystreet') ?></a>
				<?php endif; ?>
				<!-- END OF SIDEBARS -->

				<div class="clear"></div>
				<?php if (function_exists('babystreet_share_links')): ?>
					<?php babystreet_share_links(the_title_attribute( 'echo=0' ), get_permalink()); ?>
				<?php endif; ?>
			</div>

            <!-- Previous / Next links -->
			<?php if (babystreet_get_option('show_prev_next')): ?>
				<?php echo babystreet_post_nav(); ?>
			<?php endif; ?>
		</div>
		<!-- END OF CONTENT WRAPPER -->
	<?php endwhile; // end of the loop.    ?>
</div>
<?php
get_footer();
