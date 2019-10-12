	<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 *  @package mayosis
 */
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$footerwidgetswitch = get_theme_mod( 'footer_widget_hide','on');
$footeradditonalwidget= get_theme_mod( 'footer_additonal_widget','show');
$footercopyright = get_theme_mod( 'copyright_footer','show');
$footercopyrighttxt = get_theme_mod( 'copyright_text','Copyright 2018 mayosis Studio, All rights reserved!');
?>
	<div class="clearfix"></div>
		<?php if($footerwidgetswitch== 'on'): ?>
	<footer class="main-footer container-fluid">
			<div class="container">
				<div class="footer-row">

	<?php get_template_part( 'templates/main-footer-widget'); ?>
	
	</div>
	<?php if($footeradditonalwidget== 'show'): ?>
	<div class="additional-footer">
	    <?php get_template_part( 'templates/additional-footer-widget'); ?>
	 </div>
	 <?php endif;?>
			</div>
		</footer>
<?php endif;?>
<?php if($footercopyright== 'show'): ?>
		<div class="copyright-footer container-fluid">
			<div class="container">
			    <?php if ($footercopyrighttxt) :?>
				<p class="copyright-text"><?php echo  get_theme_mod( 'copyright_text'); ?></p>
				<?php else:?>
				<p class="copyright-text"><?php esc_html_e('&copy; Allright Reserved 2018','mayosis'); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>
	<!-- End Footer Section-->
</div>
</div>
	
	<a id="back-to-top" href="#" class="back-to-top" role="button"><span class="fa fa-chevron-up"></span></a>
	
<?php wp_footer(); ?>
</body>
<!-- End Main Layout --> 

</html>