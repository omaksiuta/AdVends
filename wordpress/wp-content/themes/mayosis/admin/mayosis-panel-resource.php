<?php
 $smartsticky= get_theme_mod( 'smart_sticky','on');
 $rtlmode= get_theme_mod( 'rtl_mode','off');
if ($smartsticky== 'on'):
    add_action('wp_enqueue_scripts', 'mayosis_smart');
function mayosis_smart()
{
    wp_enqueue_script('mayosis-smart-min-stickyu', get_template_directory_uri() . '/js/smart.sticky.min.js', array(), '0.9.4', true);
    wp_enqueue_script('mayosis-smart-sticky', get_template_directory_uri() . '/js/sticky.js', array(), '1.0', true);
}
   
    else:
         add_action('wp_enqueue_scripts', 'mayosis_sticky');
function mayosis_sticky()
{
    wp_enqueue_script('mayosis-sticky', get_template_directory_uri() . '/js/standard.sticky.js', array(), '1.1', true);
}
    endif;
    
    if ( $rtlmode== 'on'): {
        
            add_action('wp_enqueue_scripts', 'mayosis_main_rtl');
function mayosis_main_rtl()
{
   wp_enqueue_style('mayosis-main', get_template_directory_uri() . '/css/main.rtl.min.css');
}
   }
   
   
    else:
        
        
         add_action('wp_enqueue_scripts', 'mayosis_main_ltr');
function mayosis_main_ltr()
{
   wp_enqueue_style('mayosis-main', get_template_directory_uri() . '/css/main.min.css');
}
 endif;