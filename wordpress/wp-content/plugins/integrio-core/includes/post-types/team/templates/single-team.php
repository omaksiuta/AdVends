<?php

$sb = Integrio_Theme_Helper::render_sidebars();
$row_class = $sb['row_class'];
$column = $sb['column'];

$defaults = array(
    'title' => '',
    'posts_per_line' => '2',
    'grid_gap' => '',
    'info_align' => 'center',
    'single_link_wrapper' => false,
    'single_link_heading' => true,
    'hide_title' => false,
    'hide_department' => false,
    'hide_soc_icons' => false,
);

extract($defaults);
$team_image_dims = array('width' => '860', 'height' => '1000');

get_header ();
?>

<div class="wgl-container">
	<div class="row<?php echo esc_attr($row_class); ?>">
		<div id='main-content' class="wgl_col-<?php echo (int)$column; ?>">
			<?php
			while ( have_posts() ):
				the_post();
			?>
				<div class="row single_team_page">
					<div class="wgl_col-12">
						<?php echo render_wgl_team_item(true, $defaults, $team_image_dims); ?>
					</div>
					<div class="wgl_col-12">
						<!-- <div class="team_title"><h2><?php echo get_the_title(); ?></h2></div> -->
						<?php the_content(esc_html__( 'Read more!', 'integrio' )); ?>
					</div>
				</div>
			<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		<?php echo (isset($sb['content']) && !empty($sb['content']) ) ? $sb['content'] : ''; ?>
	</div>
</div>

<?php
get_footer();
?>