<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OnePress
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">



    <!--//TODO used i rowswitcher @ https://www.itsolutionstuff.com/post/php-dynamic-drag-and-drop-table-rows-using-jquery-ajaxexample.html-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!--//TODO used i rowswitcher @ https://www.itsolutionstuff.com/post/php-dynamic-drag-and-drop-table-rows-using-jquery-ajaxexample.html-->


    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action('onepress_before_site_star'); ?>
<div id="page" class="hfeed site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'onepress'); ?></a>
    <?php
    /**
     * Hooked: onepress_site_header
     *
     * @see onepress_site_header
     */
    do_action('onepress_site_start');
    ?>
