	<?php
/**
 * The template for displaying the footer Widget.
 *
 * Contains the closing of the id=main div and all content after
 *
 *  @package mayosis
 */
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$footerwidgetcolumn= get_theme_mod( 'footer_widget_column','five');
$mxone= get_theme_mod( 'column_one_width','25%');
$mxtwo= get_theme_mod( 'column_two_width','20%');
$mxthree= get_theme_mod( 'column_three_width','20%');
$mxfour= get_theme_mod( 'column_four_width','20%');
$mxfive= get_theme_mod( 'column_five_width','25%');
$mxsix= get_theme_mod( 'column_six_width');
?>
<!-- Begin Footer Section-->
	<?php if($footerwidgetcolumn == 'one'): ?>
    <div class="footer-widget mx-one" style="width:<?php echo esc_html($mxone); ?>">
        
				<?php if ( is_active_sidebar( 'footer-one' ) ) : ?>
					<?php dynamic_sidebar( 'footer-one' ); ?>
				<?php endif; ?>
    </div>
    <?php endif;?>

	<?php if($footerwidgetcolumn == 'two'): ?>
	<div class="footer-widget mx-one" style="width:<?php echo esc_html($mxone); ?>">
        	<?php if ( is_active_sidebar( 'footer-one' ) ) : ?>
					<?php dynamic_sidebar( 'footer-one' ); ?>
				<?php endif; ?>
    </div>
    <div class="footer-widget mx-two" style="width:<?php echo esc_html($mxtwo); ?>">
        	<?php if ( is_active_sidebar( 'footer-two' ) ) : ?>
					<?php dynamic_sidebar( 'footer-two' ); ?>
				<?php endif; ?>
    </div>
	<?php endif;?>
	
	
	<?php if($footerwidgetcolumn == 'three'): ?>
	<div class="footer-widget mx-one" style="width:<?php echo esc_html($mxone); ?>">
        	<?php if ( is_active_sidebar( 'footer-one' ) ) : ?>
					<?php dynamic_sidebar( 'footer-one' ); ?>
				<?php endif; ?>
    </div>
    <div class="footer-widget mx-two" style="width:<?php echo esc_html($mxtwo); ?>">
        <?php if ( is_active_sidebar( 'footer-two' ) ) : ?>
					<?php dynamic_sidebar( 'footer-two' ); ?>
				<?php endif; ?>
    </div>
	<div class="footer-widget mx-three" style="width:<?php echo esc_html($mxthree); ?>">
        <?php if ( is_active_sidebar( 'footer-three' ) ) : ?>
					<?php dynamic_sidebar( 'footer-three' ); ?>
				<?php endif; ?>
    </div>
    
	<?php endif;?>
	
	
	<?php if($footerwidgetcolumn == 'four'): ?>
	<div class="footer-widget mx-one" style="width:<?php echo esc_html($mxone); ?>">
        	<?php if ( is_active_sidebar( 'footer-one' ) ) : ?>
					<?php dynamic_sidebar( 'footer-one' ); ?>
				<?php endif; ?>
    </div>
    <div class="footer-widget mx-two" style="width:<?php echo esc_html($mxtwo); ?>">
        <?php if ( is_active_sidebar( 'footer-two' ) ) : ?>
					<?php dynamic_sidebar( 'footer-two' ); ?>
				<?php endif; ?>
    </div>
	<div class="footer-widget mx-three" style="width:<?php echo esc_html($mxthree); ?>">
        <?php if ( is_active_sidebar( 'footer-three' ) ) : ?>
					<?php dynamic_sidebar( 'footer-three' ); ?>
				<?php endif; ?>
    </div>
    
    <div class="footer-widget mx-four" style="width:<?php echo esc_html($mxfour); ?>">
         <?php if ( is_active_sidebar( 'footer-four' ) ) : ?>
					<?php dynamic_sidebar( 'footer-four' ); ?>
				<?php endif; ?>
    </div>
    
	<?php endif;?>
	
	
	<?php if($footerwidgetcolumn == 'five'): ?>
	<div class="footer-widget mx-one" style="width:<?php echo esc_html($mxone); ?>">
        	<?php if ( is_active_sidebar( 'footer-one' ) ) : ?>
					<?php dynamic_sidebar( 'footer-one' ); ?>
				<?php endif; ?>
    </div>
    <div class="footer-widget mx-two" style="width:<?php echo esc_html($mxtwo); ?>">
        <?php if ( is_active_sidebar( 'footer-two' ) ) : ?>
					<?php dynamic_sidebar( 'footer-two' ); ?>
				<?php endif; ?>
    </div>
	<div class="footer-widget mx-three" style="width:<?php echo esc_html($mxthree); ?>">
        <?php if ( is_active_sidebar( 'footer-three' ) ) : ?>
					<?php dynamic_sidebar( 'footer-three' ); ?>
				<?php endif; ?>
    </div>
    
    <div class="footer-widget mx-four" style="width:<?php echo esc_html($mxfour); ?>">
         <?php if ( is_active_sidebar( 'footer-four' ) ) : ?>
					<?php dynamic_sidebar( 'footer-four' ); ?>
				<?php endif; ?>
    </div>
    
    <div class="footer-widget mx-five" style="width:<?php echo esc_html($mxfive); ?>">
         <?php if ( is_active_sidebar( 'footer-five' ) ) : ?>
					<?php dynamic_sidebar( 'footer-five' ); ?>
				<?php endif; ?>
    </div>
    
    
	<?php endif;?>
	
	
		
	<?php if($footerwidgetcolumn == 'six'): ?>
	<div class="footer-widget mx-one" style="width:<?php echo esc_html($mxone); ?>">
        	<?php if ( is_active_sidebar( 'footer-one' ) ) : ?>
					<?php dynamic_sidebar( 'footer-one' ); ?>
				<?php endif; ?>
    </div>
    <div class="footer-widget mx-two" style="width:<?php echo esc_html($mxtwo); ?>">
        <?php if ( is_active_sidebar( 'footer-two' ) ) : ?>
					<?php dynamic_sidebar( 'footer-two' ); ?>
				<?php endif; ?>
    </div>
	<div class="footer-widget mx-three" style="width:<?php echo esc_html($mxthree); ?>">
        <?php if ( is_active_sidebar( 'footer-three' ) ) : ?>
					<?php dynamic_sidebar( 'footer-three' ); ?>
				<?php endif; ?>
    </div>
    
    <div class="footer-widget mx-four" style="width:<?php echo esc_html($mxfour); ?>">
        <?php if ( is_active_sidebar( 'footer-four' ) ) : ?>
					<?php dynamic_sidebar( 'footer-four' ); ?>
				<?php endif; ?>
    </div>
    
    <div class="footer-widget mx-five" style="width:<?php echo esc_html($mxfive); ?>">
         <?php if ( is_active_sidebar( 'footer-five' ) ) : ?>
					<?php dynamic_sidebar( 'footer-five' ); ?>
				<?php endif; ?>
    </div>
    
    <div class="footer-widget mx-six" style="width:<?php echo esc_html($mxsix); ?>">
         <?php if ( is_active_sidebar( 'footer-six' ) ) : ?>
					<?php dynamic_sidebar( 'footer-six' ); ?>
				<?php endif; ?>
    </div>
    
	<?php endif;?>
	
	
	