<!-- FOOTER -->
<?php
global $babystreet_is_blank;
?>
<!-- If it is not a blank page template -->
<?php if (!$babystreet_is_blank): ?>
	<div id="footer">
		<?php
		$babystreet_show_footer_logo = false;
		$babystreet_show_footer_menu = false;

		if ( has_nav_menu( 'tertiary' ) ) {
			$babystreet_show_footer_menu = true;
		}
		if ( babystreet_get_option( 'show_logo_in_footer' ) && ( babystreet_get_option( 'theme_logo' ) || babystreet_get_option( 'footer_logo' ) ) ) {
			$babystreet_show_footer_logo = true;
		}
		?>
		<?php if ( $babystreet_show_footer_logo || $babystreet_show_footer_menu ): ?>
            <div class="inner">
				<?php if ( $babystreet_show_footer_menu ): ?>
					<?php
					/* Tertiary menu */
					$babystreet_footer_nav_args = array(
						'theme_location' => 'tertiary',
						'container'      => 'div',
						'container_id'   => 'babystreet_footer_menu_container',
						'menu_class'     => '',
						'menu_id'        => 'babystreet_footer_menu',
						'depth'          => 1,
						'fallback_cb'    => '',
					);
					wp_nav_menu( $babystreet_footer_nav_args );
					?>
				<?php endif; ?>
				<?php if ( $babystreet_show_footer_logo ): ?>
                    <div id="babystreet_footer_logo">
                        <a href="<?php echo esc_url( babystreet_wpml_get_home_url() ); ?>"
                           title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<?php
							$babystreet_theme_logo_img  = babystreet_get_option( 'theme_logo' );
							$babystreet_footer_logo_img = babystreet_get_option( 'footer_logo' );

							// If footer logo, show footer logo, else main logo
							if ( $babystreet_footer_logo_img ) {
								echo wp_get_attachment_image( $babystreet_footer_logo_img, 'full', false );
							} elseif ( $babystreet_theme_logo_img ) {
								echo wp_get_attachment_image( $babystreet_theme_logo_img, 'full', false );
							}
							?>
                        </a>
                    </div>
				<?php endif; ?>
            </div>
		<?php endif; ?>
		<?php
		$babystreet_meta_options = array();
		if (is_single() || is_page()) {
			$babystreet_meta_options = get_post_custom(get_queried_object_id());
		}

		$babystreet_show_sidebar = 'yes';
		if (isset($babystreet_meta_options['babystreet_show_footer_sidebar']) && trim($babystreet_meta_options['babystreet_show_footer_sidebar'][0]) != '') {
			$babystreet_show_sidebar = $babystreet_meta_options['babystreet_show_footer_sidebar'][0];
		}

		$babystreet_footer_sidebar_choice = babystreet_get_option('footer_sidebar');
		if (isset($babystreet_meta_options['babystreet_custom_footer_sidebar']) && $babystreet_meta_options['babystreet_custom_footer_sidebar'][0] !== 'default') {
			$babystreet_footer_sidebar_choice = $babystreet_meta_options['babystreet_custom_footer_sidebar'][0];
		}

		if ( $babystreet_show_sidebar === 'no' ) {
			$babystreet_footer_sidebar_choice = 'none';
		}
		?>
		<?php if (function_exists('dynamic_sidebar') && $babystreet_footer_sidebar_choice != 'none' && is_active_sidebar($babystreet_footer_sidebar_choice)) : ?>
			<div class="inner<?php if($babystreet_footer_sidebar_choice !== 'bottom_footer_sidebar') echo ' babystreet-is-custom-footer-sidebar' ?>">
				<?php dynamic_sidebar($babystreet_footer_sidebar_choice) ?>
				<div class="clear"></div>
			</div>
		<?php endif; ?>
		<div id="powered">
			<div class="inner">
				<!--	Social profiles in footer -->
				<?php if (babystreet_get_option('social_in_footer')): ?>
					<?php get_template_part('partials/social-profiles'); ?>
				<?php endif; ?>

				<div class="author_credits"><?php echo wp_kses_post(babystreet_get_option('copyright_text')) ?></div>
			</div>
		</div>
	</div>
	<!-- END OF FOOTER -->
<?php endif; ?>
</div>
<!-- END OF MAIN WRAPPER -->
<?php
$babystreet_is_compare = false;
if (isset($_GET['action']) && $_GET['action'] === 'yith-woocompare-view-table') {
	$babystreet_is_compare = true;
}

$babystreet_to_include_backgr_video = babystreet_has_to_include_backgr_video($babystreet_is_compare);
?>
<?php if ($babystreet_to_include_backgr_video): ?>
	<?php
	$babystreet_video_bckgr_url = $babystreet_video_bckgr_start = $babystreet_video_bckgr_end = $babystreet_video_bckgr_loop = $babystreet_video_bckgr_mute = '';

	switch ($babystreet_to_include_backgr_video) {
		case 'postmeta':
			$babystreet_custom = babystreet_has_post_video_bckgr();
			$babystreet_video_bckgr_url = isset($babystreet_custom['babystreet_video_bckgr_url'][0]) ? $babystreet_custom['babystreet_video_bckgr_url'][0] : '';
			$babystreet_video_bckgr_start = isset($babystreet_custom['babystreet_video_bckgr_start'][0]) ? $babystreet_custom['babystreet_video_bckgr_start'][0] : '';
			$babystreet_video_bckgr_end = isset($babystreet_custom['babystreet_video_bckgr_end'][0]) ? $babystreet_custom['babystreet_video_bckgr_end'][0] : '';
			$babystreet_video_bckgr_loop = isset($babystreet_custom['babystreet_video_bckgr_loop'][0]) ? $babystreet_custom['babystreet_video_bckgr_loop'][0] : '';
			$babystreet_video_bckgr_mute = isset($babystreet_custom['babystreet_video_bckgr_mute'][0]) ? $babystreet_custom['babystreet_video_bckgr_mute'][0] : '';
			break;
		case 'blog':
			$babystreet_video_bckgr_url = babystreet_get_option('blog_video_bckgr_url');
			$babystreet_video_bckgr_start = babystreet_get_option('blog_video_bckgr_start');
			$babystreet_video_bckgr_end = babystreet_get_option('blog_video_bckgr_end');
			$babystreet_video_bckgr_loop = babystreet_get_option('blog_video_bckgr_loop');
			$babystreet_video_bckgr_mute = babystreet_get_option('blog_video_bckgr_mute');
			break;
		case 'shop':
		case 'shopwide':
			$babystreet_video_bckgr_url = babystreet_get_option('shop_video_bckgr_url');
			$babystreet_video_bckgr_start = babystreet_get_option('shop_video_bckgr_start');
			$babystreet_video_bckgr_end = babystreet_get_option('shop_video_bckgr_end');
			$babystreet_video_bckgr_loop = babystreet_get_option('shop_video_bckgr_loop');
			$babystreet_video_bckgr_mute = babystreet_get_option('shop_video_bckgr_mute');
			break;
		case 'global':
			$babystreet_video_bckgr_url = babystreet_get_option('video_bckgr_url');
			$babystreet_video_bckgr_start = babystreet_get_option('video_bckgr_start');
			$babystreet_video_bckgr_end = babystreet_get_option('video_bckgr_end');
			$babystreet_video_bckgr_loop = babystreet_get_option('video_bckgr_loop');
			$babystreet_video_bckgr_mute = babystreet_get_option('video_bckgr_mute');
			break;
		default:
			break;
	}
	?>
    <div id="bgndVideo" class="babystreet_bckgr_player"
         data-property="{videoURL:'<?php echo esc_url($babystreet_video_bckgr_url) ?>',containment:'body',autoPlay:true, loop:<?php echo esc_js($babystreet_video_bckgr_loop) ? 'true' : 'false'; ?>, mute:<?php echo esc_js($babystreet_video_bckgr_mute) ? 'true' : 'false'; ?>, startAt:<?php echo esc_js($babystreet_video_bckgr_start) ? esc_js($babystreet_video_bckgr_start) : 0; ?>, opacity:.9, showControls:false, addRaster:true, quality:'default'<?php if ($babystreet_video_bckgr_end): ?>, stopAt:<?php echo esc_js($babystreet_video_bckgr_end) ?><?php endif; ?>}">
    </div>
	<?php if (!$babystreet_video_bckgr_mute): ?>
        <div class="video_controlls">
            <a id="video-volume" href="#" onclick="<?php echo esc_js('jQuery("#bgndVideo").YTPToggleVolume()') ?>"><i class="fa fa-volume-up"></i></a>
            <a id="video-play" href="#" onclick="<?php echo esc_js('jQuery("#bgndVideo").YTPPlay()') ?>"><i class="fa fa-play"></i></a>
            <a id="video-pause" href="#" onclick="<?php echo esc_js('jQuery("#bgndVideo").YTPPause()') ?>"><i class="fa fa-pause"></i></a>
        </div>
	<?php endif; ?>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>