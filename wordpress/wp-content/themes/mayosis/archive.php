<?php
/**
 * The template for displaying archive pages.
 *
 * @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
get_header(); ?>


    <div id="main" class="site-main">
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">

                <div id="posts" class="posts">
                    <?php if ( have_posts() ) : ?>


                    <?php

                    if ( is_post_type_archive( 'download' ) || is_tax( array( 'download_category', 'download_tag' ) ) ) : ?>



                    <article content='<?php the_ID(); ?>' id="post-<?php the_ID(); ?>" >

                        <!-- Begin Page Headings Layout -->
                        <div class="archive_bredcrumb_header container-fluid">
                            <div class="container">
                                <h1 class="blog-page-title"><?php single_cat_title( __( '', 'mayosis' ) ); ?></h1>
                                <?php if (function_exists('mayosis_breadcrumbs')) mayosis_breadcrumbs(); ?>

                            </div>
                        </div>
                        <?php $productgridsystem= get_theme_mod( 'product_grid_system','one' );?>
                        <!-- End Page Headings Layout -->
                        <!-- Begin Blog Main Post Layout -->
                        <section class="container product-main-content">
                            <div class="side-main-title">
                                <h2 class="section-title"><?php esc_html_e('All Products From','mayosis'); ?> <?php single_cat_title( __( '', 'mayosis' ) ); ?></h2>
                            </div>
                        <?php if ($productgridsystem=='two'): ?>
                            <?php get_template_part( 'content/content-product-masonary' ); ?>
                        <?php else : ?>
                            <?php get_template_part( 'content/content-product-grid' ); ?>
                        <?php endif; ?>
                            <?php mayosis_page_navs(); ?>
                        </section>

                        <?php else :



                            // Load the default post template
                            get_template_part( 'content/content' );

                            mayosis_page_navs();

                        endif;



                        else :
                             
                            // Load the empty post template
                            get_template_part( 'content/content-none-category' );

                        endif; ?>
                </div><!-- #posts .posts -->

            </div><!-- #content .site-content -->
        </div><!-- #primary .content-area -->


    </div><!-- #main .site-main -->
<?php get_footer(); ?>