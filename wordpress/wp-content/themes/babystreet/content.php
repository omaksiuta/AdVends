<?php
//  The default template for displaying content. Used for both single/archive/search/shortcode.

$babystreet_custom_options = get_post_custom(get_the_ID());

$babystreet_featured_slider = 'none';

if (isset($babystreet_custom_options['babystreet_rev_slider']) && trim($babystreet_custom_options['babystreet_rev_slider'][0]) != '' && function_exists('putRevSlider')) {
	$babystreet_featured_slider = $babystreet_custom_options['babystreet_rev_slider'][0];
}
$babystreet_rev_slider_before_header = 0;
if (isset($babystreet_custom_options['babystreet_rev_slider_before_header']) && trim($babystreet_custom_options['babystreet_rev_slider_before_header'][0]) != '') {
	$babystreet_rev_slider_before_header = $babystreet_custom_options['babystreet_rev_slider_before_header'][0];
}

$babystreet_featured_flex_slider_imgs = babystreet_get_more_featured_images(get_the_ID());

// Blog style
$babystreet_general_blog_style = babystreet_get_option('general_blog_style');

// Featured image size
$babystreet_featured_image_size = 'babystreet-portfolio-single-thumb';

// If is latest posts
if (isset($babystreet_is_latest_posts) && $babystreet_is_latest_posts) { // If is latest post shortcode
    $babystreet_featured_image_size = 'babystreet-640x640';
}

$babystreet_post_classes = array('blog-post');
if (!has_post_thumbnail()) {
	array_push($babystreet_post_classes, 'babystreet-post-no-image');
}

// Show or not the featured image in single post view
if(is_singular(array('post'))) {
	$babystreet_show_feat_image_in_post = 'yes';
	if (isset($babystreet_custom_options['babystreet_show_feat_image_in_post']) && trim($babystreet_custom_options['babystreet_show_feat_image_in_post'][0]) != '') {
		$babystreet_show_feat_image_in_post = $babystreet_custom_options['babystreet_show_feat_image_in_post'][0];
	}
}
?>
<div id="post-<?php the_ID(); ?>" <?php post_class($babystreet_post_classes); ?>>
	<?php // Featured content for post list ?>
    <?php if (!empty($babystreet_featured_flex_slider_imgs) && is_singular()): // if there is slider or featured image attached and it is single post view, display it  ?>
        <div class="babystreet_flexslider post_slide">
            <ul class="slides">
                <?php if (has_post_thumbnail()): ?>
                    <li>
                        <?php echo wp_get_attachment_image(get_post_thumbnail_id(), $babystreet_featured_image_size); ?>
                    </li>
                <?php endif; ?>

                <?php foreach ($babystreet_featured_flex_slider_imgs as $babystreet_img_att_id): ?>
                    <li>
                        <?php echo wp_get_attachment_image($babystreet_img_att_id, $babystreet_featured_image_size); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php if (!is_single()): ?>
                <div class="portfolio-unit-info">
                    <a class="go_to_page go_to_page_blog" title="<?php esc_attr_e('View', 'babystreet') ?>" href="<?php echo esc_url(get_permalink()) ?>"><?php the_title() ?></a>
                </div>
            <?php endif; ?>
        </div>
    <?php elseif (!$babystreet_rev_slider_before_header && $babystreet_featured_slider != 'none' && function_exists('putRevSlider')): ?>
        <div class="slideshow">
            <?php putRevSlider($babystreet_featured_slider) ?>
        </div>
    <?php elseif (has_post_thumbnail() && (!is_single() || is_singular(array('post')) && $babystreet_show_feat_image_in_post == 'yes')): ?>
        <div class="post-unit-holder">
            <?php the_post_thumbnail($babystreet_featured_image_size); ?>
            <?php if (!is_single()): ?>
                <div class="portfolio-unit-info">
                    <a class="go_to_page go_to_page_blog" title="<?php esc_attr_e('View', 'babystreet') ?>" href="<?php echo esc_url(get_permalink()) ?>"><?php the_title() ?></a>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
	<?php // End Featured content for post list ?>

	<div class="babystreet_post_data_holder">
		<?php if ( ! is_singular() ): ?>
			<?php get_template_part( 'partials/blog-post-meta-top' ); ?>
		<?php endif; ?>
		<?php if (!is_single()): ?>
			<h2	class="heading-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h2>
		<?php endif; ?>

		<?php if ( ! is_singular() ): ?>
			<?php get_template_part( 'partials/blog-post-meta-bottom' ); ?>
		<?php endif; ?>

		<?php // SINGLE POST CONTENT ?>
		<?php if (is_single()): ?>
			<?php the_content(); ?>
			<div class="clear"></div>
			<?php if (babystreet_get_option('show_author_info') && (trim(get_the_author_meta('description')))): ?>
				<div class="babystreet-author-info">
					<div class="title">
						<h2><?php echo esc_html__('About the Author:', 'babystreet'); ?> <?php the_author_posts_link(); ?></h2>
					</div>
					<div class="babystreet-author-content">
						<div class="avatar">
							<?php echo get_avatar(get_the_author_meta('email'), 160); ?>
						</div>
						<div class="description">
							<?php the_author_meta("description"); ?>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			<?php endif; ?>
			<?php wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'babystreet'), 'after' => '</div>')); ?>
		<?php else: ?>
			<?php // BLOG / ARCHIVE / CATEGORY / TAG / SEARCH / SHORTCODE POST CONTENT ?>
            <div class="blog-post-excerpt">
				<?php
				if(isset($post->post_content) && strpos( $post->post_content, '<!--more-->' ) ) {
					the_content();
				}
				else {
					echo '<div class="babystreet-defined-excerpt">';
                    the_excerpt();
					echo '</div>';
				}
				?>
            </div>
		<?php endif; ?>
	</div>
</div>