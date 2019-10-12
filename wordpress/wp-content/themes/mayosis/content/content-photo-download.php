<?php
/**
 * The default template for download page content
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
global $post;
$author = get_user_by( 'id', get_query_var( 'author' ) );
$productgallerytype= get_theme_mod( 'product_gallery_type','one');
$download_id = get_the_ID();
$producttemplate= get_theme_mod( 'background_product', 'color');
$download_cats = get_the_term_list( get_the_ID(), 'download_category', '', _x(' , ', '', 'mayosis' ), '' );
$headertransparentmain= get_theme_mod( 'header_transparency','transparent' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <!-- Begin Page Headings Layout -->
        <?php if($headertransparentmain == 'transparent') :?>
            <div class="product-main-header container-fluid main-post-promo">
                <?php if ($producttemplate=='featured'): ?>
                    <?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                    <div class="container-fluid featuredimagebg" style="background:url(<?php echo esc_url($feat_image); ?>) center center;">
                    </div>

                <?php endif; ?>

                <div class="photo--tempalte--top-space"></div>
            </div>

        <?php endif; ?>
        <section class="container">
            <?php if($headertransparentmain == 'transparent') :?>
            <div class="photo-template-author photo-template-stick">
                <?php else : ?>
                <div class="photo-template-author photo-template-none-stick">
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-8 col-xs-12 photo--section--image">

                            <?php $thumb_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

                            <?php $thumb_image_lity = wp_get_attachment_url( get_post_thumbnail_id($post->ID),'thumbnail' ); ?>
                            <a class="photo-image-zoom" data-lity href="<?php echo esc_url($thumb_image_lity); ?>" data-lity-desc="<?php the_title();?>"><i class="fas fa-search-plus"></i></a>
                            <img src="<?php echo esc_url($thumb_image); ?>" alt="featured-image" class="featured-img img-responsive">
                        </div>
                        <div class="col-md-4 col-xs-12 no-paading-left-desktop no-paading-right-desktop photo--credential--box">
                            <div class="photo-credential">
                                <div class="photo--title-block">
                                    <h1><?php the_title(); ?></h1>
                                    <span class="photo-toolspan"><?php esc_html_e("in","mayosis"); ?></span> <?php echo '<span>' . $download_cats . '</span>'; ?>
                                    <span class="photo-toolspan"><?php esc_html_e("on","mayosis"); ?> <?php echo esc_html(get_the_date()); ?></span>
                                </div>

                                <div class="photo--price--block">
                                    <h3><?php
                                        if(edd_has_variable_prices($download_id)){
                                            echo edd_price_range( $download_id );
                                        }
                                        else{
                                            edd_price($download_id);
                                        }
                                        ?></h3>
                                    <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>

                                </div>
                                <?php if(function_exists('mayosis_photosocial')){
                                    mayosis_photosocial();
                                } ?>
                                <div class="photo--template--author--meta">
                                    <div class="photo--author--photo">
                                        <?php echo get_avatar( get_the_author_meta('email'), '40' ); ?>
                                    </div>
                                    <div class="photo--author--details">
                                        <p><?php esc_html_e('Photography By','mayosis'); ?></p>
                                        <h4 class="author--name--photo--template"><?php echo get_the_author_meta( 'display_name');?></h4>
                                    </div>
                                    <div class="photo--author--button">
                                        <a href="<?php echo esc_url(add_query_arg( 'author_downloads', 'true', get_author_posts_url( get_the_author_meta('ID')) )); ?>" class="photo--template--button"><?php esc_html_e('View Portfolio','mayosis'); ?></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

        </section>
        <!-- End Page Headings Layout -->
        <!-- Begin Blog Main Post Layout -->
        <section class="container blog-main-content photo-template-main-content">
            <div class="row">
                <div class="col-md-12">
                    <?php if( '' !== get_post()->post_content ) { ?>
                        <div class="photo--template--content">
                            <?php get_template_part( 'includes/product-gallery' ); ?>
                            <?php the_content(); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <section class="container-fluid bottom-post-footer-widget photo-template-footer-bg">
            <div class="container bottom-product-sidebar photo-template-bottom-similar">
                <h3><?php esc_html_e('Similar Images','mayosis'); ?></h3>
                <div class="justified-grid justified-grid-margin" id="isotope-filter">
                    <?php
                    //Fetch data
                    $exclude_post_id = $post->ID;
                    $taxchoice = isset( $edd_options['related_filter_by_cat'] ) ? 'download_tag' : 'download_category';
                    $custom_taxterms = wp_get_object_terms( $post->ID, $taxchoice, array('fields' => 'ids') );

                    $arguments = array(
                        'post_type' => 'download',
                        'post_status' => 'publish',
                        'posts_per_page' => 7,
                        'order' => 'ASC',
                        'ignore_sticky_posts' => 1,
                        'post__not_in' => array($post->ID),
                        'ignore_sticky_posts'=>1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => $taxchoice,
                                'field' => 'id',
                                'terms' => $custom_taxterms
                            )
                        ),
                    );

                    $post_query = new WP_Query($arguments); ?>
                    <?php if ( $post_query->have_posts() ) : while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
                        <?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                        <a href="<?php
                        the_permalink(); ?>">
                            <img src="<?php echo esc_url($thumbnail); ?>" />
                        </a>
                    <?php endwhile; else: ?>
                        <div class="col-lg-12 pm-column-spacing">
                            <p><?php esc_html_e('No posts were found.', 'mayosis'); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php wp_reset_postdata(); ?>
                </div>
                <div class="bottom_meta product--bottom--tag photo-bottom--tag">
                    <h3><?php esc_html_e('Keywords','mayosis'); ?></h3>
                    <?php $download_tags = get_the_term_list( get_the_ID(), 'download_tag',  ' ', ' '); ?>
                    <?php echo '<span class="tags">' . $download_tags . '</span>'; ?>
                </div>
                <div class="container" id="comment_box">
                    <?php if ( comments_open() || '0' != get_comments_number() ) { ?>
                        <?php comments_template(); ?>
                    <?php } ?>
                </div>
            </div>
        </section>
        <!-- End Blog Main Post Layout-->
    </article>