<?php
// The 404 Page template file.
get_header(); ?>
    <div id="content">
    <div id="babystreet_page_title" class="babystreet_title_holder">
        <div class="inner fixed">
            <div class="babystreet-title-text-container">
                <?php babystreet_breadcrumb() ?>
                <h1 class="heading-title"><?php esc_html_e( 'Page not found', 'babystreet' ) ?></h1>
            </div>
        </div>
    </div>
    <div class="inner">
        <div id="main" class="fixed box box-common">
            <div class="content_holder">
                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'babystreet' ); ?></p>
				<?php get_search_form(); ?>
            </div>
        </div>
    </div>
<?php
get_footer();
