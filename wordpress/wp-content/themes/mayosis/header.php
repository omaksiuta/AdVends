<?php
/**
 * The Header for our theme.
 * @package mayosis
 */
  if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
 <head>
<?php
 global $edd_options;
 $favicon = get_theme_mod( 'favicon-upload');
 $headerlayout = get_theme_mod( 'header_layout_type');
 $loaderwebsite = get_theme_mod( 'loader_website','hide');
?>
<!-- Basic Page Info -->
<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Favicon -->
<?php
	if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {			
		if (!empty($favicon)){
		?>
			<link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>" type="image/x-icon" />
			<?php
		}else{
		?>
			<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/fav.png" type="image/x-icon">
		<?php
		}
	}
	?>
<?php
wp_head(); ?>
</head>

<!-- Begin Main Layout --> 
<body <?php
body_class(); ?>>
    
    <?php

if ($loaderwebsite == 'show'): ?>
    <div class="load-mayosis">
 <ul class="loading reversed">
      <li></li>
      <li></li>
      <li></li>
    </ul>
    </div>
<?php endif; ?>
<?php

if ($headerlayout == 'three'): ?>
<div class="sidebar-wrapper">
    <?php else: ?>
    <div class="mayosis-wrapper">
<?php
endif; ?>


<?php

if ($headerlayout): ?>
<?php

if ($headerlayout == 'one'):
	get_template_part( 'templates/main-header'); ?>
<?php
endif; ?>
<?php

if ($headerlayout == 'two'):
	get_template_part( 'templates/center-logo-header'); ?>
<?php
endif; ?>
<?php

if ($headerlayout == 'three'):
	get_template_part( 'templates/sidebar-header'); ?>
<?php
endif; ?>

<?php else: get_template_part( 'templates/main-header'); ?>
<?php endif; ?>