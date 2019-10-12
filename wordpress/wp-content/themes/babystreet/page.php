<?php
// The Default Page template file.

get_header();
global $wp_query;

// Get the babystreet custom options
$babystreet_page_options = get_post_custom($wp_query->post->ID);
$babystreet_current_post_type = get_post_type($wp_query->post->ID);

$babystreet_show_title_page = 'yes';
$babystreet_show_breadcrumb = 'yes';
$babystreet_featured_slider = 'none';
$babystreet_rev_slider_before_header = 0;
$babystreet_subtitle = '';
$babystreet_show_title_background = 0;
$babystreet_title_background_image = '';
$babystreet_title_alignment = 'left_title';
$babystreet_featured_flex_slider_imgs = array();

if ( is_singular() && in_array($babystreet_current_post_type, array('page', 'tribe_events')) ) {

	if ( isset( $babystreet_page_options['babystreet_show_title_page'] ) && trim( $babystreet_page_options['babystreet_show_title_page'][0] ) != '' ) {
		$babystreet_show_title_page = $babystreet_page_options['babystreet_show_title_page'][0];
	}

	if ( isset( $babystreet_page_options['babystreet_show_breadcrumb'] ) && trim( $babystreet_page_options['babystreet_show_breadcrumb'][0] ) != '' ) {
		$babystreet_show_breadcrumb = $babystreet_page_options['babystreet_show_breadcrumb'][0];
	}

	if ( isset( $babystreet_page_options['babystreet_rev_slider'] ) && trim( $babystreet_page_options['babystreet_rev_slider'][0] ) != '' ) {
		$babystreet_featured_slider = $babystreet_page_options['babystreet_rev_slider'][0];
	}

	if ( isset( $babystreet_page_options['babystreet_rev_slider_before_header'] ) && trim( $babystreet_page_options['babystreet_rev_slider_before_header'][0] ) != '' ) {
		$babystreet_rev_slider_before_header = $babystreet_page_options['babystreet_rev_slider_before_header'][0];
	}

	if ( isset( $babystreet_page_options['babystreet_page_subtitle'] ) && trim( $babystreet_page_options['babystreet_page_subtitle'][0] ) != '' ) {
		$babystreet_subtitle = $babystreet_page_options['babystreet_page_subtitle'][0];
	}

	if ( isset( $babystreet_page_options['babystreet_title_background_imgid'] ) && trim( $babystreet_page_options['babystreet_title_background_imgid'][0] ) != '' ) {
		$babystreet_img                    = wp_get_attachment_image_src( $babystreet_page_options['babystreet_title_background_imgid'][0], 'full' );
		$babystreet_title_background_image = $babystreet_img[0];
	}

	if ( isset( $babystreet_page_options['babystreet_title_alignment'] ) && trim( $babystreet_page_options['babystreet_title_alignment'][0] ) != '' ) {
		$babystreet_title_alignment = $babystreet_page_options['babystreet_title_alignment'][0];
	}

	$babystreet_featured_flex_slider_imgs = babystreet_get_more_featured_images($wp_query->post->ID);
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

// Title and events
$babystreet_events_mode_and_title = babystreet_get_current_events_display_mode_and_title( $wp_query->post->ID );
$babystreet_title                 = $babystreet_events_mode_and_title['title'];
$babystreet_events_mode           = $babystreet_events_mode_and_title['display_mode'];

if ( BABYSTREET_IS_EVENTS && in_array( $babystreet_events_mode, array(
		'MAIN_CALENDAR',
		'CALENDAR_CATEGORY',
		'MAIN_EVENTS',
		'CATEGORY_EVENTS',
		'SINGLE_EVENT_DAYS'
	) )
) {
	$babystreet_img                   = wp_get_attachment_image_src( babystreet_get_option( 'events_title_background_imgid' ), 'full' );
	if ( $babystreet_img ) {
		$babystreet_title_background_image = $babystreet_img[0];
	}
	$babystreet_subtitle        = babystreet_get_option( 'events_subtitle' );
	$babystreet_title_alignment = babystreet_get_option( 'events_title_alignment' );

}
// END title and events
?>
<?php if ($babystreet_has_offcanvas_sidebar): ?>
	<?php get_sidebar('offcanvas'); ?>
<?php endif; ?>
<div id="content" <?php if (!empty($babystreet_sidebar_classes)) echo 'class="' . esc_attr(implode(' ', $babystreet_sidebar_classes)) . '"'; ?> >
	<?php if ($babystreet_show_title_page == 'yes' || $babystreet_show_breadcrumb == 'yes'): ?>
		<div id="babystreet_page_title" class="babystreet_title_holder <?php echo esc_attr($babystreet_title_alignment) ?> <?php if ($babystreet_title_background_image): ?>title_has_image<?php endif; ?>">
			<?php if ($babystreet_title_background_image): ?>
				<div class="babystreet-zoomable-background" style="background-image: url('<?php echo esc_url($babystreet_title_background_image) ?>');"></div>
			<?php endif; ?>
			<div class="inner fixed">
                <div class="babystreet-title-text-container">
                    <!-- BREADCRUMB -->
                    <?php if ($babystreet_show_breadcrumb == 'yes'): ?>
                        <?php babystreet_breadcrumb() ?>
                    <?php endif; ?>
                    <!-- END OF BREADCRUMB -->
                    <!-- TITLE -->
                    <?php if ($babystreet_show_title_page == 'yes'): ?>
                        <h1 class="heading-title"><?php echo wp_filter_post_kses($babystreet_title); ?></h1>
                        <?php if ($babystreet_subtitle): ?>
                            <h6><?php echo esc_html($babystreet_subtitle) ?></h6>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!-- END OF TITLE -->
                </div>
			</div>
		</div>
	<?php endif; ?>
	<?php if ($babystreet_featured_slider != 'none' && function_exists('putRevSlider') && !$babystreet_rev_slider_before_header): ?>
		<!-- FEATURED REVOLUTION SLIDER -->
		<div class="slideshow">
			<div class="inner">
				<?php putRevSlider($babystreet_featured_slider) ?>
			</div>
		</div>
		<!-- END OF FEATURED REVOLUTION SLIDER -->
	<?php endif; ?>
	<div class="inner">
		<!-- CONTENT WRAPPER -->
		<div id="main" class="fixed box box-common">
			<div class="content_holder">
				<?php if ( is_singular() ): ?>
					<?php if ( ! empty( $babystreet_featured_flex_slider_imgs ) ): ?>
						<div class="babystreet_flexslider post_slide">
							<ul class="slides">
								<?php if ( has_post_thumbnail( $wp_query->post->ID ) ): ?>
									<li>
										<?php echo wp_get_attachment_image( get_post_thumbnail_id( $wp_query->post->ID ), 'babystreet-portfolio-single-thumb' ); ?>
									</li>
								<?php endif; ?>

								<?php foreach ( $babystreet_featured_flex_slider_imgs as $babystreet_img_att_id ): ?>
									<li>
										<?php echo wp_get_attachment_image( $babystreet_img_att_id, 'babystreet-portfolio-single-thumb' ); ?>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php elseif ( has_post_thumbnail( $wp_query->post->ID ) ): ?>
						<?php echo get_the_post_thumbnail( $wp_query->post->ID, 'babystreet-portfolio-single-thumb' ); ?>
					<?php endif; ?>
				<?php endif; ?>

				<?php while (have_posts()) : the_post(); ?>
					<?php get_template_part('content', 'page'); ?>
					<?php comments_template('', true); ?>
				<?php endwhile; // end of the loop.  ?>
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
</div>
<!-- END OF MAIN CONTENT -->

<?php
get_footer();
