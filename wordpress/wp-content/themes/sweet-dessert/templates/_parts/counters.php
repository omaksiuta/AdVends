<?php
// Get template args
extract(sweet_dessert_template_get_args('counters'));

$show_all_counters = !empty($post_options['counters']);
$counters_tag = is_single() ? 'span' : 'a';

// Views
if ($show_all_counters && sweet_dessert_strpos($post_options['counters'], 'views')!==false) {
	?>
	<<?php sweet_dessert_show_layout($counters_tag); ?> class="post_counters_item post_counters_views icon-eye-light" title="<?php echo esc_attr( sprintf(esc_attr__('Views - %s', 'sweet-dessert'), $post_data['post_views']) ); ?>" href="<?php echo esc_url($post_data['post_link']); ?>"><span class="post_counters_number"><?php echo esc_attr($post_data['post_views']); echo ' '. esc_html__('views', 'sweet-dessert');?></span><?php if (sweet_dessert_strpos($post_options['counters'], 'captions')!==false) echo ' '.esc_html__('Views', 'sweet-dessert'); ?></<?php sweet_dessert_show_layout($counters_tag); ?>>
	<?php
}

// Comments
if ($show_all_counters && sweet_dessert_strpos($post_options['counters'], 'comments')!==false) {
	?>
	<a class="post_counters_item post_counters_comments icon-comment" title="<?php echo esc_attr( sprintf(esc_attr__('Comments - %s', 'sweet-dessert'), $post_data['post_comments']) ); ?>" href="<?php echo esc_url($post_data['post_comments_link']); ?>"><span class="post_counters_number"><?php echo esc_attr($post_data['post_comments']); echo ' '. esc_html__('comments', 'sweet-dessert'); ?></span></a>
	<?php
}
 
// Rating
$rating = $post_data['post_reviews_'.(sweet_dessert_get_theme_option('reviews_first')=='author' ? 'author' : 'users')];
if ($rating > 0 && ($show_all_counters && sweet_dessert_strpos($post_options['counters'], 'rating')!==false)) {
	?>
	<<?php sweet_dessert_show_layout($counters_tag); ?> class="post_counters_item post_counters_rating icon-star-empty" title="<?php echo esc_attr( sprintf(esc_attr__('Rating - %s', 'sweet-dessert'), $rating) ); ?>" href="<?php echo esc_url($post_data['post_link']); ?>"><span class="post_counters_number"><?php echo esc_attr($rating); ?></span></<?php sweet_dessert_show_layout($counters_tag); ?>>
	<?php
}

// Likes
if ($show_all_counters && sweet_dessert_strpos($post_options['counters'], 'likes')!==false) {
	// Load core messages
	sweet_dessert_enqueue_messages();
	$likes = isset($_COOKIE['sweet_dessert_likes']) ? $_COOKIE['sweet_dessert_likes'] : '';
	$allow = sweet_dessert_strpos($likes, ','.($post_data['post_id']).',')===false;
	?>
	<a class="post_counters_item post_counters_likes icon-heart-empty <?php echo !empty($allow) ? 'enabled' : 'disabled'; ?>" title="<?php echo !empty($allow) ? esc_attr__('Like', 'sweet-dessert') : esc_attr__('Dislike', 'sweet-dessert'); ?>" href="#"
		data-postid="<?php echo esc_attr($post_data['post_id']); ?>"
		data-likes="<?php echo esc_attr($post_data['post_likes']); ?>"
		data-title-like="<?php esc_attr_e('Like', 'sweet-dessert'); ?>"
		data-title-dislike="<?php esc_attr_e('Dislike', 'sweet-dessert'); ?>"><span class="post_counters_number"><?php echo esc_attr($post_data['post_likes']); echo ' '.esc_html__('likes', 'sweet-dessert');?></span></a>
	<?php
}

// Edit page link
if (sweet_dessert_strpos($post_options['counters'], 'edit')!==false) {
	edit_post_link( esc_html__( 'Edit', 'sweet-dessert' ), '<span class="post_edit edit-link">', '</span>' );
}

// Markup for search engines
if (is_single() && sweet_dessert_strpos($post_options['counters'], 'markup')!==false) {
	?>
	<meta itemprop="interactionCount" content="User<?php echo esc_attr(sweet_dessert_strpos($post_options['counters'],'comments')!==false ? 'Comments' : 'PageVisits'); ?>:<?php echo esc_attr(sweet_dessert_strpos($post_options['counters'], 'comments')!==false ? $post_data['post_comments'] : $post_data['post_views']); ?>" />
	<?php
}
?>