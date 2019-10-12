<?php
defined('ABSPATH') or die();
/**
 * The Sidemenu Header
 *
 * @package mayosis
 * @since mayosis 1.0
 */
$mainlogo= get_theme_mod( 'main_logo' );
$mainlogoicon= get_theme_mod( 'sidebar_logo_icon' );
$defaultsidecollaspe= get_theme_mod( 'default_side_menu' ,'expanded');
$searchshowhide= get_theme_mod( 'search_cartmenu','off' );
$collapsebutton= get_theme_mod( 'collapse_button','on' );
$iconinexpand= get_theme_mod( 'icon_in_expanded','off' );
$textincollapse= get_theme_mod( 'text_in_collapsed','on' );
$secondaryheader= get_theme_mod( 'secondary_header','on' );

global $mayosis_options
?>
<!-- mayosis-sidebar Holder -->
 <?php if($defaultsidecollaspe == 'collapse') :?>
            <aside id="mayosis-sidebar" class="active">
                <?php else: ?>
                <aside id="mayosis-sidebar" class="">
                <?php endif; ?>
                <div class="sidebar-fixed">
                <div class="mayosis-sidebar-header">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="sidebar-main-logo"><img src="<?php echo esc_url($mainlogo);  ?>" class="img-responsive main-logo" alt="<?php esc_html__( 'Logo', 'mayosis' ); ?>"/></a>
                    <strong><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($mainlogoicon);  ?>" class="center-block" alt="<?php esc_html__( 'Icon', 'mayosis' ); ?>"/></a></strong>
                </div>
                <?php if($searchshowhide == 'on') :?>
                <div class="sidebar-option-menu">
	            <ul id="cart-menu" class="mayosis-option-menu">
					<?php get_template_part( 'includes/sidemenu-cart-search' ); ?>
    			</ul>
    			</div>
    			<?php endif; ?>
    			<div class="clearfix"></div>
    			<?php if($iconinexpand == 'on') :?>
    			<div class="show-expand-icon">
    			 <?php else: ?>
    			 <div class="hide-expand-icon">
    			 <?php endif;?>
    			 <?php if($textincollapse == 'on') :?>
    			 <div class="collapse-text-show">
    			     <?php else: ?>
    			     <div class="collapse-text-hide">
    			     <?php endif; ?>
               <?php get_template_part( 'includes/main-navigation' ); ?>
               </div>
               </div>
               </div>
              
            </aside>
              <!-- Page Content Holder -->
              <div id="mayosis-sidebarnav-content" class="container-fluid">
                  	<?php get_template_part( 'includes/mobile-header' ); ?>
              	<?php if($secondaryheader == 'on') :?>
             <?php get_template_part( 'includes/sidebar-second-header' ); ?>
             <?php endif; ?>
