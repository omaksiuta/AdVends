<?php
get_header();

// The babystreet-portfolio CPT template file.
// Get the babystreet custom options
$babystreet_page_options = get_post_custom(get_the_ID());

$babystreet_show_title_page = 'yes';
$babystreet_show_breadcrumb = 'yes';
$babystreet_featured_slider = 'none';
$babystreet_rev_slider_before_header = 0;
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

if (isset($babystreet_page_options['babystreet_rev_slider_before_header']) && trim($babystreet_page_options['babystreet_rev_slider_before_header'][0]) != '') {
	$babystreet_rev_slider_before_header = $babystreet_page_options['babystreet_rev_slider_before_header'][0];
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

$babystreet_featured_flex_slider_imgs = babystreet_get_more_featured_images(get_the_ID());

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
<?php while (have_posts()) : the_post(); ?>
	<?php if ($babystreet_has_offcanvas_sidebar): ?>
		<?php get_sidebar('offcanvas'); ?>
	<?php endif; ?>
	<div id="content" <?php if (!empty($babystreet_sidebar_classes)) echo 'class="' . esc_attr(implode(' ', $babystreet_sidebar_classes)) . '"'; ?> >
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
                        <!-- TITLE -->
                        <?php if ($babystreet_show_title_page == 'yes'): ?>
                            <h1 class="heading-title"><?php the_title(); ?></h1>
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
				<?php putRevSlider($babystreet_featured_slider) ?>
			</div>
			<!-- END OF FEATURED REVOLUTION SLIDER -->
		<?php endif; ?>
		<div class="inner">
			<!-- CONTENT WRAPPER -->
			<div id="main" class="fixed box box-common">
				<div class="content_holder">
					<?php $babystreet_curr_portfolio_id = get_the_ID(); ?>
					<?php $babystreet_portfolio_custom = get_post_custom(); ?>
					<?php
					$babystreet_collection = isset($babystreet_portfolio_custom['babystreet_collection']) ? $babystreet_portfolio_custom['babystreet_collection'][0] : '';
					$babystreet_materials = isset($babystreet_portfolio_custom['babystreet_materials']) ? $babystreet_portfolio_custom['babystreet_materials'][0] : '';
					$babystreet_client = isset($babystreet_portfolio_custom['babystreet_client']) ? $babystreet_portfolio_custom['babystreet_client'][0] : '';
					$babystreet_model = isset($babystreet_portfolio_custom['babystreet_model']) ? $babystreet_portfolio_custom['babystreet_model'][0] : '';
					$babystreet_status = isset($babystreet_portfolio_custom['babystreet_status']) ? $babystreet_portfolio_custom['babystreet_status'][0] : '';
					$babystreet_ext_link_button_title = isset($babystreet_portfolio_custom['babystreet_ext_link_button_title']) ? $babystreet_portfolio_custom['babystreet_ext_link_button_title'][0] : '';
					$babystreet_ext_link_button_2_title = isset($babystreet_portfolio_custom['babystreet_ext_link_button_2_title']) ? $babystreet_portfolio_custom['babystreet_ext_link_button_2_title'][0] : '';
					$babystreet_ext_link_url = isset($babystreet_portfolio_custom['babystreet_ext_link_url']) ? $babystreet_portfolio_custom['babystreet_ext_link_url'][0] : '';
					$babystreet_ext_link_url_2 = isset($babystreet_portfolio_custom['babystreet_ext_link_url_2']) ? $babystreet_portfolio_custom['babystreet_ext_link_url_2'][0] : '';

					// What gallery to be used
					$babystreet_prtfl_gallery = isset($babystreet_portfolio_custom['babystreet_prtfl_gallery']) ? $babystreet_portfolio_custom['babystreet_prtfl_gallery'][0] : 'flex';
					// Custom content
					$babystreet_use_custom_content = isset($babystreet_portfolio_custom['babystreet_prtfl_custom_content']) ? $babystreet_portfolio_custom['babystreet_prtfl_custom_content'][0] : 0;
					?>
					<?php if (!$babystreet_use_custom_content): ?>
						<div class="portfolio_top<?php if ($babystreet_prtfl_gallery == 'list'): ?> babystreet_image_list_portfolio<?php endif; ?>" >
							<div class="two_third portfolio-main-image-holder">
								<?php if ($babystreet_prtfl_gallery == 'cloud' && has_post_thumbnail()): ?>
									<!-- Cloud Zoom -->
									<?php
									$babystreet_featured_image_id = get_post_thumbnail_id();

									if ($babystreet_featured_image_id) {
										array_unshift($babystreet_featured_flex_slider_imgs, $babystreet_featured_image_id);
									}

									$babystreet_image_title = the_title_attribute(array('post' => get_post_thumbnail_id(), 'echo' => false));
									$babystreet_image_link = wp_get_attachment_url(get_post_thumbnail_id());
									$babystreet_image = get_the_post_thumbnail(null, 'babystreet-portfolio-single-thumb');
									?>
									<?php echo sprintf('<a id="zoom1" href="%s" itemprop="image" class="cloud-zoom " title="%s"  rel="position: \'inside\' , showTitle: false, adjustX:-4, adjustY:-4">%s</a>', esc_url($babystreet_image_link), esc_attr($babystreet_image_title), $babystreet_image); ?>

									<?php if (!empty($babystreet_featured_flex_slider_imgs)): // If there are additional images show CloudZoom gallery  ?>
										<ul class="additional-images">
											<?php foreach ($babystreet_featured_flex_slider_imgs as $babystreet_img_id): ?>
												<?php
												$babystreet_image_title = the_title_attribute(array('post' => $babystreet_img_id, 'echo' => false));
												$babystreet_image_link = wp_get_attachment_url($babystreet_img_id);
												$babystreet_small_image_link = wp_get_attachment_url($babystreet_img_id, 'babystreet-portfolio-single-thumb');
												$babystreet_thumb_image = wp_get_attachment_image($babystreet_img_id, 'babystreet-widgets-thumb');
												?>
												<li>
													<?php echo sprintf('<a rel="useZoom: \'zoom1\', smallImage: \'%s\'" title="%s" class="cloud-zoom-gallery" href="%s">%s</a>', esc_url($babystreet_small_image_link), esc_attr($babystreet_image_title), esc_url($babystreet_image_link), $babystreet_thumb_image); ?>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								<?php elseif ($babystreet_prtfl_gallery == 'flex' && !empty($babystreet_featured_flex_slider_imgs)): ?>
									<!-- FEATURED SLIDER/IMAGE -->
									<div class="babystreet_flexslider">
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
								<?php elseif ($babystreet_prtfl_gallery == 'list' && has_post_thumbnail()): ?>
									<!-- Image List -->
									<div class="babystreet_image_list">
										<?php if (has_post_thumbnail()): ?>
											<?php $babystreet_attach_url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
											<?php $babystreet_image_title = the_title_attribute(array('post' => get_post_thumbnail_id(), 'echo' => false)); ?>
											<?php $babystreet_img_tag = wp_get_attachment_image(get_post_thumbnail_id(), 'babystreet-portfolio-single-thumb'); ?>
											<?php echo sprintf('<a href="%s" class="babystreet-magnific-gallery-item" title="%s" >%s</a>', esc_url($babystreet_attach_url), esc_attr($babystreet_image_title), $babystreet_img_tag); ?>
										<?php endif; ?>
										<?php foreach ($babystreet_featured_flex_slider_imgs as $babystreet_img_att_id): ?>
											<?php $babystreet_attach_url = wp_get_attachment_url($babystreet_img_att_id); ?>
											<?php $babystreet_image_title = the_title_attribute(array('post' => $babystreet_img_att_id, 'echo' => false)); ?>
											<?php $babystreet_img_tag = wp_get_attachment_image($babystreet_img_att_id, 'babystreet-portfolio-single-thumb'); ?>
											<?php echo sprintf('<a href="%s" class="babystreet-magnific-gallery-item" title="%s" >%s</a>', esc_url($babystreet_attach_url), esc_attr($babystreet_image_title), $babystreet_img_tag); ?>
										<?php endforeach; ?>
									</div>
								<?php elseif (has_post_thumbnail()): ?>
									<?php the_post_thumbnail('babystreet-portfolio-single-thumb'); ?>
								<?php endif; ?>
								<!-- END OF FEATURED SLIDER/IMAGE -->
							</div>
							<div class="one_third last project-data">
								<div class="project-data-holder">
									<?php if ($babystreet_portfolio_custom['babystreet_add_description'][0]): ?>
										<div class="more-details">
											<h4><?php esc_html_e('Short Description', 'babystreet') ?></h4>
											<?php echo wp_kses_post($babystreet_portfolio_custom['babystreet_add_description'][0]) ?>
											<?php
											// Check if the portfolio has features
											$babystreet_has_features = false;

											for ($i = 1; $i <= 10; $i++) {
												if ($babystreet_portfolio_custom['babystreet_feature_' . $i][0]) {
													$babystreet_has_features = true;
												}
											}
											?>
											<?php if ($babystreet_has_features): ?>
												<div class="main-features">
													<h4><?php esc_html_e('Main Features', 'babystreet') ?></h4>
													<ul class="checklist">
														<?php for ($i = 1; $i <= 10; $i++): ?>
															<?php if ($babystreet_portfolio_custom['babystreet_feature_' . $i][0]): ?>
																<li><?php echo esc_html($babystreet_portfolio_custom['babystreet_feature_' . $i][0]) ?></li>
															<?php endif; ?>
														<?php endfor; ?>
													</ul>
												</div>
											<?php endif; ?>
										</div>
									<?php endif; ?>
									<?php
									if ($babystreet_collection || $babystreet_materials || $babystreet_client ||
													$babystreet_model || $babystreet_status || $babystreet_ext_link_button_title || $babystreet_ext_link_url || $babystreet_ext_link_button_2_title || $babystreet_ext_link_url_2):
										?>
										<div class="project-details">
											<h4><?php esc_html_e('Details', 'babystreet') ?></h4>
											<ul class="simple-list-underlined">
												<?php if ($babystreet_client): ?>
                                                    <li><strong><?php esc_html_e('Brand', 'babystreet') ?>:</strong> <?php echo esc_html($babystreet_client) ?></li>
												<?php endif; ?>
												<?php if ($babystreet_collection): ?>
													<li><strong><?php esc_html_e('Collection', 'babystreet') ?>:</strong> <?php echo esc_html($babystreet_collection) ?></li>
												<?php endif; ?>
												<?php if ($babystreet_materials): ?>
													<li><strong><?php esc_html_e('Materials', 'babystreet') ?>:</strong> <?php echo esc_html($babystreet_materials) ?></li>
												<?php endif; ?>
												<?php if ($babystreet_model): ?>
													<li><strong><?php esc_html_e('Model', 'babystreet') ?>:</strong> <?php echo esc_html($babystreet_model) ?></li>
												<?php endif; ?>
												<?php if ($babystreet_status): ?>
													<li><strong><?php esc_html_e('Status', 'babystreet') ?>:</strong> <?php echo esc_html($babystreet_status) ?></li>
												<?php endif; ?>
												<?php if(($babystreet_ext_link_button_title && $babystreet_ext_link_url) || ($babystreet_ext_link_button_2_title && $babystreet_ext_link_url_2)):?>
                                                    <li>
														<?php if ($babystreet_ext_link_button_title && $babystreet_ext_link_url): ?>
                                                            <a class="button" target="_blank" href="<?php echo esc_url($babystreet_ext_link_url) ?>" title="<?php echo esc_attr($babystreet_ext_link_button_title) ?>"><?php echo esc_attr($babystreet_ext_link_button_title) ?></a>
														<?php endif; ?>
														<?php if ($babystreet_ext_link_button_2_title && $babystreet_ext_link_url_2): ?>
                                                            <a class="button babystreet-secondary-button" target="_blank" href="<?php echo esc_url($babystreet_ext_link_url_2) ?>" title="<?php echo esc_attr($babystreet_ext_link_button_2_title) ?>"><?php echo esc_attr($babystreet_ext_link_button_2_title) ?></a>
														<?php endif; ?>
                                                    </li>
												<?php endif; ?>
											</ul>
										</div>
									<?php endif; ?>


								</div>
							</div>
							<div class="clear"></div>
						</div>
					<?php endif; ?>

					<?php if ($post->post_content != ""): ?>
						<div class="full_width babystreet-project-description<?php if ( $babystreet_use_custom_content ) echo ' babystreet-custom-content' ?>">
							<?php the_content(); ?>
						</div>
					<?php endif; ?>
					<?php
					// Get random portfolio projects from the same category as the current one
					$babystreet_get_portfolio_args = array(
							'nopaging' => true,
							'post__not_in' => array($babystreet_curr_portfolio_id),
							'orderby' => 'rand',
							'post_type' => 'babystreet-portfolio',
							'post_status' => 'publish'
					);

					$babystreet_get_terms_args = array(
							'orderby' => 'name',
							'order' => 'ASC',
							'fields' => 'slugs'
					);
					$babystreet_portfolio_categories = wp_get_object_terms(get_the_ID(), 'babystreet_portfolio_category', $babystreet_get_terms_args);
					if (array_key_exists(0, $babystreet_portfolio_categories)) {
						$babystreet_get_portfolio_args['tax_query'] = array(array('taxonomy' => 'babystreet_portfolio_category', 'field' => 'slug', 'terms' => $babystreet_portfolio_categories));
					}

					wp_reset_postdata();

					$babystreet_similar_portfolios = new WP_Query($babystreet_get_portfolio_args);
					?>

					<?php if (babystreet_get_option('show_related_projects')): ?>
						<?php if ($babystreet_similar_portfolios->have_posts()): ?>
							<?php
							// owl carousel
							wp_localize_script('babystreet-libs-config', 'babystreet_owl_carousel', array(
									'include' => 'true'
							));
							?>
							<div class="similar_projects full_width">
								<h4><?php esc_html_e('Similar Styles', 'babystreet') ?></h4>
								<div <?php if (babystreet_get_option('owl_carousel')): ?> class="owl-carousel babystreet-owl-carousel" <?php endif; ?>>
								<?php endif; ?>

								<?php $babystreet_counter = 0; ?>
								<?php while ($babystreet_similar_portfolios->have_posts()): ?>
									<?php $babystreet_similar_portfolios->the_post(); ?>
									<?php
                                    // client name
							        $babystreet_similar_client_name = get_post_meta(get_the_ID(), 'babystreet_client', true);

									$babystreet_counter++;
									$babystreet_current_terms = get_the_terms(get_the_ID(), 'babystreet_portfolio_category');
									$babystreet_current_terms_as_simple_array = array();

									if ($babystreet_current_terms) {
										foreach ($babystreet_current_terms as $babystreet_term) {
											$babystreet_current_terms_as_simple_array[] = $babystreet_term->name;
										}
									}
									?>
									<div class="portfolio-unit babystreet-none-overlay grid-unit <?php //if (($babystreet_counter % 3) == 0) echo 'last'  ?>">
										<div class="portfolio-unit-holder">

											<?php if (has_post_thumbnail()): ?>
                                                <a title="<?php esc_attr_e('View more', 'babystreet') ?>" href="<?php echo esc_url(get_the_permalink(get_the_ID())); ?>" class="babystreet-portfolio-image-link">
                                                    <?php the_post_thumbnail('babystreet-640x640'); ?>
                                                </a>
											<?php else: ?>
												<img src="<?php echo esc_attr(BABYSTREET_IMAGES_PATH . 'cat_not_found.png') ?>" />
											<?php endif; ?>
                                            <div class="portfolio-unit-info">
                                                <a title="<?php esc_attr_e( 'View more', 'babystreet' ) ?>"
                                                   href="<?php the_permalink(); ?>" class="portfolio-link">
                                                    <small><?php if ( $babystreet_similar_client_name ): ?>
                                                            <span class="babystreet-client-name"><?php echo esc_html( $babystreet_similar_client_name ) ?> </span>
														<?php endif; ?>
														<?php the_time( get_option( 'date_format' ) ); ?></small>
                                                    <h4><?php the_title(); ?></h4>
													<?php if ( $babystreet_current_terms ): ?>
                                                        <h6><?php echo wp_kses_post( implode( ' / ', $babystreet_current_terms_as_simple_array ) ) ?></h6>
													<?php endif; ?>
                                                </a>
                                            </div>

										</div>
									</div>
								<?php endwhile; ?>

								<?php wp_reset_postdata(); ?>

								<?php if ($babystreet_similar_portfolios->have_posts()): ?>
								</div>
								<div class="clear"></div>
							</div>
						<?php endif; ?>
					<?php endif; ?>
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
<?php endwhile; ?>
<!-- END OF MAIN CONTENT -->

<?php
get_footer();
