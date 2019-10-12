<?php
/**
 * The Sidebar containing the main widget areas.
 */

$sidebar_show   = sweet_dessert_get_custom_option('show_sidebar_main');
$sidebar_scheme = sweet_dessert_get_custom_option('sidebar_main_scheme');
$sidebar_name   = sweet_dessert_get_custom_option('sidebar_main');

if (!sweet_dessert_param_is_off($sidebar_show) && is_active_sidebar($sidebar_name)) {
	?>
	<div class="sidebar widget_area scheme_<?php echo esc_attr($sidebar_scheme); ?>" role="complementary">
        <div style="<?php

        $show_sidebar_bg = sweet_dessert_get_custom_option('show_sidebar_bg')=='yes';
        $sidebar_bg = sweet_dessert_get_custom_option('sidebar_bg');

        sweet_dessert_show_layout($show_sidebar_bg ? 'background-image: url(' . esc_url($sidebar_bg) . ');' : ''); ?>" class="sidebar_inner widget_area_inner">
            <?php

            ob_start();
			do_action( 'before_sidebar' );
			if (($reviews_markup = sweet_dessert_storage_get('reviews_markup')) != '') {
				?><aside class="column-1_1 widget widget_reviews"><?php sweet_dessert_show_layout($reviews_markup); ?></aside><?php
			}
			sweet_dessert_storage_set('current_sidebar', 'main');
            if ( is_active_sidebar( $sidebar_name ) ) {
                dynamic_sidebar( $sidebar_name );
            }
			do_action( 'after_sidebar' );
			$out = ob_get_contents();
			ob_end_clean();
			sweet_dessert_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $out));
			?>
		</div>
	</div> <!-- /.sidebar -->
	<?php
}
?>