<?php
/**
 * Insert the customized css from selected options on wp_head hook + the custom css
 */
add_action('wp_enqueue_scripts', 'babystreet_add_custom_css', 99);

if (!function_exists('babystreet_add_custom_css')) {

    function babystreet_add_custom_css()
    {
        ob_start();
        ?>
        <style media="all" type="text/css">
            /* Site main accent color */
            .babystreet_content_slider.babystreet_content_slider_light_nav .owl-nav .owl-next, .babystreet_content_slider.babystreet_content_slider_light_nav .owl-nav .owl-prev, div.widget_categories ul li.current-cat > a:before, ul.tabs li.active a, ul.tabs a:hover, #babystreet_price_range, ul.woocommerce-order-overview.woocommerce-thankyou-order-details.order_details li:before, .prod_hold .price_hold, p.product.woocommerce.add_to_cart_inline, .babystreet-promo-wrapper .babystreet-promo-text, .babystreet-related-blog-posts div.post.blog-post.babystreet-post-no-image .babystreet_post_data_holder h2.heading-title:before, button.single_add_to_cart_button:before, .links a.button.add_to_cart_button:after, .links a.button.add_to_cart_button.ajax_add_to_cart:after, #babystreet-account-holder.babystreet-user-is-logged .babystreet-header-account-link-holder > ul li a:hover:before, .commentlist ul.children:before, .infinite-scroll-request:before, .widget_layered_nav_filters li a:before, .links a.button.add_to_cart_button:after, .links a.button.add_to_cart_button.ajax_add_to_cart:after, div.prod_hold .name sup, #main-menu li ul.sub-menu li a sup, div.prod_hold .name sub, #content div.product div.summary h1.heading-title sup, #content div.product div.summary h1.heading-title sub, .babystreet-spec-dot, .count_holder .count_info:before, .babystreet-pricing-table-shortcode .title-icon-holder, .count_holder .count_info_left:before, .widget_layered_nav ul li:hover .count, .widget_layered_nav ul li.chosen a, .widget_product_categories ul li:hover > .count, .widget_product_categories ul li.current-cat > a, .widget_layered_nav ul li:hover a:before, .widget_product_categories ul li:hover a:before, .wpb_babystreet_banner a span.babystreet_banner-icon, .babystreet-event-countdown .is-countdown, .video_controlls a#video-volume:after, div.widget_categories ul li > a:hover:before, #main-menu ul.menu > li > a:hover, #main-menu ul.menu > li.current-menu-item > a, .otw-input-wrap:before, .prod_hold .price_hold:before, a.bbp-forum-title:hover, .portfolio_top .project-data .main-features .checklist li:before, body.babystreet_transparent_header #main-menu ul.menu > li.current-menu-item > a:before, body.babystreet_transparent_header #main-menu ul.menu > li.current-menu-item > a:before, body.babystreet_transparent_header #main-menu ul.menu > li > a:hover:before {
                color: <?php echo esc_attr(babystreet_get_option('accent_color')) ?>;
            }

            .portfolio-unit-info a.portfolio-lightbox-link, blockquote, q, .wp-block-pullquote:not(.is-style-solid-color), .babystreet-product-slider .owl-nav .owl-next, .babystreet-product-slider .owl-nav .owl-prev, .babystreet_image_list .owl-nav .owl-prev, .babystreet_image_list .owl-nav .owl-next, figure.woocommerce-product-gallery__wrapper .owl-nav .owl-prev, figure.woocommerce-product-gallery__wrapper .owl-nav .owl-next, .babystreet_content_slider .owl-nav .owl-next, .babystreet_content_slider .owl-nav .owl-prev, .woocommerce.owl-carousel .owl-nav .owl-next, .woocommerce.owl-carousel .owl-nav .owl-prev, .related.products .owl-nav .owl-prev, .related.products .owl-nav .owl-next, .similar_projects .owl-nav .owl-prev, .similar_projects .owl-nav .owl-next, .babystreet-portfolio-shortcode .owl-nav .owl-prev, .babystreet-portfolio-shortcode .owl-nav .owl-next, .babystreet_shortcode_latest_posts .owl-nav .owl-prev, .babystreet_shortcode_latest_posts .owl-nav .owl-next, .babystreet-quickview-images .owl-nav .owl-prev, .babystreet-quickview-images .owl-nav .owl-next, .tribe-mini-calendar-event .list-date, #spinner, .babystreet-search-cart-holder:before, .widget_shopping_cart_content p.buttons .button.checkout, .babystreet-wcs-swatches .swatch.swatch-label.selected, .babystreet-wcs-swatches .swatch.swatch-label:hover, .is-babystreet-video .mfp-iframe-holder .mfp-content .mfp-close, a#cancel-comment-reply-link, blockquote:before, q:before, .commentlist li .comment-body:hover .comment-reply-link, a.babystreet-post-nav .entry-info-wrap:after, .babystreet-author-info .title a:after, #comments h3.heading-title span.babystreet_comments_count, #comments h3.heading-title span.babystreet_comments_count, div.babystreet_whole_banner_wrapper:after, .blog-post:hover > .babystreet_post_data_holder h2.heading-title a:after, .wpb_text_column h6 a:hover:after, .wpb_text_column h5 a:hover:after, .wpb_text_column p a:hover:after, .blog-post-meta.post-meta-top .count_comments a, div:not(.babystreet_blog_masonry) > .blog-post.sticky .babystreet_post_data_holder:before, .wcmp_vendor_list .wcmp_sorted_vendors:before, .tribe-events-list div.type-tribe_events .tribe-events-event-cost, .tribe-events-schedule .tribe-events-cost, .woocommerce form.track_order input.button, #bbpress-forums li.bbp-body ul.forum:hover, #bbpress-forums li.bbp-body ul.topic:hover, .woocommerce-shipping-fields input[type="checkbox"]:checked + span:before, .widget_product_categories ul li.current-cat > .count, .widget_layered_nav ul li.chosen .count, .bypostauthor > .comment-body img.avatar, div.product-category.product a h2:after, .babystreet_added_to_cart_notification, #yith-wcwl-popup-message, .babystreet-iconbox h5:after, .babystreet-pricing-heading h5:after, .babystreet_title_holder.centered_title .inner h1.heading-title:before, a.sidebar-trigger, td.tribe-events-present > div:first-of-type, a.mob-close-toggle:hover, .pagination .links a:hover, .dokan-pagination-container .dokan-pagination li a:hover, a.mob-menu-toggle i, .bbp-pagination-links a:hover, .babystreet_content_slider .owl-dot.active span, #main-menu ul.menu > li > a .babystreet-custom-menu-label, .product-category.product h2 mark:after, #main-menu li ul.sub-menu li.babystreet_colum_title > a:after, #main-menu li ul.sub-menu li.babystreet_colum_title > a:before, .blog-post-meta span.sticky_post, .babystreet_image_list a.babystreet-magnific-gallery-item:before, #bbpress-forums > #subscription-toggle a.subscription-toggle, .widget > h3:first-child:before, h2.widgettitle:before, .widget > h3:first-child:after, .babystreet-portfolio-categories ul li a:hover:before, .babystreet-portfolio-categories ul li a.is-checked:before, .babystreet-portfolio-categories ul li a:hover:after, .babystreet-portfolio-categories ul li a.is-checked:after, .flex-direction-nav a, ul.status-closed li.bbp-topic-title .bbp-topic-permalink:before, ul.sticky li.bbp-topic-title .bbp-topic-permalink:before, ul.super-sticky li.bbp-topic-title .bbp-topic-permalink:before {
                background-color: <?php echo esc_attr(babystreet_get_option('accent_color')) ?>;
            }
            .widget_shopping_cart_content p.buttons .button.checkout {
                box-shadow: 0 0 0 3px <?php echo esc_attr(babystreet_get_option('accent_color')) ?>;
            }

            .babystreet_image_list a.babystreet-magnific-gallery-item:after, .gallery-item dt a:after, .gallery-item dd a:after, .blocks-gallery-item a:after, .babystreet-user-is-logged .babystreet-header-account-link-holder > ul li, .wpb_single_image a.prettyphoto:before, div.woocommerce-product-gallery__image a:before {
                background-color: <?php echo esc_attr(babystreet_get_option('accent_color')) ?>;
                box-shadow: 0 0 0 3px <?php echo esc_attr(babystreet_get_option('accent_color')) ?>;
            }

            .bbp-topics-front ul.super-sticky:hover, .box-sort-filter .ui-slider-horizontal .ui-slider-handle, .widget_price_filter .ui-slider-handle.ui-state-default.ui-corner-all, .bbp-topics ul.super-sticky:hover, .bbp-topics ul.sticky:hover, .bbp-forum-content ul.sticky:hover {
                background-color: <?php echo esc_attr(babystreet_get_option('accent_color')) ?> !important;
            }
 
            ul.commentlist > li.pingback {border-left-color: <?php echo esc_attr(babystreet_get_option('accent_color')) ?> !Important;}

            div:not(.sidebar) div.widget_search input[type="text"]:focus, div:not(.sidebar) div.widget_product_search input[type="text"]:focus, .portfolio-unit-info a.portfolio-lightbox-link:before, .flex-direction-nav a:after, .babystreet_content_slider .owl-dot.active span:after, .bypostauthor > .comment-body:before, .babystreet-product-slider .count_holder, ul.tabs li.active a, ul.tabs a:hover, .owl-next:before, .owl-prev:before, .babystreet_title_holder .inner .babystreet-title-text-container:before, #spinner:before, blockquote, q, .sidebar.off-canvas-sidebar, .babystreet-author-info, body > div.widget.woocommerce.widget_shopping_cart, .commentlist li .comment-body:hover:before, .commentlist li .comment-body:hover:after, .babystreet-header-account-link-holder, .is-babystreet-video .mfp-iframe-holder .mfp-content, body > #search, .babystreet-quick-view-lightbox .mfp-content, .babystreet-icon-teaser-lightbox .mfp-content, div:not(.babystreet_blog_masonry) > .blog-post.sticky .babystreet_post_data_holder, #bbpress-forums li.bbp-body ul.forum:hover, #bbpress-forums li.bbp-body ul.topic:hover, div.product div.images ol.flex-control-nav li img.flex-active, div.product div.images ol.flex-control-nav li:hover img, .bbp-topics-front ul.super-sticky, .widget_layered_nav ul li:hover .count, .widget_layered_nav ul li.chosen .count, .widget_product_categories ul li.current-cat > .count, .widget_product_categories ul li:hover .count, #main-menu li ul.sub-menu li.babystreet-highlight-menu-item:after, .error404 div.blog-post-excerpt, .babystreet-none-overlay.babystreet-10px-gap .portfolio-unit-holder:hover, .portfolio-unit-info a.portfolio-lightbox-link:hover, body table.booked-calendar td.today .date span, .vc_tta-color-white.vc_tta-style-modern .vc_tta-tab.vc_active > a, .bbp-topics ul.super-sticky, .bbp-topics ul.sticky, .bbp-forum-content ul.sticky, .babystreet-pulsator-accent .wpb_wrapper:after {
                border-color: <?php echo esc_attr(babystreet_get_option('accent_color')) ?> !Important;
            }

            ::-moz-selection {
                background: <?php echo esc_attr(babystreet_get_option('accent_color')) ?>;
            }

            ::selection {
                background: <?php echo esc_attr(babystreet_get_option('accent_color')) ?>;
            }

            /* Links color */
            a, div.widget_categories ul li a:hover, nav.woocommerce-MyAccount-navigation ul li a:hover, nav.woocommerce-MyAccount-navigation ul li.is-active a, div.widget_nav_menu ul li a:hover, div.widget_archive ul li a:hover, div.widget_recent_comments ul li a:hover, div.widget_pages ul li a:hover, div.widget_links ul li a:hover, div.widget_recent_entries ul a:hover, div.widget_meta ul li a:hover, div.widget_display_forums ul li a:hover, .widget_display_replies ul li a:hover, .widget_display_topics li > a.bbp-forum-title:hover, .widget_display_stats dt:hover, .widget_display_stats dd:hover, div.widget_display_views ul li a:hover, .widget_layered_nav ul li a:hover, .widget_product_categories ul li a:hover {
                color: <?php echo esc_attr(babystreet_get_option('links_color')) ?>;
            }

            /* Links hover color */
            a:hover {
                color: <?php echo esc_attr(babystreet_get_option('links_hover_color')) ?>;
            }

            /* Widgets Title Color */
            .sidebar .widget > h3:first-of-type, .sidebar .widget h2.widgettitle, .wpb_widgetised_column .box h3:first-of-type, h2.wpb_flickr_heading {
                background-color: <?php echo esc_attr(babystreet_get_option('sidebar_titles_color')) ?>;
            }

            /* Buttons Default style */
            <?php if (babystreet_get_option('all_buttons_style') === 'round'): ?>
            .babystreet-wcs-swatches .swatch {
                border-radius: 50%;
                -webkit-border-radius: 50%;
                -moz-border-radius: 50%;
            }

            span.onsale, .babystreet-search-cart-holder:before, .babystreet-search-cart-holder:after {
                -webkit-border-radius: 3em;
                -moz-border-radius: 3em;
                border-radius: 3em;
            }

            .count_holder .count_info {
                -webkit-border-radius: 3px 3em 3em 3px;
                -moz-border-radius: 3px 3em 3em 3px;
                border-radius: 3px 3em 3em 3px;
            }

            .count_holder .count_info_left {
                -webkit-border-radius: 3em 3px 3px 3em;
                -moz-border-radius: 3em 3px 3px 3em;
                border-radius: 3em 3px 3px 3em;
            }

            .product-type-external .count_holder .count_info_left {
                border-radius: 3em 3em 3em 3em;
            }

            div:not(.sidebar) div.widget_search input[type="text"], div:not(.sidebar) div.widget_product_search input[type="text"], a.button, .r_more_blog, a.mob-menu-toggle i, a.mob-menu-toggle i:after, .wishlist_table .links a.button.add_to_cart_button, .wcv-navigation ul.menu.horizontal li a, form .vendor_sort select, .wcv-pro-dashboard input[type="submit"], .babystreet-pricing-table-button a, .widget_display_search input#bbp_search, #bbpress-forums > #subscription-toggle a.subscription-toggle, .bbp-topic-title span.bbp-st-topic-support, div.quantity, .babystreet-wcs-swatches .swatch.swatch-label, .babystreet_banner_buton, .woocommerce .wishlist_table td.product-add-to-cart a.button, .widget_shopping_cart_content p.buttons .button, input.button, button.button, a.button-inline, #submit_btn, #submit, .wpcf7-submit, #bbpress-forums #bbp-search-form #bbp_search, input[type="submit"], form.mc4wp-form input[type=submit], form.mc4wp-form input[type=email] {
                border-radius: 2em !important;
            }

            <?php endif; ?>
            /* Wordpress Default Buttons Color */
            a.button, .r_more_blog, button.wcv-button, input.button, .wcv-navigation ul.menu.horizontal li a, input.button, .woocommerce .wishlist_table td.product-add-to-cart a.button, button.button, a.button-inline, #submit_btn, #submit, .wpcf7-submit, input.otw-submit, form.mc4wp-form input[type=submit], .tribe-events-button, input[type="submit"] {
                background-color: <?php echo esc_attr(babystreet_get_option('all_buttons_color')) ?>;
                box-shadow: 0 0 0 3px <?php echo esc_attr(babystreet_get_option('all_buttons_color')) ?>;
            }

            /* Wordpress Default Buttons Hover Color */
            a.button:hover, .r_more_blog:hover, .widget_shopping_cart_content p.buttons .button:hover, .vc_btn3-style-custom:hover, input.button:hover, .wcv-navigation ul.menu.horizontal li a:hover, .wcv-navigation ul.menu.horizontal li.active a, button.button:hover, .woocommerce .wishlist_table td.product-add-to-cart a.button:hover, a.button-inline:hover, #submit_btn:hover, #submit:hover, .wpcf7-submit:hover, .r_more:hover, .r_more_right:hover, button.single_add_to_cart_button:hover, .babystreet-product-slide-cart .button.add_to_cart_button:hover, input.otw-submit:hover, form.mc4wp-form input[type=submit]:hover, .wc-proceed-to-checkout a.checkout-button.button:hover {
                background-color: <?php echo esc_attr(babystreet_get_option('all_buttons_hover_color')) ?> !important;
                box-shadow: 0 0 0 3px <?php echo esc_attr(babystreet_get_option('all_buttons_hover_color')) ?>;
            }

            /* NEW label color */
            div.prod_hold .new_prod {
                background-color: <?php echo esc_attr(babystreet_get_option('new_label_color')) ?>;
            }

            /* SALE label color */
            div.prod_hold .sale, span.onsale {
                background-color: <?php echo esc_attr(babystreet_get_option('sale_label_color')) ?>;
            }

            .count_holder .countdown_time_tiny {
                color: <?php echo esc_attr(babystreet_get_option('sale_label_color')) ?>;
            }

            /* Standard page title color (no background image) */
            #babystreet_page_title h1.heading-title, #babystreet_page_title h1.heading-title a, .breadcrumb, .breadcrumb a, .babystreet-dark-skin #babystreet_page_title h1.heading-title a, body.single-post .babystreet_title_holder .blog-post-meta a {
                color: <?php echo esc_attr(babystreet_get_option('page_title_color')) ?>;
            }

            .breadcrumb {
                color: #999999;
            }

            /* Standard page subtitle color (no background image) */
            .babystreet_title_holder h6 {
                color: <?php echo esc_attr(babystreet_get_option('page_subtitle_color')) ?>;
            }

            /* Customized page title color (with background image) */
            #babystreet_page_title.babystreet_title_holder.title_has_image h1.heading-title, #babystreet_page_title.babystreet_title_holder.title_has_image .blog-post-meta *, #babystreet_page_title.babystreet_title_holder.title_has_image .blog-post-meta .post-meta-date:before, #babystreet_page_title.babystreet_title_holder.title_has_image h1.heading-title a, body.single-post #babystreet_page_title.babystreet_title_holder.title_has_image .blog-post-meta a, #babystreet_page_title.babystreet_title_holder.title_has_image h6, #babystreet_page_title.babystreet_title_holder.title_has_image .breadcrumb, #babystreet_page_title.babystreet_title_holder.title_has_image .breadcrumb a {
                color: <?php echo esc_attr(babystreet_get_option('custom_page_title_color')) ?>;
            }

            body.babystreet_transparent_header.babystreet-transparent-dark #babystreet_page_title.babystreet_title_holder.title_has_image h1.heading-title, body.babystreet_transparent_header.babystreet-transparent-dark #babystreet_page_title.babystreet_title_holder.title_has_image .blog-post-meta *, body.babystreet_transparent_header.babystreet-transparent-dark #babystreet_page_title.babystreet_title_holder.title_has_image .blog-post-meta .post-meta-date:before, body.babystreet_transparent_header.babystreet-transparent-dark #babystreet_page_title.babystreet_title_holder.title_has_image h1.heading-title a, body.single-post.babystreet_transparent_header.babystreet-transparent-dark #babystreet_page_title.babystreet_title_holder.title_has_image .blog-post-meta a, body.babystreet_transparent_header.babystreet-transparent-dark #babystreet_page_title.babystreet_title_holder.title_has_image h6, body.babystreet_transparent_header.babystreet-transparent-dark #babystreet_page_title.babystreet_title_holder.title_has_image .breadcrumb, body.babystreet_transparent_header.babystreet-transparent-dark #babystreet_page_title.babystreet_title_holder.title_has_image .breadcrumb a {
                color: <?php echo esc_attr(babystreet_get_option('transparent_header_dark_menu_color')) ?>;
            }

            /* Standard page title background color (no background image) */
            .babystreet_title_holder, .babystreet_title_holder .inner:before, body.babystreet_header_left .babystreet_title_holder:not(.title_has_image) .inner {
                background-color: <?php echo esc_attr(babystreet_get_option('page_title_bckgr_color')) ?>;
            }

            <?php if (babystreet_get_option('page_title_bckgr_color') === "#ffffff"): ?>
            .babystreet_title_holder:not(.title_has_image) .inner {
                padding-bottom: 10px;
            }
            <?php endif; ?>

            /* Standard page title border color (no background image) */
            .babystreet_title_holder, body.babystreet_header_left .babystreet_title_holder:not(.title_has_image) .inner {
                border-color: <?php echo esc_attr(babystreet_get_option('page_title_border_color')) ?>;
            }

            .babystreet_title_holder .inner:before {
                border-color: transparent <?php echo esc_attr(babystreet_get_option('page_title_border_color')) ?> <?php echo esc_attr(babystreet_get_option('page_title_border_color')) ?> transparent;
            }

            /* Portfolio overlay text color */
            .portfolio-unit:not(.babystreet-none-overlay):not(.list-unit) a.portfolio-link, .portfolio-unit:not(.babystreet-none-overlay):not(.list-unit) small, .portfolio-unit:not(.babystreet-none-overlay):not(.list-unit) a.portfolio-link h4, .portfolio-unit:not(.babystreet-none-overlay):not(.list-unit) p {
                color: <?php echo esc_attr(babystreet_get_option('portfolio_overlay_text_color')) ?>;
            }

            <?php if (babystreet_get_option('fancy_title_font')): ?>
                #babystreet_page_title h1.heading-title {
                    font-family: "Hensa-Regular" !important;
                    font-size: 64px;
                }
            <?php endif; ?>

            /* Top Menu Bar Visible on Mobile */
            <?php if (!babystreet_get_option('header_top_mobile_visibility')): ?>
            <?php echo '@media only screen and (max-width: 1279px) {#header_top {display: none !Important}}'; ?>
            <?php endif; ?>
            /* Header top bar background color */
            #header_top {
                background-color: <?php echo esc_attr(babystreet_get_option('header_top_bar_color')) ?>;
                <?php if (babystreet_get_option('header_top_bar_border_color')): ?>
                border-color: <?php echo esc_attr(babystreet_get_option('header_top_bar_border_color')) ?> !Important;
                <?php endif; ?>
            }
            .babystreet-main-menu-left #header.babystreet-has-header-top #logo.babystreet_text_logo {
                background-color: <?php echo esc_attr(babystreet_get_option('header_top_bar_color')) ?> !important;
            }

            /* Main menu links color and typography */
            <?php
            $main_menu_typography = babystreet_get_option('main_menu_typography');
            $main_menu_typography_style = json_decode($main_menu_typography['style'], true);
            $main_menu_typography_css_style = '';
            if ($main_menu_typography_style) {
                $main_menu_typography_css_style = 'font-weight:' . esc_attr($main_menu_typography_style['font-weight'] . ';font-style:' . $main_menu_typography_style['font-style'] . ';');
            }
            ?>
            #main-menu ul.menu > li > a, #main-menu li div.babystreet-mega-menu > ul.sub-menu > li > a, .babystreet-wishlist-counter a, #header .babystreet-search-cart-holder .video_controlls a, .babystreet_mega_text_block .widget > h3:first-of-type {
                color: <?php echo esc_attr(babystreet_get_option('main_menu_links_color')) ?>;
                font-size: <?php echo esc_attr($main_menu_typography['size']) ?>;
            <?php echo esc_attr($main_menu_typography_css_style) ?>
            }

            /* Main menu links hover color */
            ul#mobile-menu.menu li a {
                font-size: <?php echo esc_attr($main_menu_typography['size']) ?>;
            <?php echo esc_attr($main_menu_typography_css_style) ?>
            }

            /* Main menu links hover color */
            #main-menu ul.menu > li:hover > a, #main-menu ul.menu > li.current-menu-item > a, #main-menu ul.menu > li.babystreet-highlight-menu-item > a, body.babystreet_transparent_header #header #main-menu ul.menu > li:hover > a, body.babystreet_transparent_header #header #main-menu ul.menu > li.current-menu-item > a, #cart-module a.cart-contents, #main-menu li div.babystreet-mega-menu > ul.sub-menu > li > a:hover {
                color: <?php echo esc_attr(babystreet_get_option('main_menu_links_hover_color')) ?>;
            }

            /* Main menu background hover color */
            <?php if (babystreet_get_option('main_menu_links_bckgr_hover_color')): ?>
            body:not(.babystreet_transparent_header) #main-menu ul.menu > li:hover > a, body:not(.babystreet_transparent_header) #main-menu ul.menu > li.current-menu-item > a, body:not(.babystreet_transparent_header) #main-menu ul.menu > li:hover > a, #header2 #main-menu ul.menu > li.current-menu-item > a, #header2 #main-menu ul.menu > li:hover > a {
                background-color: <?php echo esc_attr(babystreet_get_option('main_menu_links_bckgr_hover_color')) ?>;
            }

            #main-menu ul.menu > li.babystreet-highlight-menu-item > a, #main-menu ul.menu > li.babystreet-highlight-menu-item:after {
                background-color: <?php echo esc_attr(babystreet_get_option('main_menu_links_bckgr_hover_color')) ?>;
            }

            #main-menu ul.menu > li.babystreet-highlight-menu-item:after {
                border-color: <?php echo esc_attr(babystreet_get_option('main_menu_links_bckgr_hover_color')) ?>;
            }

            <?php endif; ?>
            <?php if (!babystreet_get_option('main_menu_links_bckgr_hover_color')): ?>
            #main-menu ul.menu > li.babystreet-highlight-menu-item > a, #main-menu ul.menu > li.babystreet-highlight-menu-item:after {
                background-color: <?php echo esc_attr(babystreet_get_option('accent_color')) ?>;
            }

            #main-menu ul.menu > li.babystreet-highlight-menu-item:after {
                border-color: <?php echo esc_attr(babystreet_get_option('accent_color')) ?>;
            }

            <?php endif; ?>
            <?php if (babystreet_get_option('main_menu_transf_to_uppercase')): ?>
            #main-menu ul.menu > li > a, #babystreet_footer_menu > li a, #header #logo .babystreet-logo-title {
                text-transform: uppercase;
            }

            <?php endif; ?>
            /* Main menu icons color */
            <?php if (babystreet_get_option('main_menu_icons_color')): ?>
            #main-menu ul.menu li a i {
                color: <?php echo esc_attr(babystreet_get_option('main_menu_icons_color')) ?>;
            }

            <?php endif; ?>

            /* Header top bar menu links color */
            ul#topnav2 > li a, .babystreet-top-bar-message, .babystreet-top-bar-message a, #header_top .babystreet-social ul li a {
                color: <?php echo esc_attr(babystreet_get_option('top_bar_menu_links_color')) ?>
            }

            /* Header top bar menu links hover color */
            ul#topnav2 li a:hover, body.babystreet_transparent_header ul#topnav2 > li > a:hover {
                color: <?php echo esc_attr(babystreet_get_option('top_bar_menu_links_hover_color')) ?> !important;
            }

            /* Header top bar menu links hover background color */
            <?php if (babystreet_get_option('top_bar_menu_links_bckgr_color')): ?>
            ul#topnav2 li a:hover, ul#topnav2 ul.sub-menu li a:hover, ul#topnav2 li:hover ul.sub-menu a:hover {
                background-color: <?php echo esc_attr(babystreet_get_option('top_bar_menu_links_bckgr_color')) ?>;
            }
            <?php endif; ?>

            /* Collapsible Pre-Header background color */
            #pre_header, #pre_header:before {
                background-color: <?php echo esc_attr(babystreet_get_option('collapsible_bckgr_color')) ?>;
            }

            /* Collapsible Pre-Header titles color */
            #pre_header .widget > h3:first-child {
                color: <?php echo esc_attr(babystreet_get_option('collapsible_titles_color')) ?>;
            }

            /* Collapsible Pre-Header titles border color */
            #pre_header .widget > h3:first-child, #pre_header > .inner ul.product_list_widget li, #pre_header > .inner div.widget_nav_menu ul li a, #pre_header > .inner ul.products-list li {
                border-color: <?php echo esc_attr(babystreet_get_option('collapsible_titles_border_color')) ?>;
            }

            #pre_header > .inner div.widget_categories ul li, #pre_header > .inner div.widget_archive ul li, #pre_header > .inner div.widget_recent_comments ul li, #pre_header > .inner div.widget_pages ul li,
            #pre_header > .inner div.widget_links ul li, #pre_header > .inner div.widget_recent_entries ul li, #pre_header > .inner div.widget_meta ul li, #pre_header > .inner div.widget_display_forums ul li,
            #pre_header > .inner .widget_display_replies ul li, #pre_header > .inner .widget_display_views ul li {
                border-color: <?php echo esc_attr(babystreet_get_option('collapsible_titles_border_color')) ?>;
            }

            /* Collapsible Pre-Header links color */
            #pre_header a {
                color: <?php echo esc_attr(babystreet_get_option('collapsible_links_color')) ?>;
            }

            /* Transparent Header menu color */
            @media only screen and (min-width: 1279px) {
                body.babystreet_transparent_header #header:not(.babystreet-sticksy) #logo .babystreet-logo-title, body.babystreet_transparent_header .babystreet-top-bar-message, body.babystreet_transparent_header .babystreet-top-bar-message a, body.babystreet_transparent_header #header_top .babystreet-social ul li a, body.babystreet_transparent_header ul#topnav2 > li > a, body.babystreet_transparent_header #header:not(.babystreet-sticksy) .babystreet-search-cart-holder .video_controlls a, body.babystreet_transparent_header #header:not(.babystreet-sticksy) #logo .babystreet-logo-subtitle, body.babystreet_transparent_header #header:not(.babystreet-sticksy) #main-menu ul.menu > li > a {
                    color: <?php echo esc_attr(babystreet_get_option('transparent_header_menu_color')) ?> !Important;
                }

                body.babystreet_transparent_header.babystreet-transparent-dark #header #logo .babystreet-logo-title, body.babystreet_transparent_header.babystreet-transparent-dark .babystreet-top-bar-message, body.babystreet_transparent_header.babystreet-transparent-dark .babystreet-top-bar-message a, body.babystreet_transparent_header.babystreet-transparent-dark #header_top .babystreet-social ul li a, body.babystreet_transparent_header.babystreet-transparent-dark ul#topnav2 > li > a, body.babystreet_transparent_header.babystreet-transparent-dark #header #logo .babystreet-logo-subtitle, body.babystreet_transparent_header.babystreet-transparent-dark #header #main-menu ul.menu > li > a {
                    color: <?php echo esc_attr(babystreet_get_option('transparent_header_dark_menu_color')) ?> !Important;
                }

                /* Transparent menu hover color */
            <?php if (babystreet_get_option('transparent_header_menu_hover_color')): ?>
                body.babystreet_transparent_header #header:not(.babystreet-sticksy) #main-menu ul.menu > li > a:hover, body.babystreet_transparent_header #header:not(.babystreet-sticksy) #main-menu ul.menu > li.current-menu-item > a {
                    color: <?php echo esc_attr(babystreet_get_option('transparent_header_menu_hover_color')) ?> !Important;
                }

                body.babystreet_transparent_header #main-menu ul.menu > li > a:before {
                    background-color: <?php echo esc_attr(babystreet_get_option('transparent_header_menu_hover_color')) ?> !Important;
                }

            <?php endif; ?>
            <?php if (babystreet_get_option('transparent_header_dark_menu_hover_color')): ?>
                body.babystreet_transparent_header.babystreet-transparent-dark #header #main-menu ul.menu > li > a:hover, body.babystreet_transparent_header.babystreet-transparent-dark #header #main-menu ul.menu > li.current-menu-item > a {
                    color: <?php echo esc_attr(babystreet_get_option('transparent_header_dark_menu_hover_color')) ?> !Important;
                }

                body.babystreet_transparent_header.babystreet-transparent-dark #main-menu ul.menu > li > a:before {
                    background-color: <?php echo esc_attr(babystreet_get_option('transparent_header_dark_menu_hover_color')) ?> !Important;
                }

            <?php endif; ?>
            }

            /* Page Title background */
            <?php $title_backgr = babystreet_get_option('page_title_default_bckgr_image'); ?>
           <?php if ($title_backgr): ?>
               #babystreet_page_title:not(.title_has_image) {
                   background: url("<?php echo esc_url(wp_get_attachment_image_url($title_backgr, 'full')) ?>");
               }

           <?php endif; ?>

            /* Header background */
            <?php $header_backgr = babystreet_get_option('header_background'); ?>
            <?php if ($header_backgr['image']): ?>
            #header, #header.babystreet-sticksy:before {
                background: url("<?php echo esc_url(wp_get_attachment_image_url($header_backgr['image'], 'full')) ?>")<?php echo esc_attr($header_backgr['position']) ?> <?php echo esc_attr($header_backgr['repeat']) ?> <?php echo esc_attr($header_backgr['attachment']) ?>;
            }

            <?php endif; ?>

            #header, #header.babystreet-sticksy:before {
                background-color: <?php echo esc_attr($header_backgr['color']) ?>;
            }

            <?php if ($header_backgr['color'] != "#ffffff"): ?>

            #header {
                border: none;
            }

            #main-menu ul.menu > li > a:before {
                background-color: <?php echo esc_attr(babystreet_get_option('main_menu_links_hover_color')) ?>;
            }

            <?php endif; ?>
            /* footer_background */
            <?php $footer_backgr = babystreet_get_option('footer_background'); ?>
            <?php if ($footer_backgr['image']): ?>
            #footer {
                background: url("<?php echo esc_url(wp_get_attachment_image_url($footer_backgr['image'], 'full')) ?>")<?php echo esc_attr($footer_backgr['position']) ?> <?php echo esc_attr($footer_backgr['repeat']) ?> <?php echo esc_attr($footer_backgr['attachment']) ?>;
            }

            <?php if ($footer_backgr['repeat'] === 'no-repeat' ): ?>
            #footer {
                background-size: cover;
            }
            #footer > .inner:nth-of-type(2) {
            padding-bottom: 50px;
            }
            <?php endif; ?>
            <?php endif; ?>
            #footer {
                background-color: <?php echo esc_attr($footer_backgr['color']) ?>;
            }

            /* footer_titles_color + footer_title_border_color */
            #footer .widget > h3:first-child {
                color: <?php echo esc_attr(babystreet_get_option('footer_titles_color')) ?>;
                border-color: <?php echo esc_attr(babystreet_get_option('footer_title_border_color')) ?>;
            }

            #footer {
                border-top: 1px solid<?php echo esc_attr(babystreet_get_option('footer_title_border_color')) ?>;
            }

            #footer > .inner ul.product_list_widget li, #footer > .inner div.widget_nav_menu ul li a, #footer > .inner ul.products-list li, #babystreet_footer_menu > li {
                border-color: <?php echo esc_attr(babystreet_get_option('footer_title_border_color')) ?>;
            }

            /* footer_menu_links_color */
            #babystreet_footer_menu > li a, #powered .babystreet-social ul li a {
                color: <?php echo esc_attr(babystreet_get_option('footer_menu_links_color')) ?>;
            }
            <?php if (babystreet_get_option('footer_copyright_bar_text_color') === "#ffffff"): ?>
            #powered .author_credits a {color: #ffffff;}
            <?php endif; ?>

            /* footer_links_color */
            #footer > .inner a {
                color: <?php echo esc_attr(babystreet_get_option('footer_links_color')) ?>;
            }

            /* footer_text_color */
            #footer {
                color: <?php echo esc_attr(babystreet_get_option('footer_text_color')) ?>;
            }

            #footer > .inner div.widget_categories ul li, #footer > .inner div.widget_archive ul li, #footer > .inner div.widget_recent_comments ul li, #footer > .inner div.widget_pages ul li,
            #footer > .inner div.widget_links ul li, #footer > .inner div.widget_recent_entries ul li, #footer > .inner div.widget_meta ul li, #footer > .inner div.widget_display_forums ul li,
            #footer > .inner .widget_display_replies ul li, #footer > .inner .widget_display_views ul li, #footer > .inner div.widget_nav_menu ul li {
                border-color: <?php echo esc_attr(babystreet_get_option('footer_title_border_color')) ?>;
            }

            /* footer_copyright_bar_bckgr_color */
            #powered {
                <?php if (babystreet_get_option('footer_copyright_bar_bckgr_color')): ?>
                background-color: <?php echo esc_attr(babystreet_get_option('footer_copyright_bar_bckgr_color')) ?>;
                <?php endif; ?>
                color: <?php echo esc_attr(babystreet_get_option('footer_copyright_bar_text_color')) ?>;
            }

            /* Body font */
            <?php $body_font = babystreet_get_option('body_font'); ?>
            body, #bbpress-forums .bbp-body div.bbp-reply-content {
                font-family: <?php echo esc_attr($body_font['face']) ?>;
                font-size: <?php echo esc_attr($body_font['size']) ?>;
                color: <?php echo esc_attr($body_font['color']) ?>;
            }

            #header #logo .babystreet-logo-subtitle, #header2 #logo .babystreet-logo-subtitle {
                color: <?php echo esc_attr($body_font['color']) ?>;
            }

            /* Text logo color and typography */
            <?php
            $text_logo_typography = babystreet_get_option('text_logo_typography');
            $text_logo_typography_style = json_decode($text_logo_typography['style'], true);
            $text_logo_typography_color = $text_logo_typography['color'];
            $text_logo_typography_css_style = '';
            if ($text_logo_typography_style) {
                $text_logo_typography_css_style = 'font-weight:' . esc_attr($text_logo_typography_style['font-weight'] . ';font-style:' . $text_logo_typography_style['font-style'] . ';');
            }
            ?>
            #header #logo .babystreet-logo-title, #header2 #logo .babystreet-logo-title {
                color: <?php echo esc_attr($text_logo_typography_color) ?>;
                font-size: <?php echo esc_attr($text_logo_typography['size']) ?>;
            <?php echo esc_attr($text_logo_typography_css_style) ?>
            }

            /* Heading fonts */
            <?php $headings_font = babystreet_get_option('headings_font'); ?>
            h1, h2, h3, h4, h5, h6, p.wp-block-cover-text, .babystreet-product-summary-wrapper div.babystreet-share-links span, #comments .nav-next a, #comments .nav-previous a, #tab-reviews #reply-title, .woocommerce-form-coupon-toggle .woocommerce-info, .woocommerce-form-login-toggle .woocommerce-info, .r_more_blog, p.woocommerce-thankyou-order-received, nav.woocommerce-MyAccount-navigation ul li a, #babystreet-account-holder.babystreet-user-is-logged .babystreet-header-account-link-holder > ul li a, .babystreet-header-user-data small, a.babystreet-post-nav .entry-info span.entry-title, .wp-block-cover-image .wp-block-cover-image-text, .wp-block-cover-image h2, .babystreet-product-popup-link > a, .vendor_description .vendor_img_add .vendor_address p.wcmp_vendor_name, .tribe-events-event-cost, .tribe-events-schedule .tribe-events-cost, .babystreet-page-load-status, .widget_layered_nav_filters li a, section.woocommerce-order-details, ul.woocommerce-error, table.woocommerce-checkout-review-order-table, body.woocommerce-cart .cart-collaterals, .cart-info table.shop_table.cart, ul.woocommerce-order-overview.woocommerce-thankyou-order-details.order_details li, .countdown_time_tiny, blockquote, q, #babystreet_footer_menu > li a, .babystreet-pagination-numbers .owl-dot:before, .babystreet-wcs-swatches .swatch.swatch-label, .portfolio-unit-info small, .widget .post-date, div.widget_nav_menu ul li a, .comment-body span, .comment-reply-link, span.edit-link a, #reviews .commentlist li .meta, div.widget_categories ul li a, div.widget_archive ul li a, div.widget_recent_entries ul li a, div.widget_recent_comments ul li a, .woocommerce p.cart-empty, div.woocommerce-MyAccount-content .myaccount_user, label, .babystreet-pricing-table-content, p.product.woocommerce.add_to_cart_inline, .product-filter .limit b, .product-filter .sort b, .product-filter .price_label, .contact-form .content span, .tribe-countdown-text, .babystreet-event-countdown .is-countdown, .babystreet-portfolio-categories ul li a, div.prod_hold .name, .prod_hold .price_hold, #header #logo .babystreet-logo-title, #header2 #logo .babystreet-logo-title, .babystreet-counter-h1, .babystreet-typed-h1, .babystreet-typed-h2, .babystreet-typed-h3, .babystreet-typed-h4, .babystreet-typed-h5, .babystreet-typed-h6, .babystreet-counter-h2, body.woocommerce-account #customer_login.col2-set .owl-nav, .woocommerce #customer_login.u-columns.col2-set .owl-nav, .babystreet-counter-h3, .error404 div.blog-post-excerpt:before, #yith-wcwl-popup-message #yith-wcwl-message, div.added-product-text strong, .vc_pie_chart .vc_pie_chart_value, .countdown-amount, .babystreet-product-slide-price, .babystreet-counter-h4, .babystreet-counter-h5, .babystreet-search-cart-holder #search input[type="text"], .babystreet-counter-h6, .vc_tta-tabs:not(.vc_tta-style-modern) .vc_tta-tab, div.product .price span, a.bbp-forum-title, p.logged-in-as, .babystreet-pricing-table-price, li.bbp-forum-info, li.bbp-topic-title .bbp-topic-permalink, .breadcrumb, .offer_title, ul.tabs a, .wpb_tabs .wpb_tabs_nav li a, .wpb_tour .wpb_tabs_nav a, .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a, .post-date .num, .babystreet-products-list-view div.prod_hold .name, .babystreet_shortcode_count_holder .countdown-amount, .blog-post-meta a, .widget_shopping_cart_content p.total, #cart-module a.cart-contents, .babystreet-wishlist-counter .babystreet-wish-number, .portfolio_top .project-data .project-details .simple-list-underlined li, .portfolio_top .project-data .main-features .checklist li, .summary.entry-summary .yith-wcwl-add-to-wishlist a {
                font-family: <?php echo esc_attr($headings_font['face']) ?>;
            }

            .u-column1 h2, .u-column2 h3, .babystreet_title_holder h1.heading-title {
                font-family: <?php echo esc_attr($headings_font['face']) ?> !important;
            }

            <?php $use_google_face_for = babystreet_get_option('use_google_face_for'); ?>

            <?php if ($use_google_face_for['main_menu']): ?>
            #main-menu ul.menu li a, ul#mobile-menu.menu li a, #main-menu li div.babystreet-mega-menu > ul.sub-menu > li.babystreet_colum_title > a {
                font-family: <?php echo esc_attr($headings_font['face']) ?>;
            }

            <?php endif; ?>

            <?php if ($use_google_face_for['buttons']): ?>
            a.button, input.button, .babystreet-filter-widgets-triger, .babystreet-reset-filters, .wcv-navigation ul.menu.horizontal li a, .wcv-pro-dashboard input[type="submit"], button.button, input[type="submit"], a.button-inline, .babystreet_banner_buton, #submit_btn, #submit, .wpcf7-submit, .col2-set.addresses header a.edit, div.product input.qty, .babystreet-pricing-table-button a, .vc_btn3 {
                font-family: <?php echo esc_attr($headings_font['face']) ?>;
            }

            <?php endif; ?>
            /* H1 */
            <?php
            $h1_font = babystreet_get_option('h1_font');
            $h1_style = json_decode($h1_font['style'], true);
            $h1_css_style = '';
            if ($h1_style) {
                $h1_css_style = 'font-weight:' . esc_attr($h1_style['font-weight'] . ';font-style:' . $h1_style['font-style'] . ';');
            }
            ?>
            h1, .babystreet-counter-h1, .babystreet-typed-h1, #tab-reviews #reply-title, .babystreet-dropcap p:first-letter, .babystreet-dropcap h1:first-letter, .babystreet-dropcap h2:first-letter, .babystreet-dropcap h3:first-letter, .babystreet-dropcap h4:first-letter, .babystreet-dropcap h5:first-letter, .babystreet-dropcap h6:first-letter {
                color: <?php echo esc_attr($h1_font['color']) ?>;
                font-size: <?php echo esc_attr($h1_font['size']) ?>;
            <?php echo esc_attr($h1_css_style) ?>
            }

            /* H2 */
            <?php
            $h2_font = babystreet_get_option('h2_font');
            $h2_style = json_decode($h2_font['style'], true);
            $h2_css_style = '';
            if ($h2_style) {
                $h2_css_style = 'font-weight:' . esc_attr($h2_style['font-weight'] . ';font-style:' . $h2_style['font-style'] . ';');
            }
            ?>
            h2, .babystreet-counter-h2, p.wp-block-cover-text, .babystreet-typed-h2, .wp-block-cover-image .wp-block-cover-image-text, .wp-block-cover-image h2, .icon_teaser h3:first-child, body.woocommerce-account #customer_login.col2-set .owl-nav, .woocommerce #customer_login.u-columns.col2-set .owl-nav, .related.products h2, .upsells.products h2, .similar_projects > h4, .babystreet-related-blog-posts > h4, .tribe-events-related-events-title {
                color: <?php echo esc_attr($h2_font['color']) ?>;
                font-size: <?php echo esc_attr($h2_font['size']) ?>;
            <?php echo esc_attr($h2_css_style) ?>
            }
            .babystreet-portfolio-categories ul li a {
                color: <?php echo esc_attr($h2_font['color']) ?>; 
            }

            /* H3 */
            <?php
            $h3_font = babystreet_get_option('h3_font');
            $h3_style = json_decode($h3_font['style'], true);
            $h3_css_style = '';
            if ($h3_style) {
                $h3_css_style = 'font-weight:' . esc_attr($h3_style['font-weight'] . ';font-style:' . $h3_style['font-style'] . ';');
            }
            ?>
            h3, .babystreet-counter-h3, .babystreet-typed-h3, .woocommerce p.cart-empty {
                color: <?php echo esc_attr($h3_font['color']) ?>;
                font-size: <?php echo esc_attr($h3_font['size']) ?>;
            <?php echo esc_attr($h3_css_style) ?>
            }

            /* H4 */
            <?php
            $h4_font = babystreet_get_option('h4_font');
            $h4_style = json_decode($h4_font['style'], true);
            $h4_css_style = '';
            if ($h4_style) {
                $h4_css_style = 'font-weight:' . esc_attr($h4_style['font-weight'] . ';font-style:' . $h4_style['font-style'] . ';');
            }
            ?>
            h4, .babystreet-counter-h4, .babystreet-typed-h4 {
                color: <?php echo esc_attr($h4_font['color']) ?>;
                font-size: <?php echo esc_attr($h4_font['size']) ?>;
            <?php echo esc_attr($h4_css_style) ?>
            }

            /* H5 */
            <?php
            $h5_font = babystreet_get_option('h5_font');
            $h5_style = json_decode($h5_font['style'], true);
            $h5_css_style = '';
            if ($h5_style) {
                $h5_css_style = 'font-weight:' . esc_attr($h5_style['font-weight'] . ';font-style:' . $h5_style['font-style'] . ';');
            }
            ?>
            h5, .babystreet-counter-h5, .babystreet-typed-h5 {
                color: <?php echo esc_attr($h5_font['color']) ?>;
                font-size: <?php echo esc_attr($h5_font['size']) ?>;
            <?php echo esc_attr($h5_css_style) ?>
            }

            /* H6 */
            <?php
            $h6_font = babystreet_get_option('h6_font');
            $h6_style = json_decode($h6_font['style'], true);
            $h6_css_style = '';
            if ($h6_style) {
                $h6_css_style = 'font-weight:' . esc_attr($h6_style['font-weight'] . ';font-style:' . $h6_style['font-style'] . ';');
            }
            ?>
            h6, .babystreet-counter-h6, .babystreet-typed-h6 {
                color: <?php echo esc_attr($h6_font['color']) ?>;
                font-size: <?php echo esc_attr($h6_font['size']) ?>;
            <?php echo esc_attr($h6_css_style) ?>
            }

            <?php if (babystreet_get_option('mobile_theme_logo')): ?>
            @media only screen and (max-width: 1279px) {

                #header #logo img {
                    display: none !important;
                }

                #header #logo img.babystreet_mobile_logo {
                    display: table-cell !important;
                    width: auto !important;
                    opacity: 1;
                }
            }

            <?php endif; ?>

            <?php if (babystreet_get_option('product_columns_mobile') === '2'): ?>
            @media only screen and (min-width: 320px) and (max-width: 767px) {
                body div.prod_hold, body li.product-category, body div.product-category {
                    width: 49.5% !important;
                }
                body div.prod_hold {
                    padding: 7px;
                }
                div.prod_hold .name  {
                    font-size:12px;
                    text-transform: none;
                }
                .prod_hold .price_hold {
                    font-size: 13px;
                    font-weight: 500;
                }
                .prod_hold .babystreet-list-prod-summary, div.prod_hold .links {
                    padding: 10px 0px;
                    left: 0px;
                    right: 0px;
                }
                div.prod_hold .links {
                    padding: 0px 0px 15px 0px;
                    top: auto !important;
                    position: relative;
                    opacity: 1;
                }
                div.prod_hold a.button, .links a.button.add_to_cart_button, div.prod_hold .links a.button.product_type_external:before, .links a.button.add_to_cart_button.ajax_add_to_cart, .links .yith-wcwl-add-to-wishlist, .links a.babystreet-quick-view-link, div.prod_hold .links a.button.add_to_cart_button:before, a.babystreet-quick-view-link, a.babystreet-quick-view-link i:before, .links a.compare.button, .links a.add_to_wishlist.button, .links a.add_to_wishlist, .links a.add_to_wishlist::before {
                    width: 28px;
                    height: 28px;
                    line-height: 28px !important;
                }
                div.prod_hold a.button, .links a.button.add_to_cart_button, .links a.button.add_to_cart_button.ajax_add_to_cart, .links .yith-wcwl-add-to-wishlist, .links a.babystreet-quick-view-link {
                    margin-right: 0 !important;
                }
                div.prod_hold .sale {
                    display: none;
                }
            }

            <?php endif; ?>

            /* Add to Cart Color */
            button.single_add_to_cart_button, .babystreet-product-slide-cart .button.add_to_cart_button {
                background-color: <?php echo esc_attr(babystreet_get_option('add_to_cart_color')); ?> !important;
                box-shadow: 0 0 0 3px <?php echo esc_attr(babystreet_get_option('add_to_cart_color')); ?>;
            }

            .links a.button.add_to_cart_button:after, .links a.button.add_to_cart_button.ajax_add_to_cart:after, div.prod_hold a.button.add_to_cart_button:before, div.prod_hold .links a.button.product_type_grouped:before, div.prod_hold .links a.button.product_type_external:before, p.product.woocommerce.add_to_cart_inline + .links a.button.add_to_cart_button.ajax_add_to_cart:before, p.product.woocommerce.add_to_cart_inline + .links a.button.product_type_grouped.ajax_add_to_cart:before {
                background-color: <?php echo esc_attr(babystreet_get_option('add_to_cart_color')); ?> !important;
            }

            table.compare-list .add-to-cart td a.babystreet-quick-view-link, table.compare-list .add-to-cart td a.compare.button {
                display: none !important;
            }</style>
        <?php
        $custom_css = ob_get_clean();
        $custom_css = trim(preg_replace('#<style[^>]*>(.*)</style>#is', '$1', $custom_css));

        wp_add_inline_style('babystreet-style', $custom_css); // All dynamic data escaped
    }

}