<?php
// The main template file.

get_header();

// show Blog title
$babystreet_show_blog_title = babystreet_get_option('show_blog_title');
// get Blog title
$babystreet_blog_title = babystreet_get_option('blog_title');
// get Blog subtitle
$babystreet_blog_subtitle = babystreet_get_option('blog_subtitle');
$babystreet_title_background_image = babystreet_get_option('blog_title_background_imgid');

if ($babystreet_title_background_image) {
	$babystreet_img = wp_get_attachment_image_src($babystreet_title_background_image, 'full');
	$babystreet_title_background_image = $babystreet_img[0];
}

// Blog style
$babystreet_general_blog_style = babystreet_get_option('general_blog_style');
switch ($babystreet_general_blog_style) {
	case 'babystreet_blog_masonry':
		// Isotope settings
		wp_localize_script('babystreet-libs-config', 'babystreet_masonry_settings', array(
				'include' => 'true'
		));
		break;
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
$babystreet_sidebar_classes[] =  apply_filters('babystreet_left_sidebar_position_class', '');
?>
<?php if ($babystreet_has_offcanvas_sidebar): ?>
	<?php get_sidebar('offcanvas'); ?>
<?php endif; ?>
<div id="content" <?php if (!empty($babystreet_sidebar_classes)) echo 'class="' . esc_attr(implode(' ', $babystreet_sidebar_classes)) . '"'; ?> >
	<?php if (babystreet_is_blog() && $babystreet_show_blog_title || babystreet_breadcrumb()): ?>
		<div id="babystreet_page_title" class="babystreet_title_holder <?php echo esc_attr(babystreet_get_option('blog_title_alignment')) ?> <?php if ($babystreet_title_background_image): ?>title_has_image<?php endif; ?>">
			<?php if ($babystreet_title_background_image): ?><div class="babystreet-zoomable-background" style="background-image: url('<?php echo esc_url($babystreet_title_background_image) ?>');"></div><?php endif; ?>
			<div class="inner fixed">
                <div class="babystreet-title-text-container">
                    <!-- BREADCRUMB -->
                    <?php babystreet_breadcrumb() ?>
                    <!-- END OF BREADCRUMB -->
                    <!-- TITLE -->
                    <?php if (babystreet_is_blog() && $babystreet_show_blog_title): ?>
                        <h1 class="heading-title"><?php echo esc_html($babystreet_blog_title); ?></h1>
                        <?php if ($babystreet_blog_subtitle): ?>
                            <h6><?php echo esc_html($babystreet_blog_subtitle) ?></h6>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!-- END OF TITLE -->
                </div>
			</div>
		</div>
	<?php endif; ?>
	<div class="inner">
		<!-- CONTENT WRAPPER -->
		<div id="main" class="fixed box box-common">
			<div class="content_holder<?php if($babystreet_general_blog_style) echo ' '.esc_attr($babystreet_general_blog_style); ?>">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<!-- BLOG POST -->
						<?php get_template_part('content', get_post_format()); ?>
						<!-- END OF BLOG POST -->

						<?php
					endwhile;
				else:
					?>
					<?php get_template_part('content', 'none'); ?>
				<?php endif; ?>

			<!-- PAGINATION -->
			<div class="box box-common">
				<?php
				if (function_exists('babystreet_pagination')) : babystreet_pagination();
				else :
					?>

					<div class="navigation group">
						<div class="alignleft"><?php next_posts_link(esc_html__('Next &raquo;', 'babystreet')) ?></div>
						<div class="alignright"><?php previous_posts_link(esc_html__('&laquo; Back', 'babystreet')) ?></div>
					</div>

				<?php endif; ?>
			</div>
			<!-- END OF PAGINATION -->
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

		</div>
		<!-- END OF CONTENT WRAPPER -->
        <!-- Previous / Next links -->
		<?php if (babystreet_get_option('show_prev_next')): ?>
			<?php echo babystreet_post_nav(); ?>
		<?php endif; ?>
	</div>
</div>
<?php
get_footer();
