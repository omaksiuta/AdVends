<?php
// Partial to use when displaying babystreet_portfolio_category category, archive and page template
global $wp;

$enable_portfolio_infinite = 'no';
if ( babystreet_get_option( 'enable_portfolio_infinite' ) ) {
	$enable_portfolio_infinite = 'yes';
}
$use_load_more_on_portfolio = 'no';
if ( babystreet_get_option( 'use_load_more_on_portfolio' ) ) {
	$use_load_more_on_portfolio = 'yes';
}
wp_localize_script('babystreet-front', 'babystreet_portfolio_js_params', array(
	'enable_portfolio_infinite' => $enable_portfolio_infinite,
	'use_load_more_on_portfolio' => $use_load_more_on_portfolio
));

if (!isset($babystreet_portfolio_style_class)) {
	$babystreet_portfolio_style_class = 'grid-unit';
}

if (!isset($babystreet_columns_class)) {
	$babystreet_columns_class = 'portfolio-col-3';
}
// If the style is different than grid, we dont need columns
if ($babystreet_portfolio_style_class != 'grid-unit') {
	$babystreet_columns_class = '';
}
// If style is masonary no crop on images
if ($babystreet_portfolio_style_class == 'masonry-unit') {
	$babystreet_thumb_size = 'medium_large';
} else {
	$babystreet_thumb_size = 'babystreet-640x640';
}

// get the gaps style
if (babystreet_get_option('portfoio_cat_display')) {
	$babystreet_gaps_class = 'babystreet-10px-gap';
} else {
	$babystreet_gaps_class = '';
}

$babystreet_subtitle = '';
$babystreet_title_background_image = '';
$babystreet_title_alignment = 'left_title';

if (is_page()) {
// Get the babystreet custom options
	$babystreet_page_options = get_post_custom(get_the_ID());

	$babystreet_show_title_page = 'yes';
	$babystreet_show_breadcrumb = 'yes';
	$babystreet_featured_slider = 'none';
	$babystreet_rev_slider_before_header = 0;

	if (isset($babystreet_page_options['babystreet_show_title_page']) && trim($babystreet_page_options['babystreet_show_title_page'][0]) != '') {
		$babystreet_show_title_page = $babystreet_page_options['babystreet_show_title_page'][0];
	}

	if (isset($babystreet_page_options['babystreet_show_breadcrumb']) && trim($babystreet_page_options['babystreet_show_breadcrumb'][0]) != '') {
		$babystreet_show_breadcrumb = $babystreet_page_options['babystreet_show_breadcrumb'][0];
	}

	if (isset($babystreet_page_options['babystreet_rev_slider']) && trim($babystreet_page_options['babystreet_rev_slider'][0]) != '') {
		$babystreet_featured_slider = $babystreet_page_options['babystreet_rev_slider'][0];
	}

	if (isset($babystreet_page_options['babystreet_rev_slider_before_header']) && trim($babystreet_page_options['babystreet_rev_slider_before_header'][0]) != '') {
		$babystreet_rev_slider_before_header = $babystreet_page_options['babystreet_rev_slider_before_header'][0];
	}

	$babystreet_featured_flex_slider_imgs = babystreet_get_more_featured_images(get_the_ID());

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

	<div id="babystreet_page_title" class="babystreet_title_holder <?php echo esc_attr($babystreet_title_alignment) ?> <?php if ($babystreet_title_background_image): ?>title_has_image<?php endif; ?>">
		<?php if ($babystreet_title_background_image): ?><div class="babystreet-zoomable-background" style="background-image: url('<?php echo esc_url($babystreet_title_background_image) ?>');"></div><?php endif; ?>
		<div class="inner fixed">
            <div class="babystreet-title-text-container">
                <!-- BREADCRUMB -->
                <?php if ((is_page() && $babystreet_show_breadcrumb == 'yes') || !is_page()): ?>
                    <?php babystreet_breadcrumb() ?>
                <?php endif; ?>
                <!-- END OF BREADCRUMB -->
                <?php if (is_tax()): ?>
                    <h1 class="heading-title"><?php single_term_title() ?></h1>
                <?php elseif (is_page() && $babystreet_show_title_page == 'yes'): ?>
                    <h1 class="heading-title"><?php the_title(); ?></h1>
                    <?php if ($babystreet_subtitle): ?>
                        <h6><?php echo esc_html($babystreet_subtitle) ?></h6>
                    <?php endif; ?>
                <?php elseif (!is_page()): ?>
                    <h1 class="heading-title"><?php esc_html_e('Portfolio', 'babystreet') ?></h1>
                <?php endif; ?>
            </div>
		</div>
	</div>
	<div class="inner">
		<!-- CONTENT WRAPPER -->
		<div id="main" class="fixed box box-common">
			<div class="content_holder">
				<?php if (is_page() && !empty($babystreet_featured_flex_slider_imgs)): ?>
					<div class="babystreet_flexslider  post_slide">
						<ul class="slides">
							<?php if (has_post_thumbnail()): ?>
								<li>
									<?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'babystreet-portfolio-single-thumb'); ?>
								</li>
							<?php endif; ?>

							<?php foreach ($babystreet_featured_flex_slider_imgs as $babystreet_img_att_id): ?>
								<li>
									<?php echo wp_get_attachment_image($babystreet_img_att_id, 'babystreet-portfolio-single-thumb'); ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php elseif (is_page() && $babystreet_featured_slider != 'none' && function_exists('putRevSlider') && !$babystreet_rev_slider_before_header): ?>
					<!-- FEATURED REVOLUTION SLIDER -->
					<div class="slideshow">
						<?php putRevSlider($babystreet_featured_slider) ?>
					</div>
					<!-- END OF FEATURED REVOLUTION SLIDER -->
				<?php elseif (is_page() && has_post_thumbnail()): ?>
					<?php the_post_thumbnail('babystreet-portfolio-single-thumb'); ?>
				<?php endif; ?>

				<?php if (is_tax()): ?>
					<?php if (term_description()): ?>
						<div class="portfolio-cat-desc">
							<?php echo wp_kses_post(term_description()); ?>
						</div>
					<?php endif; ?>
					<?php $babystreet_curr_category = get_queried_object(); ?>
					<?php $babystreet_portgolio_categories = array($babystreet_curr_category) ?>
					<?php $babystreet_portfolio_categories = array_merge($babystreet_portgolio_categories, get_term_children($babystreet_curr_category->term_id, 'babystreet_portfolio_category')); ?>
				<?php else: ?>
					<?php $babystreet_portfolio_categories = get_terms('babystreet_portfolio_category'); ?>
				<?php endif; ?>

				<?php if (count($babystreet_portfolio_categories) > 0): ?>
					<div class="babystreet-portfolio-categories">
						<ul>
							<?php if (!is_tax()): ?>
								<li><a class="is-checked" data-filter="*" href="#"><?php esc_html_e('show all', 'babystreet') ?></a></li>
							<?php endif; ?>
							<?php foreach ($babystreet_portfolio_categories as $babystreet_category): ?>
								<?php if (!is_object($babystreet_category)) $babystreet_category = get_term_by('id', $babystreet_category, 'babystreet_portfolio_category') ?>
								<li><a <?php if (is_tax() && get_queried_object()->term_id == $babystreet_category->term_id) echo 'class="is-checked"' ?> data-filter=".<?php echo esc_attr($babystreet_category->slug) ?>" href="#"><?php echo esc_html($babystreet_category->name) ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php $babystreet_counter = 0; ?>
				<?php
				global $query_string;

				if (is_page()) {
					//get all portfolios
					$babystreet_portfolios = new WP_Query('post_type=babystreet-portfolio&post_status=publish&posts_per_page=' . get_option("posts_per_page") . '&paged=' . get_query_var('paged'));
				} else {
					$babystreet_portfolios = new WP_Query($query_string . '&post_type=babystreet-portfolio');
				}
				?>
				<div class="portfolios">
					<?php while ($babystreet_portfolios->have_posts()): ?>
						<?php $babystreet_portfolios->the_post(); ?>
						<?php $babystreet_portfolio = get_post(); ?>
						<?php $babystreet_counter++; ?>
						<?php
						// client name
						$babystreet_similar_client_name = get_post_meta(get_the_ID(), 'babystreet_client', true);

						$babystreet_terms_arr = array();
						$babystreet_current_terms = get_the_terms($babystreet_portfolio->ID, 'babystreet_portfolio_category');
						$babystreet_current_terms_as_simple_array = array();

						if ($babystreet_current_terms) {
							foreach ($babystreet_current_terms as $babystreet_term) {
								$babystreet_current_terms_as_simple_array[] = $babystreet_term->name;

								$babystreet_ancestors = babystreet_get_babystreet_portfolio_category_parents($babystreet_term->term_id);
								foreach ($babystreet_ancestors as $babystreet_term_ancestor) {
									$babystreet_terms_arr[] = $babystreet_term_ancestor->slug;
								}
							}
							$babystreet_terms_arr = array_unique($babystreet_terms_arr);
						}

						$babystreet_portfolio_featured_imgs = babystreet_get_more_featured_images($babystreet_portfolio->ID);

						$babystreet_featured_image_attr = wp_get_attachment_image_src(get_post_thumbnail_id($babystreet_portfolio->ID), 'full');
						$babystreet_featured_image_src = '';
						if ($babystreet_featured_image_attr) {
							$babystreet_featured_image_src = $babystreet_featured_image_attr[0];
						}
						?>
						<div class="portfolio-unit babystreet-none-overlay <?php echo esc_attr(implode(' ', $babystreet_terms_arr)) ?> <?php echo esc_attr($babystreet_portfolio_style_class) ?> <?php echo esc_attr($babystreet_columns_class) ?> <?php echo esc_attr($babystreet_gaps_class) ?>">
							<div class="portfolio-unit-holder">

                                <?php if (has_post_thumbnail($babystreet_portfolio->ID)): ?>
                                    <a title="<?php esc_attr_e('View more', 'babystreet') ?>" href="<?php echo esc_url(get_the_permalink($babystreet_portfolio->ID)); ?>" class="babystreet-portfolio-image-link">
                                        <?php echo get_the_post_thumbnail($babystreet_portfolio->ID, $babystreet_thumb_size); ?>
                                    </a>
                                <?php else: ?>
                                    <img src="<?php echo esc_attr(BABYSTREET_IMAGES_PATH . 'cat_not_found.png') ?>" />
                                <?php endif; ?>
                                <div class="portfolio-unit-info">
                                    <a title="<?php esc_attr_e('View more', 'babystreet') ?>" href="<?php echo esc_url(get_the_permalink($babystreet_portfolio->ID)); ?>" class="portfolio-link">
                                        <small>
                                            <?php if ( $babystreet_similar_client_name ): ?>
                                                <span class="babystreet-client-name"><?php echo esc_html( $babystreet_similar_client_name ) ?> </span>
                                            <?php endif; ?>
                                            <?php the_time(get_option('date_format')); ?>
                                        </small>
                                        <h4><?php echo esc_html(get_the_title($babystreet_portfolio->ID)); ?></h4>
                                        <?php if ($babystreet_current_terms): ?>
                                            <h6><?php echo wp_kses_post(implode(' / ', $babystreet_current_terms_as_simple_array)) ?></h6>
                                        <?php endif; ?>
                                    </a>
                                    <?php if ($babystreet_featured_image_src && babystreet_get_option('show_light_projects')): ?>
                                        <a class="portfolio-lightbox-link" href="<?php echo esc_url($babystreet_featured_image_src) ?>"><span></span></a>
                                    <?php endif; ?>
                                </div>

							</div>
						</div>
					<?php endwhile; ?>
				</div>
                <?php if (!$babystreet_portfolios->have_posts()): ?>
					<p><?php esc_html_e('No Portfolio found. Sorry!', 'babystreet'); ?></p>
				<?php endif; ?>
			</div>
			<!-- SIDEBARS -->
			<?php if ($babystreet_has_sidebar): ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			<?php if ($babystreet_has_offcanvas_sidebar): ?>
				<a class="sidebar-trigger" href="#"><?php echo esc_html__('show', 'babystreet') ?></a>
			<?php endif; ?>
			<!-- END OF IDEBARS -->
			<div class="clear"></div>

			<!-- PAGINATION -->
			<div class="box box-common portfolio-nav babystreet-enabled<?php if(babystreet_get_option('enable_portfolio_infinite')) echo ' babystreet-infinite'; ?>">

                <div class="babystreet-page-load-status">
                    <p class="infinite-scroll-request"><?php esc_html_e( 'Loading', 'babystreet' ); ?>...</p>
                    <p class="infinite-scroll-last"><?php esc_html_e( 'No more items available', 'babystreet' ); ?></p>
                </div>

				<?php if(babystreet_get_option('enable_portfolio_infinite') && babystreet_get_option('use_load_more_on_portfolio')): ?>
                    <div class="babystreet-load-more-container">
                        <button class="babystreet-load-more button"><?php esc_html_e( 'Load More', 'babystreet' ); ?></button>
                    </div>
				<?php endif; ?>

				<?php if (function_exists('babystreet_pagination')) : babystreet_pagination('', $babystreet_portfolios); ?>
				<?php else : ?>

					<div class="navigation group">
						<div class="alignleft next-page-portfolio"><?php next_posts_link(esc_html__('Next &raquo;', 'babystreet')) ?></div>
						<div class="alignright prev-page-portfolio"><?php previous_posts_link(esc_html__('&laquo; Back', 'babystreet')) ?></div>
					</div>

				<?php endif; ?>
			</div>
			<!-- END OF PAGINATION -->

		</div>
		<!-- END OF CONTENT WRAPPER -->
	</div>
</div>