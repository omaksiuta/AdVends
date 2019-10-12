<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'sweet_dessert_template_no_articles_theme_setup' ) ) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_template_no_articles_theme_setup', 1 );
	function sweet_dessert_template_no_articles_theme_setup() {
		sweet_dessert_add_template(array(
			'layout' => 'no-articles',
			'mode'   => 'internal',
			'title'  => esc_html__('No articles found', 'sweet-dessert')
		));
	}
}

// Template output
if ( !function_exists( 'sweet_dessert_template_no_articles_output' ) ) {
	function sweet_dessert_template_no_articles_output($post_options, $post_data) {
		?>
		<article class="post_item">
			<div class="post_content">
				<h2 class="post_title"><?php esc_html_e('No posts found', 'sweet-dessert'); ?></h2>
				<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria.', 'sweet-dessert' ); ?></p>
				<p><?php echo wp_kses_data( sprintf(__('Go back, or return to <a href="%s">%s</a> home page to choose a new page.', 'sweet-dessert'), esc_url(home_url('/')), get_bloginfo()) ); ?>
				<br><?php esc_html_e('Please report any broken links to our team.', 'sweet-dessert'); ?></p>
				<?php if(function_exists('sweet_dessert_sc_search')) sweet_dessert_show_layout(sweet_dessert_sc_search(array('state'=>"fixed"))); ?>
			</div>	<!-- /.post_content -->
		</article>	<!-- /.post_item -->
		<?php
	}
}
?>