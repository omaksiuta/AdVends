<?php
/**
 *  Add Dynamic css to header
 *  @version	1.0
 *  @author		Nazmus Shadhat
 *  @URI		http://teconce.com
 */


function mayosis_dynamic_css() {
    ?>


    <style>
        <?php
          $maintextcolor=get_theme_mod( 'regular_text_color', '#28375a' );
          $seccolor=get_theme_mod( 'mayosis_secondary_color','#e9edf7');
          $acccolor=get_theme_mod( 'accent_color','#5a00f0');
          $actxtcolor=get_theme_mod( 'accent_color_text','#ffffff');
          $secactcolor=get_theme_mod( 'secondary_accent_color','#1e0050');
          $sectxtcolor=get_theme_mod( 'secondary_accent_color_text','#ffffff');
          $formfieldtype = get_theme_mod( 'form_field_type');
          $globalborderthik = get_theme_mod( 'global_border_thikness','2px');
          $producthover = get_theme_mod( 'product_thumb_hover','#1e0050');
          $producthovertxt = get_theme_mod( 'product_thumb_hover_text','#ffffff');
          $thumbopacity = get_theme_mod( 'thumb_hover_opacity','.3');
          $headerbgtype = get_theme_mod( 'header_bg_type');
          $hgradient = get_theme_mod( 'header_gradient');
          $hbgimage = get_theme_mod( 'header_bg_image');
          $hbgcolor = get_theme_mod( 'header_background','#ffffff');
          $topmenucolor = get_theme_mod( 'top_header_menu','#222234');
          $topsubcolor = get_theme_mod( 'top_header_sub_menu','#ffffff');
          $topheaderheight = get_theme_mod( 'top_header_height','40px');
          $topsubbg = get_theme_mod( 'top_sub_menu_bg','#222234');
          $topheadertxt = get_theme_mod( 'top_header_text','#222234');
          $topiconsize = get_theme_mod( 'top_icon_size','12px');
          $topheaderbg = get_theme_mod( 'top_header_bg','#fcfcfc');
          $headerformtype = get_theme_mod( 'header_form_type');
          $headerformbgcolor = get_theme_mod( 'header_form_field_bg','#e9edf7');
          $headerformbgborder = get_theme_mod( 'header_form_border','#1e0050');
          $headerformborderthik = get_theme_mod( 'header_border_thikness','2px');
          $mainheaderheight = get_theme_mod( 'main_header_height','80px');
          $mainheaderpadding = get_theme_mod( 'main_header_padding',array('padding-top'=>'0','padding-bottom'=>'0','padding-right'=>'0','padding-left'=>'0',));
          $headerbuttonbg= get_theme_mod( 'header_buttonbg_color','rgba(255,255,255,.0)');
          $headerloginborder= get_theme_mod( 'header_buttonborder_color','rgba(255,255,255,0.25)');
          $headerbuttontext= get_theme_mod( 'header_button_text','#ffffff');
          $stickyheadertext= get_theme_mod( 'sticky_header_text','#3c465a');
          $stickybg= get_theme_mod( 'sticky_header_bg','rgba(255,255,255,1)');
          $stickylogo= get_theme_mod( 'sticky_logo');
          $transparentheader= get_theme_mod( 'header_transparent_background','rgba(255,255,255,0)');
          $headertransparentmain= get_theme_mod( 'header_transparency','transparent' );
          $smartsticky= get_theme_mod( 'smart_sticky');
          $mainnavcolor= get_theme_mod( 'main_nav_text','#ffffff');
          $mainsubcolor= get_theme_mod( 'sub_nav_text','#ffffff');
          $mainsubbg= get_theme_mod( 'sub_nav_bg','#5000ce');
          $headeraccent= get_theme_mod( 'header_accent_color','#5a00f0');
          $headeraccenttxt= get_theme_mod( 'header_accent_text_color','#ffffff');
          $headericonsize= get_theme_mod( 'header_icon_size','13px');
          $mobilemenutext= get_theme_mod( 'mobile_menu_text','#ffffff');
          $mobileheadericon= get_theme_mod( 'mobile_header_icons_color','#ffffff');
          $footerpadding= get_theme_mod( 'main_footerr_padding',array('padding-top'=>'120px','padding-bottom'=>'80px','padding-right'=>'0','padding-left'=>'0',));
          $footerbgtype= get_theme_mod( 'footer_bg_type','color');
          $footerbgcolor= get_theme_mod( 'footer_background','#1e0050');
          $footerbggradient= get_theme_mod( 'footer_gradient');
          $footerbgimage= get_theme_mod( 'footer_bg_image');
          $footertext= get_theme_mod( 'footer_text','#ffffff');
          $copyrightbg= get_theme_mod( 'copyright_backgroud','#1e0050');
          $copyrighttext= get_theme_mod( 'copyright_text','#ffffff');
          $footerfieldtype= get_theme_mod( 'footer_field_type');
          $footerfieldbg= get_theme_mod( 'footer_field_color','#1e0046');
          $footerfieldborder= get_theme_mod( 'footer_border_color','#1e0046');
          $footerborderthik= get_theme_mod( 'footer_border_thikness','2px');
          $widgetbgtype= get_theme_mod( 'wd_bg_type');
          $widgetbggradient= get_theme_mod( 'wd_title_gradient');
          $widgetbgcolor= get_theme_mod( 'wd_title_bg','#1e0046');
          $widgettitlecolor= get_theme_mod( 'wd_title_text','#ffffff');
          $widgetfieldtype= get_theme_mod( 'wd_field_type');
          $widgetfieldbg= get_theme_mod( 'wd_field_color');
          $widgetfieldborder= get_theme_mod( 'wd_border_color','#3c465a');
          $widgetborderthik= get_theme_mod( 'wd_border_thikness','2px');
          $widgetfieldtext= get_theme_mod( 'wd_field_text','#28375a');
          $producttemplate= get_theme_mod( 'background_product', 'color');
          $productbgdefault= get_theme_mod( 'product_bg_default', '#000046');
          $productgradientdefault= get_theme_mod( 'product_gradient_default', array('color1' => '#1e0046','color2' => '#1e0064',));
          $productanglegradient= get_theme_mod( 'gradient_angle_product','135');
          $productmainbg= get_theme_mod( 'product-main-bg');
          $productovarlaymain= get_theme_mod( 'product_ovarlay_main','rgb(30,0,70,.85)');
          $productmainoverlay= get_theme_mod( 'default_overlay_image_product');
          $productblurbg= get_theme_mod( 'main_product_blur','5px');
          $productbgparallax= get_theme_mod( 'parallax_featured_image','no');
          $productcontentposition= get_theme_mod( 'product_header_content_position','left');
          $blogbgtype= get_theme_mod( 'blog_bg_type', 'gradient');
          $blogbgcolor= get_theme_mod( 'blog_background','#000046');
          $blogoverlaymain= get_theme_mod( 'blog_ovarlay_main','rgba(30,0,70,.85)');
          $blogblurbg= get_theme_mod( 'main_blog_blur','5px');
          $blogbgparallax= get_theme_mod( 'parallax_featured_image_blog','no');
          $blogbggradient= get_theme_mod( 'blog_gradient', array('color1' => '#1e0046','color2' => '#1e0064',));
          $blogbgimage= get_theme_mod( 'blog_bg_image');
          $blogcontentposition= get_theme_mod( 'blog_header_content_position','left');
          $blogbgimagerepeat= get_theme_mod( 'blog_bg_image_repeat');
          $productbdtextcolor= get_theme_mod( 'product_breadcrumb_text','#ffffff');
          $productlabel= get_theme_mod( 'product_label','#e6174b');
          $productlebeledge= get_theme_mod( 'product_label_edge','#b7133d');
          $productbdpadding= get_theme_mod( 'product_padding',array('padding-top'=>'180px','padding-bottom'=>'120px','padding-right'=>'0px','padding-left'=>'0px',));
          $pagepadding= get_theme_mod( 'page_padding',array('padding-top'=>'160px','padding-bottom'=>'120px','padding-right'=>'0px','padding-left'=>'0px',));
          $singlebuttonbg= get_theme_mod( 'single_button_bg','#3c465a');
          $dualbuttona= get_theme_mod( 'dual_button_a','#3c465a');
          $dualbuttonb= get_theme_mod( 'dual_button_b','#3c465a');
          $stickyhideshow= get_theme_mod( 'sticky_hide');
          $testimonialbg= get_theme_mod( 'testimonial_grid_bg','#5a00f0');
          $footer_overlay_image=get_theme_mod( 'footer_overlay_image');
          $blog_overlay_image=get_theme_mod( 'blog_overlay_image');
          $loader_gradient = get_theme_mod( 'loader_gradient');
          $menuhovertype = get_theme_mod( 'menu_hover_type','opacity');
          $mainnavtexthover= get_theme_mod( 'main_nav_text_hover','#5a00f0');
          $colorborder = get_theme_mod( 'regular_text_color', '#28375a' );
          $mainmenuiconhide = get_theme_mod( 'menu-icon-main', 'hide' );
          $searchmaincolor = get_theme_mod( 'search_main_color', '#5a00f0' );
          $searchaccenttxtcolor = get_theme_mod( 'search_accent_text_color', '#ffffff' );
          $searchmainbgcolor = get_theme_mod( 'search_main_bg_color', '#ffffff' );
          $searchmainbordercolor = get_theme_mod( 'search_main_border_color', '#5a00f0' );
          $phototemplatebg = get_theme_mod( 'photo_template_bg', '#e9ebf7' );
          $phototemplateview = get_theme_mod( 'photo_template_view', 'fixed' );
          $productgridsystem= get_theme_mod( 'product_grid_system','one' );
    
          
          $golbalbgopacity = mayosis_hexto_rgb($maintextcolor, 0.1);
          $tagboorderrgb = mayosis_hexto_rgb($colorborder, 0.25);
          $headerbuttonborder = mayosis_hexto_rgb($mainnavcolor, 0.25);
          $productbordercolor = mayosis_hexto_rgb($productbdtextcolor, 0.25);
          $globalborderopacity = mayosis_hexto_rgb($maintextcolor, 0.25);
          $secondarycoloropacity = mayosis_hexto_rgb($secactcolor, 0.25);
          $secondarycolorfifty = mayosis_hexto_rgb($secactcolor, 0.5);
          ?>
        /**Common Style**/

        body {
            color:<?php echo esc_html($maintextcolor); ?>;
            background:<?php echo get_theme_mod( 'mayosis_body_color', '#ffffff' ); ?>;
        }
        .fes-form.fes-submission-form-div,.fes_dashboard_menu,.fes-fields table,#fes-vendor-dashboard table,#fes-product-list tbody tr td,.fes-profile-form{
            background:<?php echo get_theme_mod( 'mayosis_body_color', '#ffffff' ); ?> !important;
            border-color:<?php echo get_theme_mod( 'mayosis_body_color', '#ffffff' ); ?> !important;
        }
        <?php if ($maintextcolor): ?>
        .sidebar-theme ul li a,.bottom-widget-product  a,.total-post-count p,.author_single_dm_box p, .author_single_dm_box a,.author_meta_single h2 a,.author_meta_single p,.author_meta_single a,
        .author_meta_single ul li a,.comment-content p,a.sigining-up,.edd-lost-password a,.edd-login-remember span,.promo_price,#edd_checkout_cart th,#edd_checkout_form_wrap legend,#edd_checkout_wrap #edd_checkout_form_wrap label,
        #edd_checkout_form_wrap span.edd-description,span.edd_checkout_cart_item_title,#edd_checkout_cart .edd_cart_header_row th,#edd_checkout_cart td,#edd_checkout_form_wrap input.edd-input, #edd_checkout_form_wrap textarea.edd-input,
        #edd_checkout_form_wrap span.edd-required-indicator,#edd_checkout_form_wrap select.edd-select,.single-user-info ul li a,.stylish-input-group button,.user-info span,.user-info a,.single_author_post,.empty_cart_icon i,
        .empty_cart_icon h2,.fourzerofour-area h1,.fourzerofour-area h3,#edd_profile_editor_form label,table tbody tr td,.count-download span,.mayosis-madalin .modal-header .close,.product-price h3,.sidebar-details p,.bottom-product-sidebar h4,
        .sidebar-blog-categories ul li a,.release-info .rel-info-value,.release-info .rel-info-tag,#edd_login_form .edd-input, #edd_register_form .edd-input,.grid-testimonal-promo .testimonial_details i.testimonial_queto_dm,.bottom_meta a,
        .dm_comment_author,.dm_comment-date,.comment--dot,.single-blog-title a,.single-blog-title,.top-header .top-social-icon li a:hover,code,.search-dropdown-main button,.post-promo-box.grid_dm .overlay_content_center a,a.edd-wl-action.edd-wl-button span,
        .photo--price--block a.edd-wl-action.edd-wl-button{
            color:<?php echo esc_html($maintextcolor); ?>
        }
        h1,h2,h3,h4,h5,h6,a,.mayosis-play--button-video:focus,.mayosis-play--button-video{
            color:<?php echo esc_html($maintextcolor); ?>
        }

        .section-title,.product-meta a:hover,.maxcollapse-open .maxcollapse-input,.maxcollapse-open .maxcollapse-input::placeholder,.maxcollapse-open .maxcollapse-icon,#edd_show_discount,#edd_final_total_wrap,.bottom-product-sidebar h4,.sidebar-details h3 a,.bottom-product-sidebar .sidebar-details p,.bottom-widget-product .product-price .edd_price,.sidebar-details h3,.sidebar-details h3 a,.sidebar-details p,.sidebar-blog-categories ul li a,.edd_price_options.edd_single_mode ul li label,.product-price h3,.single-user-info ul li a,.single-blog-title a,.single-blog-title,.user-info a,legend, pre{
            color:<?php echo esc_html($maintextcolor); ?> !important;
        }
        ::-webkit-input-placeholder,::-moz-placeholder,#edd_checkout_form_wrap input.edd-input::placeholder,#edd_checkout_form_wrap textarea.edd-input::placeholder,#edd_login_form .edd-input::placeholder, #edd_register_form .edd-input::placeholder,sidebar-search input[type=search]::placeholder{
            color:<?php echo esc_html($maintextcolor); ?> !important;
        }
        .tag_widget_single ul li a,.sidebar-blog-categories ul li{
            border-color:<?php echo  esc_html($tagboorderrgb); ?> !important;
            color:<?php echo esc_html($maintextcolor); ?>;
        }
        .ghost_button{
            border-color:<?php echo esc_html($maintextcolor); ?>;
        }
        .ghost_button:hover,.tag_widget_single ul li a:hover{
            background:<?php echo esc_html($maintextcolor); ?>;
        }
        .mayosis-title-audio .mejs-button>button{
            background-color:<?php echo esc_html($maintextcolor); ?>;
        }
        ::-moz-selection{
            background-color:<?php echo esc_html($maintextcolor); ?> !important;
        }
        ::selection{
            background-color:<?php echo esc_html($maintextcolor); ?> !important;
        }
        #menu-toggle,.mobile_user > .navbar-nav > li > a{
            color:<?php echo esc_html($mobilemenutext); ?>;
            border-color:<?php echo esc_html($mobilemenutext); ?>;
        }
        .burger span, .burger span::before, .burger span::after{
            background-color:<?php echo esc_html($mobileheadericon); ?>;
        }
        .mobile-cart-button i{
            color:<?php echo esc_html($mobileheadericon); ?> !important;
        }
        table#edd_checkout_cart tbody,#edd_checkout_cart input.edd-item-quantity,.rel-info-value p{
            border-color:<?php echo esc_html($maintextcolor); ?>;
        }

        .button_text{
            background-color:<?php echo  esc_html($maintextcolor); ?>;
            border-color:<?php echo  esc_html($maintextcolor); ?>;
            color:<?php echo  esc_html($sectxtcolor); ?>;
        }
        .button_ghost.button_text,.button_link.button_text,nav.fes-vendor-menu ul li.active a{
            color:<?php echo  esc_html($maintextcolor); ?>;
        }
        .button_ghost.button_text:hover{
            background:<?php echo  esc_html($maintextcolor); ?> !important;
            border-color:<?php echo  esc_html($maintextcolor); ?>;
            color:<?php echo  esc_html($sectxtcolor); ?>;
        }
        #fes-save-as-draft{
            border-color:<?php echo  esc_html($maintextcolor); ?> !important;
            color:<?php echo  esc_html($maintextcolor); ?> !important;
        }

        <?php endif; ?>
        <?php if ($seccolor): ?>
        .bottom-post-footer-widget,.post-view-style,.post-promo-box,.sidebar-theme,.author_meta_single,.single_author_post,.sidebar-product-widget,.single-blog-widget,
        blockquote,table#edd_purchase_receipt, table#edd_purchase_receipt_products,table,pre,
        table#edd_purchase_receipt, table#edd_purchase_receipt_products,
        .fes-fields textarea{
            background:<?php echo esc_html($seccolor); ?>;
        }

        table#edd_purchase_receipt, table#edd_purchase_receipt_products,table,pre,code{
            border-color:<?php echo esc_html($seccolor); ?>;
        }
        <?php endif; ?>

        /** Primary color**/
        <?php if ($acccolor): ?>
        #commentform input[type=submit],.slider_dm_v .carousel-indicators .active, #edd-purchase-button,.edd-submit,input.edd-submit[type="submit"],
        .dm_register_button,.back-to-top:hover,button.fes-cmt-submit-form,.mini_cart .cart_item.edd_checkout a,.photo-image-zoom{
            background:<?php echo  esc_html($acccolor); ?> !important;
            border-color:<?php echo  esc_html($acccolor); ?> !important;
            color:<?php echo  esc_html($actxtcolor); ?>  !important;
        }
        .button-sub-right .btn,  .wpcf7-submit,.status-publish.sticky:before, .footer-link-page-post  .footer-page-post-link,.lSSlideOuter .lSPager.lSpg > li:hover a, .lSSlideOuter .lSPager.lSpg > li.active a,.lSSlideOuter .lSPager.lSpg > li a {
            background:<?php echo  esc_html($acccolor); ?> !important;
            color:<?php echo  esc_html($actxtcolor); ?>  !important;
        }
        p a,.post-viewas> .nav-pills>li.active>a, .post-viewas>.nav-pills>li.active>a:focus, .post-viewas>.nav-pills>li.active>a:hover,.fourzerofour-info a,a:hover,
        .sidebar-blog-categories ul li:hover, .sidebar-blog-categories ul li:hover a,.dm_comment_author a,
        .single-user-info ul li:first-child a:hover,.mayosis-popup .close:hover,.edd_price_options.edd_single_mode ul li label input:checked~span.edd_price_option_name:before{
            color:<?php echo  esc_html($acccolor); ?>;
        }
        .user-info a:hover,.product-title a:hover,.sidebar-blog-categories ul li:hover,.post-promo-box .single-blog-title a:hover,.modal-body .edd_go_to_checkout,.edd_download_purchase_form .edd_price_options li.item-selected label{
            color:<?php echo  esc_html($acccolor); ?> !important;
        }
        .carousel-indicators li,blockquote{
            border-color:<?php echo  esc_html($acccolor); ?> !important;
        }
        #today a,#edd_payment_mode_select_wrap input[type="radio"]:checked::before,.edd_cart_footer_row .edd_cart_total{
            color:<?php echo  esc_html($acccolor); ?> !important;
        }
        #wp-calendar caption,.edd_discount_link, #edd-login-account-wrap a, #edd-new-account-wrap a {
            color: <?php echo  esc_html($acccolor); ?> !important;
            border-color: <?php echo  esc_html($acccolor); ?> !important;
        }
        .edd-submit.button.blue, .single-cart-button a.btn, .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js, .single-news-letter  .nl__item--submit:hover{
            background:<?php echo  esc_html($acccolor); ?> !important;
            border-color:<?php echo  esc_html($acccolor); ?>  !important;
            color:<?php echo  esc_html($actxtcolor); ?> !important;
        }
        .edd-submit.button.blue:hover, .single-cart-button a:hover.btn, .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js:hover,#commentform input[type=submit]:hover,#sidebar-wrapper a#menu-close,#sidebar-wrapper a#menu-close:hover,.mini_cart .main_widget_checout,#basic-user-avatar-form input[type="submit"],#edd_profile_editor_submit,#basic-user-avatar-form input[type="submit"]:hover,#edd_profile_editor_submit:hover,.styleone.btn,.single-product-buttons .multiple_button_v{
            background-color:<?php echo  esc_html($acccolor); ?> !important;
            border-color:<?php echo  esc_html($acccolor); ?>  !important;
            color:<?php echo  esc_html($actxtcolor); ?>  !important;
        }
        .main-post-promo .single-user-info ul li a:hover,.post-viewas> .nav-pills>li.active>a,.post-viewas> .nav-pills>li>a:hover{
            color:<?php echo  esc_html($acccolor); ?>  !important;
        }
        .button_accent{
            background-color:<?php echo  esc_html($acccolor); ?>;
            border-color:<?php echo  esc_html($acccolor); ?>;
            color:<?php echo  esc_html($actxtcolor); ?>;
        }
        .button_ghost.button_accent,.button_link.button_accent{
            color:<?php echo  esc_html($acccolor); ?>;
        }
        .button_ghost.button_accent:hover{
            background:<?php echo  esc_html($acccolor); ?> !important;
            border-color:<?php echo  esc_html($acccolor); ?>;
            color:<?php echo  esc_html($actxtcolor); ?>;
        }
        <?php endif; ?>
        /** Secondary color**/
        <?php if ($secactcolor): ?>
        .single_author_box, .page_breadcrumb, #searchoverlay ,.overlay,#mayosis-sidebar .mayosis-sidebar-header,h2#sitemap_pages,.mobile--nav-menu,.grid--download--categories a.cat--grid--main::after,.jssortside,#mayosisone_1,#mayosis_side{
            background:<?php echo  esc_html($secactcolor); ?>;
        }
        .sidebar-search #icon-addon,.edd-fd-button,#edd_checkout_cart a.edd-cart-saving-button.edd-submit.button.blue,#edd_checkout_cart .edd-submit.button.blue,.mayosis-collapse-btn,#menu-toggle:hover,a.mobile-cart-button:hover,a.mobile-login-button:hover,#sidebar-wrapper,.modal-backdrop,.mayosis-main-media .mejs-controls,.mayosis-main-media .mejs-container{
            border-color:<?php echo  esc_html($secactcolor); ?> !important;
            background:<?php echo  esc_html($secactcolor); ?> !important;
        }
        #edd_checkout_cart a.edd-cart-saving-button.edd-submit.button.blue:hover,.fourzerofour-info,
        #edd_profile_name_label, #edd_profile_billing_address_label, #edd_profile_password_label,#edd_user_history th,
        .styletwo.btn,.transbutton.btn:hover,.mayosisonet101,.social_share_widget a:hover,.social-button-bottom a:hover i,
        h2.reciept_heading,.fill .btn,#fes-comments-table tr.heading_tr,#fes-product-list thead,#edd_user_commissions_overview table tr th,
        #edd_user_commissions_paid thead tr th,#fes-order-list thead tr th,
        #edd_user_revoked_commissions_table thead tr th, #edd_user_unpaid_commissions_table thead tr th,.photo--template--button:hover{
            border-color:<?php echo  esc_html($secactcolor); ?> !important;
            background:<?php echo  esc_html($secactcolor); ?> !important;
            color:<?php echo  esc_html($sectxtcolor); ?> !important;
        }
        #searchoverlay .search input,#searchoverlay .search span,#searchoverlay .search input,
        #searchoverlay .search input::placeholder,#searchoverlay .close,.overlay{
            border-color:<?php echo  esc_html($sectxtcolor); ?> !important;
            color:<?php echo  esc_html($sectxtcolor); ?> !important;
        }
        .transbutton.btn,.post-viewas> .nav-pills>li>a{
            border-color:<?php echo  esc_html($secactcolor); ?> !important;
            color:<?php echo  esc_html($secactcolor); ?> !important;
        }


        h2.page_title_single,.sep,.page_breadcrumb .breadcrumb > .active,.page_breadcrumb .breadcrumb a,#menu-toggle:hover,a.mobile-cart-button:hover,a.mobile-login-button:hover,#sidebar-wrapper,.overlay_content_center a.overlay_cart_btn,.overlay_content_center a.overlay_cart_btn:hover,.widget-posts .overlay_content_center a i, .bottom-widget-product .overlay_content_center a i{
            color:<?php echo  esc_html($sectxtcolor); ?> !important;
        }
        .breadcrumb a,.breadcrumb > .active,.grid--download--categories a{
            color:<?php echo  esc_html($sectxtcolor); ?>;
        }


        .button_secaccent{
            background-color:<?php echo  esc_html($secactcolor); ?>;
            border-color:<?php echo  esc_html($secactcolor); ?>;
            color:<?php echo  esc_html($sectxtcolor); ?>;
        }
        .button_ghost.button_secaccent,.button_link.button_secaccent{
            color:<?php echo  esc_html($secactcolor); ?>;
        }
        .button_ghost.button_secaccent:hover{
            background:<?php echo  esc_html($secactcolor); ?> !important;
            border-color:<?php echo  esc_html($secactcolor); ?>;
            color:<?php echo  esc_html($sectxtcolor); ?>;
        }
        <?php endif; ?>

        /** Form Field color**/

        <?php if ($formfieldtype=="solid"): ?>
        p.comment-form-comment textarea,#edd_login_form .edd-input, #edd_register_form .edd-input,#edd_checkout_form_wrap input.edd-input, #edd_checkout_form_wrap textarea.edd-input,#edd_checkout_form_wrap select.edd-select,
        #edd_profile_editor_form input:not([type="submit"]),#edd_profile_editor_form select,#edd_user_history td,.dasboard-tab,#contact textarea, .wpcf7-form-control-wrap textarea,
        .fes-pagination a.page-numbers,.fes-pagination span.page-numbers, .fes-product-list-pagination-container a.page-numbers,.fes-product-list-pagination-container span.page-numbers,.fes-fields input[type=text],.fes-fields input[type=email],.fes-fields input[type=password]
        ,.fes-fields textarea,.fes-fields input[type=url],.fes-vendor-comment-respond-form textarea,.fes-fields select{
            background:<?php echo  esc_html($seccolor); ?> !important;
            border-color:<?php echo  esc_html($seccolor); ?> !important;
        }
        input[type="text"], input[type="email"], input[type="password"],.solid-input input{
            background:<?php echo  esc_html($seccolor); ?>;
            border-color:<?php echo  esc_html($seccolor); ?>;
        }
        .common-paginav a.next,.common-paginav a.prev,.common-paginav span.page-numbers.current,#edd_download_pagination a.next,#edd_download_pagination a.prev,#edd_download_pagination span.page-numbers.current,.fes-pagination span.page-numbers.current,.fes-product-list-pagination-container span.page-numbers.current{
            background:<?php echo esc_html($maintextcolor); ?>;
            border-color:<?php echo esc_html($maintextcolor); ?>;
            color:#ffffff;
        }
        .common-paginav a.next:hover,.common-paginav a.prev:hover,.common-paginav a.page-numbers:hover, .common-paginav span.page-numbers:hover,#edd_download_pagination a.page-numbers:hover,#edd_download_pagination span.page-numbers:hover,#edd_download_pagination span.page-numbers.current:hover{
            background:<?php echo esc_html($acccolor); ?>;
            border-color:<?php echo esc_html($acccolor); ?>;
        }
        .common-paginav a.next,.common-paginav a.prev,#edd_download_pagination a.next,#edd_download_pagination a.prev{
            border:0 !important;
        }
        <?php else: ?>

        p.comment-form-comment textarea,#edd_login_form .edd-input, #edd_register_form .edd-input,#edd_checkout_form_wrap input.edd-input, #edd_checkout_form_wrap textarea.edd-input,#edd_checkout_form_wrap select.edd-select,
        #edd_download_pagination a.page-numbers, #edd_download_pagination span.page-numbers,#edd_profile_editor_form input:not([type="submit"]),#edd_profile_editor_form select,#edd_user_history td,.dasboard-tab,#contact textarea,
        .wpcf7-form-control-wrap textarea,input[type="text"], input[type="email"], input[type="password"],.solid-input input, .common-paginav a.next,
        .common-paginav a.prev,#edd_download_pagination a.next,#edd_download_pagination  a.prev,.fes-pagination a.page-numbers,.fes-pagination span.page-numbers, .fes-product-list-pagination-container a.page-numbers,.fes-product-list-pagination-container
        span.page-numbers,.fes-fields input[type=email],.fes-fields input[type=password]
        ,.fes-fields textarea,.fes-fields input[type=url],.fes-fields input[type=text],.fes-vendor-comment-respond-form textarea,.fes-fields select{
            background:transparent;
            border:solid <?php echo  esc_html($globalborderopacity); ?>;
            border-width:<?php echo  esc_html($globalborderthik); ?>;
        }
        .common-paginav a.next:hover,.common-paginav a.prev:hover,.common-paginav a.page-numbers:hover, .common-paginav span.page-numbers:hover,.common-paginav span.page-numbers.current,#edd_download_pagination a.next:hover,#edd_download_pagination a.prev:hover,#edd_download_pagination span.page-numbers.current:hover,#edd_download_pagination span.page-numbers.current,#edd_download_pagination a.page-numbers:hover,
        #edd_download_pagination span.page-numbers:hover,.fes-pagination a.page-numbers:hover,.fes-pagination span.page-numbers:hover,
        .fes-product-list-pagination-container a.page-numbers:hover,
        .fes-product-list-pagination-container span.page-numbers:hover,.fes-pagination span.page-numbers.current,.fes-product-list-pagination-container span.page-numbers.current {
            border-color:<?php echo esc_html($maintextcolor); ?>;
            background:<?php echo esc_html($maintextcolor); ?> !important;

        }
        <?php endif; ?>

        #fes-product-list tbody tr,#fes-order-list tbody tr,
        #edd_user_paid_commissions_table tbody tr,
        #edd_user_revoked_commissions_table tbody tr,
        #edd_user_unpaid_commissions_table tbody tr{
            border-color:<?php echo  esc_html($golbalbgopacity); ?>;
        }
        .fes-ignore.button{
            border:solid <?php echo  esc_html($globalborderopacity); ?>;
            border-width:<?php echo  esc_html($globalborderthik); ?>;
            color:<?php echo esc_html($maintextcolor); ?>;
        }
        .fes-ignore.button:hover{
            background:<?php echo esc_html($maintextcolor); ?>;
        }
        p.comment-form-comment textarea:hover,#commentform input[type=text]:hover, #commentform input[type=email]:hover, p.comment-form-comment textarea:hover,#edd_login_form .edd-input:hover, #edd_register_form .edd-input:hover,#edd_checkout_form_wrap input.edd-input:hover, #edd_checkout_form_wrap textarea.edd-input:hover,#edd_checkout_form_wrap select.edd-select:hover,#edd_profile_editor_form input:not([type="submit"]):hover,#edd_profile_editor_form select:hover,#edd_user_history td:hover,.dasboard-tab,#contact textarea:hover, .wpcf7-form-control-wrap textarea:hover,input[type="text"]:hover, input[type="email"]:hover, input[type="password"]:hover,.solid-input input:hover,.product-search-form input[type="text"]:hover, .product-search-form input[type="search"]:hover{
            border-bottom-color:<?php echo  esc_html($acccolor); ?> !important;
        }
        p.comment-form-comment textarea:focus,#commentform input[type=text]:focus, #commentform input[type=email]:focus, p.comment-form-comment textarea:focus,#edd_login_form .edd-input:focus, #edd_register_form .edd-input:focus,#edd_checkout_form_wrap input.edd-input:focus, #edd_checkout_form_wrap textarea.edd-input:focus,#edd_checkout_form_wrap select.edd-select:focus,#edd_profile_editor_form input:not([type="submit"]):focus,#edd_profile_editor_form select:focus,#edd_user_history td:focus,.dasboard-tab,#contact textarea:focus, .wpcf7-form-control-wrap textarea:focus,input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus,.solid-input input:focus,.product-search-form input[type="text"]:focus, .product-search-form input[type="search"]:focus{
            border-color:<?php echo  esc_html($acccolor); ?> !important;
        }
        <?php if ($producthover): ?>
        .hover_effect_single,.hover_effect,figure.effect-dm2 figcaption{
            background-color:<?php echo  esc_html($producthover); ?>;
            color:<?php echo  esc_html($producthovertxt); ?>

        }
        figure.mayosis-fade-in{
            background-color:<?php echo  esc_html($producthover); ?>;
            color:<?php echo  esc_html($producthovertxt); ?>;
        }
        .button-fill-color{
            background-color:<?php echo  esc_html($producthovertxt); ?>;
            color:<?php echo  esc_html($producthover); ?>;
        }
        .download-count-hover,.product-hover-social-share .social-button a, .product-hover-social-share .social-button a i,.recent_image_block .overlay_content_center a{
            color:<?php echo  esc_html($producthovertxt); ?> !important;
        }
        .button-fill-color:hover,.licence_main_title.youcantitle{
            background:<?php echo  esc_html($acccolor); ?> !important;
            border-color:<?php echo  esc_html($acccolor); ?>  !important;
            color:<?php echo  esc_html($actxtcolor); ?>  !important
        }
        .main_content_licence.youcan table tr td .icon-background1 {
            color:<?php echo  esc_html($acccolor); ?>  !important;
        }
        .overlay_content_center .live_demo_onh{
            border-color:<?php echo  esc_html($producthovertxt); ?>;
            color:<?php echo  esc_html($producthovertxt); ?>;
        }
        .overlay_content_center .live_demo_onh:hover{
            background-color:<?php echo  esc_html($producthovertxt); ?>;
            border-color:<?php echo  esc_html($producthovertxt); ?>;
            color:<?php echo  esc_html($producthover); ?> !important;
        }
        figure.mayosis-fade-in:hover img{
            opacity:<?php echo  esc_html($thumbopacity); ?> !important;
        }
        <?php endif; ?>
        /**End Common Style**/
        /**Header Style**/
        <?php if ($headerbgtype=='gradient'): ?>
        .header-content-wrap,#mayosis-sidebar,#mobileheader{
            background: linear-gradient(45deg, <?php echo esc_html($hgradient['color1']); ?>, <?php echo esc_html($hgradient['color2']); ?>);
        }
        <?php elseif ($headerbgtype=='image'): ?>
        .header-content-wrap,#mayosis-sidebar,#mobileheader{
            background:url(<?php echo esc_html($hbgimage); ?>);
        }
        <?php else: ?>
        .header-content-wrap,#mayosis-sidebar,#mobileheader{
            background:<?php echo  esc_html($hbgcolor); ?>;
        }
        <?php endif; ?>
        #top-main-menu > ul > li > a ,.top-header #cart-menu li a{
            color:<?php echo esc_html($topmenucolor); ?>;
        }
        .top-header .cart_widget .mini_cart{
            background:<?php echo  esc_html($topsubbg); ?>;
        }
        .top-header{
            height:<?php echo  esc_html($topheaderheight ); ?>;
            line-height:<?php echo  esc_html($topheaderheight ); ?>;
            background: <?php echo  esc_html($topheaderbg); ?>;
            color:<?php echo  esc_html($topheadertxt); ?>;
        }
        #top-main-menu > ul > li > a ,.top-header #cart-menu li a {
            line-height:<?php echo  esc_html($topheaderheight ); ?> !important;
        }
        #top-main-menu ul ul a{
            color:<?php echo esc_html( $topsubcolor); ?>;
        }
        #top-main-menu ul ul a, .top-header .cart_widget .mini_cart {
            background:<?php echo  esc_html($topsubbg); ?>;
        }
        #top-main-menu  ul  ul:before,.top-header .cart_widget .mini_cart:before{
            border-bottom: 10px solid <?php echo  esc_html($topsubbg); ?>;
        }
        #top-main-menu ul ul:after, .top-header .cart_widget .mini_cart:after{
            border-bottom: 9px solid <?php echo  esc_html($topsubbg); ?>;
        }
        #top-main-menu > ul > li > a > i , .top-header #cart-menu li a i,#top-main-menu  ul li a i,.top-cart-menu li a i, .top-cart-menu li i {
            font-size:<?php echo  esc_html($topiconsize); ?>;
        }
        /**Header Form **/
        <?php if ($headerformtype=="solid"): ?>
        .fill .form-control,.stylish-input-group input,.search-field,.maxcollapse-open .maxcollapse-input,.photo--price--block a.edd-wl-action.edd-wl-button{
            background-color:<?php echo  esc_html($headerformbgcolor); ?>;
            border-color:<?php echo  esc_html($headerformbgcolor); ?>;
        }
        <?php else: ?>
        .fill .form-control,.stylish-input-group input,.search-field,.maxcollapse-open .maxcollapse-input,.photo--price--block a.edd-wl-action.edd-wl-button{
            background:transparent;
            border-color: <?php echo  esc_html($headerformbgborder); ?>;
            border-width:<?php echo  esc_html($headerformborderthik); ?>;
        }
        <?php endif; ?>
        header.sticky{
            height:<?php echo  esc_html($mainheaderheight); ?>;
        }
        .header-content-wrap{
            height:<?php echo  esc_html($mainheaderheight); ?> ;
            line-height:<?php echo  esc_html($mainheaderheight); ?>;
            padding-top:<?php echo  esc_html($mainheaderpadding['padding-top']); ?>;
            padding-right:<?php echo  esc_html($mainheaderpadding['padding-right']); ?>;
            padding-bottom:<?php echo  esc_html($mainheaderpadding['padding-bottom']); ?>;
            padding-left:<?php echo  esc_html($mainheaderpadding['padding-left']); ?>;
        }

        .main-header
        .maxcollapse,.maxcollapse-icon, .maxcollapse-submit{
            height:<?php echo  esc_html($mainheaderheight); ?>;
            line-height:<?php echo  esc_html($mainheaderheight); ?>;
        }
        #mayosis-menu > ul > li > a{
            line-height:<?php echo  esc_html($mainheaderheight); ?>;
        }
        header.fixedheader #mayosis-menu > ul > li > a,header.fixedheader .cart-button,header.fixedheader .search-dropdown-main a,.sticky #mayosis-menu > ul > li > a,.sticky .cart-button,.sticky .search-dropdown-main a,header.fixedheader .cart-style-two .cart-button,.sticky .cart-style-two .cart-button,header.fixedheader .searchoverlay-button,.sticky .searchoverlay-button,header.fixedheader #menu-toggle,header.fixedheader .mobile_user > .navbar-nav > li > a,.sticky .mobile_user > .navbar-nav > li > a{
            color:<?php echo  esc_html($stickyheadertext); ?> !important;
        }
        header.fixedheader #menu-toggle,header.fixedheader .mobile_user > .navbar-nav > li > a,.sticky .mobile_user > .navbar-nav > li > a{
            border-color:<?php echo  esc_html($stickyheadertext); ?> !important;
        }
        header.fixedheader .burger span, header.fixedheader .burger span::before, header.fixedheader .burger span::after{
            background-color:<?php echo  esc_html($stickyheadertext); ?>;
        }
        <?php if ($headertransparentmain=="transparent"): ?>
        .main-header.header-transparent .header-content-wrap,.mobile-header.header-transparent,#mobileheader {
            background:<?php echo  esc_html($transparentheader); ?>;
        }
        <?php endif; ?>
        <?php if ($stickybg): ?>
        header.sticky {
            background-color:<?php echo  esc_html($stickybg); ?> !important;
        }

        header.fixedheader {
            background:<?php echo  esc_html($stickybg); ?> !important;
        }

        <?php endif; ?>
        <?php if ($smartsticky== 'on'): ?>
        .headroom {position: fixed;left: 0;right: 0;z-index:9999;top:0;}
        .headroom--unpinned,#mobileheader.headroom--unpinned{
            -moz-transform: translateY(-150%);
            -ms-transform: translateY(-150%);
            -webkit-transform: translateY(-150%);
            transform: translateY(-150%)
        }
        header.fixedheader{
            top:0;
        }
        .admin-bar header.fixedheader,.admin-bar .headroom{
            top:32px;
        }
        <?php endif; ?>
        <?php if ($stickylogo): ?>
        header.fixedheader .site-logo img.main-logo,header.fixedheader .center-logo img.main-logo,header.fixedheader#mobileheader .mobile-logo{
            opacity:0;
            display:none !important;
        }
        .fixedheader.main-header .site-logo .sticky-logo,.fixedheader.main-header .center-logo .sticky-logo,#mobileheader.fixedheader .sticky-logo{
            display:inline-block;
            opacity:1;
        }
        <?php endif; ?>
        /**End Header Style**/
        /**Menu Style**/
        <?php if ($menuhovertype=='color'): ?>
        #mayosis-menu> ul > li > a:hover{
            color:<?php echo esc_html($mainnavtexthover); ?>;
        }
        <?php elseif ($menuhovertype=='opacity'): ?>
        #mayosis-menu> ul > li > a:hover{
            opacity:.5;
        }
        <?php elseif ($menuhovertype=='underline'): ?>

        #mayosis-menu> ul > li > a:before{
            position: absolute;
            top: 80%;
            left: 0;
            width: 100%;
            height: 1px;
            background: <?php echo esc_html($mainnavcolor); ?>;
            content: '';
            opacity: 0;
            -webkit-transition: height 0.3s, opacity 0.3s, -webkit-transform 0.3s;
            -moz-transition: height 0.3s, opacity 0.3s, -moz-transform 0.3s;
            transition: height 0.3s, opacity 0.3s, transform 0.3s;
            -webkit-transform: translateY(-5px);
            -moz-transform: translateY(-5px);
            transform: translateY(-5px);
        }
        .menu-item-has-children.has-sub > a :before,.menu-item-has-children.has-sub > a:hover::before{
            display:none;

        }
        #mayosis-menu> ul > li > a:hover::before,
        #mayosis-menu> ul > li > a:focus::before {
            height: 3px;
            opacity: 1;
            -webkit-transform: translateY(0px);
            -moz-transform: translateY(0px);
            transform: translateY(0px);
        }
        #mayosis-menu ul li a i{
            padding-right:0;
        }

        <?php elseif ($menuhovertype=='dotted'): ?>

        #mayosis-menu> ul > li >  a {
            -webkit-transition: color 0.3s;
            -moz-transition: color 0.3s;
            transition: color 0.3s;
        }

        #mayosis-menu> ul > li > a::before {
            position: absolute;
            top: 30%;
            left: 50%;
            color: transparent;
            content: '•';
            text-shadow: 0 0 transparent;
            font-size: 16px;
            -webkit-transition: text-shadow 0.3s, color 0.3s;
            -moz-transition: text-shadow 0.3s, color 0.3s;
            transition: text-shadow 0.3s, color 0.3s;
            -webkit-transform: translateX(-50%);
            -moz-transform: translateX(-50%);
            transform: translateX(-50%);
            pointer-events: none;
        }

        #mayosis-menu> ul > li > a:hover::before,
        #mayosis-menu> ul > li > a:focus::before {
            color: <?php echo esc_html($mainnavcolor); ?>;
            text-shadow: 10px 0 <?php echo esc_html($mainnavcolor); ?>, -10px 0 <?php echo esc_html($mainnavcolor); ?>;
        }
        .menu-item-has-children.has-sub > a :before,.menu-item-has-children.has-sub > a:hover::before{
            display:none;

        }
        #mayosis-menu ul li a i{
            padding-right:0;
        }
        <?php endif; ?>
        #mayosis-menu > ul > li > a,.main-header ul li.cart-style-one a.cart-button,.search-dropdown-main a,.menu-item a,.cart-style-two .cart-button {
            color:<?php echo esc_html($mainnavcolor); ?>;
        }

        #mayosis-menu ul ul{
            color:<?php echo esc_html($mainsubcolor); ?> !important;

        }
        #mayosis-sidemenu > ul > li > a:hover, #mayosis-sidemenu > ul > li.active > a, #mayosis-sidemenu > ul > li.open > a{
            color:<?php echo esc_html($mainsubcolor); ?> !important;
        }
        #mayosis-menu ul ul,.search-dropdown-main ul,.main-cart-bar .cart_widget .mini_cart,.center-right-menu .cart_widget .mini_cart,#mayosis-sidemenu > ul > li > a:hover, #mayosis-sidemenu > ul > li.active > a, #mayosis-sidemenu > ul > li.open > a{
            background:<?php echo esc_html($mainsubbg); ?>;
        }
        .search-dropdown-main ul:after,.main-cart-bar .cart_widget .mini_cart:after,.center-right-menu .cart_widget .mini_cart:after{
            border-bottom: 9px solid <?php echo esc_html($mainsubbg); ?> !important;
        }
        #mayosis-menu ul ul:before{
            border-bottom: 10px solid <?php echo esc_html($mainsubbg); ?> !important;
        }
        .searchoverlay-button{
            color:<?php echo esc_html($mainnavcolor); ?>;
        }
        .cart-style-one .cart-button .edd-cart-quantity, .cart_top_1 > .navbar-nav > li > a.login-button,.main-header .login-button:hover,.sidemenu-login .login-button{
            background:<?php echo esc_html($headeraccent); ?>;
            border-color:<?php echo esc_html($headeraccent); ?>;
            color:<?php echo esc_html($headeraccenttxt); ?>;
        }
        .main-header .login-button{
            background:<?php echo esc_html( $headerbuttonbg); ?>;
            border-color:<?php echo esc_html($headerloginborder); ?>;
            color:<?php echo esc_html($headerbuttontext); ?>;
        }
        header.fixedheader .login-button{
            color:<?php echo esc_html($stickyheadertext); ?>;
            border-color:<?php echo esc_html($stickyheadertext); ?>;
        }
        .mayosis-option-menu li a i, .mayosis-option-menu li i, .desktop-hamburger-item i, #mayosis-menu ul li a i{
            font-size:<?php echo  esc_html($headericonsize); ?>;
        }
        #sidebar-wrapper .navbar-nav > li > a, #sidebar-wrapper #mega-menu-wrap-main-menu #mega-menu-main-menu > li.mega-menu-item > a.mega-menu-link{
            color:<?php echo esc_html($mobilemenutext); ?> !important;
        }

        #sidebar-wrapper .dropdown-menu > li > a {
            color:<?php echo esc_html($mobilemenutext); ?> !important;
        }
        <?php if ($mainmenuiconhide=='show'): ?>
        #mayosis-menu ul li a i {
            padding-right: 5px
        }
        <?php else : ?>
        #mayosis-menu ul li a i {
            display:none;
        }
        <?php endif; ?>
        /**End Menu Style**/
        /**Footer Style**/
        .main-footer{
            padding-top:<?php echo  esc_html($footerpadding['padding-top']); ?>;
            padding-right:<?php echo  esc_html($footerpadding['padding-right']); ?>;
            padding-bottom:<?php echo  esc_html($footerpadding['padding-bottom']); ?>;
            padding-left:<?php echo  esc_html($footerpadding['padding-left']); ?>;
        }
        <?php if ($footerbgtype=='gradient'): ?>
        footer.main-footer{
            background: linear-gradient(190deg, <?php echo esc_html($footerbggradient['color1']); ?>, <?php echo esc_html($footerbggradient['color2']); ?>);
        }
        <?php elseif ($footerbgtype=='image'): ?>
        footer.main-footer{
            background:url(<?php echo esc_html($footerbgimage); ?>);
        }
        <?php else: ?>
        footer.main-footer{
            background:<?php echo  esc_html($footerbgcolor); ?>;
        }
        <?php endif; ?>

        footer.main-footer:after{
            background: url(<?php echo  esc_html($footer_overlay_image); ?>) 100% 100% no-repeat;
        }
        <?php if ($blog_overlay_image): ?>
        .main-blog-promo:after{
            background: url(<?php echo  esc_html($blog_overlay_image); ?>) 100% 100% no-repeat;
        }
        <?php endif; ?>
        <?php if ($productmainoverlay): ?>
        .product-main-header:after{
            background: url(<?php echo  esc_html($productmainoverlay); ?>) 100% 100% no-repeat;
        }
        <?php endif; ?>
        footer.main-footer,.footer-widget-title,.footer-text,.footer-sidebar ul li a,.without-bg-social a,.mx-widget-counter h2,.footer-widget-title, .footer-sidebar .widget-title,.main-footer a,.main-footer ul li a{
            color:<?php echo  esc_html($footertext); ?>;
        }
        .main-footer .sidebar-blog-categories ul li a,.main-footer .recent_post_widget a,
        .main-footer .recent_post_widget p,.main-footer .widget-products a,.main-footer .widget-products p,.main-footer .sidebar-blog-categories ul li{
            color:<?php echo  esc_html($footertext); ?> !important;
        }
        .additional-footer,div.wpcf7-validation-errors, div.wpcf7-acceptance-missing{
            border-color:<?php echo  esc_html($footertext); ?>;
        }
        .back-to-top{
            background-color:<?php echo  esc_html($footertext); ?>;
            border-color:<?php echo  esc_html($footertext); ?>;
            color:<?php echo  esc_html($footerbgcolor); ?>;
        }
        footer .social-profile a{
            background:<?php echo  esc_html($footertext); ?>;
        }
        .copyright-footer{
            background:<?php echo  esc_html($copyrightbg); ?>;
            color:<?php echo  esc_html($copyrighttext); ?>;
        }
        .copyright-text{
            color:<?php echo  esc_html($copyrighttext); ?>;
        }

        .footer-widget .sidebar-theme .single-news-letter .nl__item--submit{
            background-color:<?php echo  esc_html($footertext); ?>;
            border-color:<?php echo  esc_html($footertext); ?>;
            color:<?php echo  esc_html($footerbgcolor); ?>;
        }
        .footer-widget input[type="text"], .footer-widget input[type="email"], .footer-widget input[type="password"],.footer-widget input[type="text"]::placeholder, .footer-widget input[type="email"]::placeholder, .footer-widget input[type="password"]::placeholder{
            color:<?php echo  esc_html($footertext); ?> !important;
        }
        <?php if ($footerfieldtype=='solid'): ?>
        .footer-widget input[type="text"],.footer-widget input[type="email"],.footer-widget input[type="password"]{
            background:<?php echo  esc_html($footerfieldbg); ?> !important;
            border-color:<?php echo  esc_html($footerfieldbg); ?> !important;
        }
        <?php else : ?>
        .footer-widget input[type="text"],.footer-widget input[type="email"],.footer-widget input[type="password"]{
            background:transparent !important;
            border-color:<?php echo  esc_html($footerfieldborder); ?> !important;
            border-width:<?php echo  esc_html($footerborderthik); ?>;
        }
        <?php endif; ?>
        /**End Footer Style**/
        /**Widget Style**/


        .theme--sidebar--widget{
            background: <?php echo esc_html($seccolor); ?> !important;
            padding: 10px 30px;
            border-radius:3px;
        }
        .theme--sidebar--widget  .widget-title{
            text-align:center;
            color:<?php echo  esc_html($widgettitlecolor); ?>;
            padding: 23px;
            margin: -10px -30px;
            margin-bottom: 20px;
        }
        .theme--sidebar--widget .input-group.sidebar-search,.theme--sidebar--widget .search-field{
            margin:20px 0;
        }
        .sidebar-theme .search-form input[type=search],.sidebar-theme input[type=text],.sidebar-theme input[type=email],.sidebar-theme input[type=password],.sidebar--search--blog .search-form input[type=search],.theme--sidebar--widget select,.theme--sidebar--widget .search-field{
            border-color:<?php echo  esc_html($maintextcolor); ?>;
        }
        .theme--sidebar--widget .menu-item a{
            color:<?php echo  esc_html($maintextcolor); ?>;
        }
        .theme--sidebar--widget .single-news-letter .nl__item--submit{
            background-color:<?php echo  esc_html($maintextcolor); ?> !important;
            border-color:<?php echo  esc_html($maintextcolor); ?> !important;
        }

        .product_widget_inside,.sidebar-theme ul{
            padding:0;
        }

        .sidebar-blog-categories {
            padding: 0;
            margin-bottom: 30px;
        }
        .release-info{
            padding:0 !important;
        }


        <?php if ($widgetbgtype=='gradient'): ?>
        .widget-title,.post-tabs .nav-pills > li.active > a, .post-tabs .nav-pills > li.active > a:focus, .post-tabs .nav-pills > li.active > a:hover{
            background: linear-gradient(45deg, <?php echo esc_html($widgetbggradient['color1']); ?>, <?php echo esc_html($widgetbggradient['color2']); ?>);
        }

        <?php else : ?>
        .widget-title,.post-tabs .nav-pills > li.active > a, .post-tabs .nav-pills > li.active > a:focus, .post-tabs .nav-pills > li.active > a:hover{
            background:<?php echo  esc_html($widgetbgcolor); ?>;
        }
        <?php endif; ?>
        <?php if ($widgetfieldtype=='solid'): ?>
        .sidebar-theme .search-form input[type=search],.sidebar-theme input[type=text],.sidebar-theme input[type=email],.sidebar-theme input[type=password],.sidebar--search--blog .search-form input[type=search]{
            background:<?php echo  esc_html($widgetfieldbg); ?>;
            border-color:<?php echo  esc_html($widgetfieldbg); ?>;
            color:<?php echo  esc_html($widgetfieldtext); ?>;
        }
        <?php else: ?>
        .sidebar-theme .search-form input[type=search],.sidebar-theme input[type=text],.sidebar-theme input[type=email],.sidebar-theme input[type=password],.sidebar--search--blog .search-form input[type=search],.theme--sidebar--widget select{
            background-color:transparent;
            border-color:<?php echo  esc_html($widgetfieldborder); ?>;
            border-width:<?php echo  esc_html( $widgetborderthik); ?>;
            color:<?php echo  esc_html($widgetfieldtext); ?>;
        }
        <?php endif; ?>

        .sidebar-theme .single-news-letter .nl__item--submit {
            background:<?php echo  esc_html($widgetfieldborder); ?>;
            border-color:<?php echo  esc_html($widgetfieldborder); ?>;
            color:<?php echo  esc_html($widgettitlecolor); ?>;
        }

        /**End Widget Style**/
        /**Start Product Style**/
        <?php if ($producttemplate=='gradient'): ?>
        .product-main-header{
            background: linear-gradient(<?php echo  esc_html($productanglegradient); ?>deg, <?php echo esc_html($productgradientdefault['color1']); ?>, <?php echo esc_html($productgradientdefault['color2']); ?>) !important;
        }
        <?php elseif ($producttemplate=='image'): ?>

        .product-main-header{
            background: url(<?php echo  esc_html($productmainbg); ?>) no-repeat !important;
            background-size:cover !important;
        }
        <?php elseif ($producttemplate=='featured'): ?>
        .product-main-header:before{
            background:<?php echo  esc_html($productovarlaymain); ?> !important;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 5;
            position: absolute;
            display: inline-block !important;
        }

        <?php elseif ($producttemplate=='color'): ?>

        .product-main-header{
            background:<?php echo  esc_html($productbgdefault); ?> !important;
        }
        <?php endif; ?>

        <?php if ($productblurbg): ?>
        .featuredimagebg{
            filter:blur(<?php echo  esc_html($productblurbg); ?>);
            transform:scale(1.1);
        }
        <?php endif; ?>

        <?php if ($productbgparallax=="yes"): ?>
        .featuredimagebg{
            transform: translateX(1px) scale(1.1);
            background-attachment: fixed !important;
        }
        <?php endif; ?>
        <?php if ($productcontentposition=='center'): ?>
        .single_main_header_products,.product-main-header .breadcrumb{
            text-align:center;
        }
        .product-top-button-flex{
            justify-content:center;
        }
        <?php elseif ($productcontentposition=='right'): ?>
        .single_main_header_products,.product-main-header .breadcrumb{
            text-align:right;
        }
        .product-top-button-flex{
            float:right;
        }
        <?php endif; ?>

        /**Start Blog Style**/
        <?php if ($blogbgtype=='color'): ?>
        .main-post-promo,.page_breadcrumb, .single_author_box, .archive_bredcrumb_header{
            background:<?php echo  esc_html($blogbgcolor); ?>;
        }
        <?php elseif ($blogbgtype=='gradient'): ?>
        .main-post-promo,.page_breadcrumb, .single_author_box, .archive_bredcrumb_header{
            background: linear-gradient(-135deg, <?php echo esc_html($blogbggradient['color1']); ?>, <?php echo esc_html($blogbggradient['color2']); ?>);
        }
        <?php elseif ($blogbgtype=='image'): ?>
        .main-post-promo,.page_breadcrumb, .single_author_box,.archive_bredcrumb_header{
            background:url(<?php echo esc_html($blogbgimage); ?>);
        }

        <?php if ($blogbgimagerepeat=='cover'): ?>
        .main-post-promo,.page_breadcrumb, .single_author_box, .archive_bredcrumb_header{
            background-repeat:no-repeat;
            background-size:cover;

        }
        <?php endif; ?>

        <?php elseif ($blogbgtype=='featured'): ?>
        .archive_bredcrumb_header{
            background:<?php echo  esc_html($secactcolor); ?>;
        }
        .main-blog-promo:before{
            background:<?php echo  esc_html($blogoverlaymain); ?> !important;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 5;
            position: absolute;
            display: inline-block !important;
        }
        <?php else : ?>
        .main-post-promo{
            background-color: #282837;
        }
        <?php endif; ?>

        <?php if ($blogblurbg): ?>
        .featuredimagebgblog{
            filter:blur(<?php echo  esc_html($blogblurbg); ?>);
            transform:scale(1.1);
        }
        <?php endif; ?>

        <?php if ($blogbgparallax=="yes"): ?>
        .featuredimagebgblog{
            transform: translateX(1px) scale(1.1);
            background-attachment: fixed !important;
        }
        <?php endif; ?>

        <?php if ($blogcontentposition=='center'): ?>
        .main-post-promo .breadcrumb,.single--post--header--content{
            text-align:center;
        }

        <?php elseif ($blogcontentposition=='right'): ?>
        .main-post-promo .breadcrumb,.single--post--header--content{
            text-align:right;
        }
        <?php endif; ?>
        .single--post--content a, .single--post--content,h1.single-post-title,.product-style-one-meta,.product-style-one-meta a,.main-post-promo .single-user-info ul li.datearchive,.main-post-promo .single-post-breadcrumbs .breadcrumb a,.main-post-promo .single-user-info ul li a,.single-post-excerpt,.breadcrumb > .active,.main-post-promo .single-social-button,.main-post-promo .single-social-button a i, .single-post-breadcrumbs .breadcrumb > .active,.main-post-promo .blog--layout--contents{
            color:<?php echo  esc_html($productbdtextcolor); ?> !important;
        }
        .comment-button a.btn,.social-button{
            color:<?php echo  esc_html($productbdtextcolor); ?>;
            border-color:<?php echo  esc_html($productbordercolor ); ?>;
        }
        .comment-button a.btn:hover,.social-button a i{
            background-color:<?php echo  esc_html($productbdtextcolor); ?> !important;
            border-color:<?php echo  esc_html($productbdtextcolor); ?> !important;
            color:<?php echo  esc_html($blogbgcolor); ?> !important;
        }

        .ie8 .lblue, .lblue > span,.lblue.left-corner > span::before,.lblue.left-corner > span::after,.lblue.right-corner > span, .lblue.right-corner > span::before,.lblue.right-corner > span::after {
            background-color: <?php echo  esc_html($productlabel); ?>;
            background-image: -webkit-gradient(linear, left top, left bottom, from(<?php echo  esc_html($productlabel); ?>), to(<?php echo  esc_html($productlabel); ?>))!important;
            background-image: -webkit-linear-gradient(top, <?php echo  esc_html($productlabel); ?>,<?php echo  esc_html($productlabel); ?>) !important;
            background-image: -moz-linear-gradient(top, <?php echo  esc_html($productlabel); ?>, <?php echo  esc_html($productlabel); ?>) !important;
            background-image: -ms-linear-gradient(top, <?php echo  esc_html($productlabel); ?>, <?php echo  esc_html($productlabel); ?>) !important;
            background-image: -o-linear-gradient(top, <?php echo  esc_html($productlabel); ?>, <?php echo  esc_html($productlabel); ?>) !important;
            background-image: linear-gradient(to bottom, <?php echo  esc_html($productlabel); ?>, <?php echo  esc_html($productlabel); ?>) !important;
        }
        .lblue.left-edge::before {
            border-left-color: <?php echo  esc_html($productlebeledge); ?> !important;
            border-top-color: <?php echo  esc_html($productlebeledge); ?> !important;
        }
        .page_breadcrumb,.single_author_box,.archive_bredcrumb_header{
            padding-top:<?php echo esc_html($pagepadding['padding-top']);?>;
            padding-bottom:<?php echo esc_html($pagepadding['padding-bottom']);?>;
            padding-right:<?php echo esc_html($pagepadding['padding-right']);?>;
            padding-left:<?php echo esc_html($pagepadding['padding-left']);?>;
        }
        .product-main-header,.main-post-promo{
            padding-top:<?php echo esc_html($productbdpadding['padding-top']);?>;
            padding-bottom:<?php echo esc_html($productbdpadding['padding-bottom']);?>;
            padding-right:<?php echo esc_html($productbdpadding['padding-right']);?>;
            padding-left:<?php echo esc_html($productbdpadding['padding-left']);?>;
        }

        .custombuttonmain.btn{
            background:<?php echo  esc_html($singlebuttonbg); ?> !important;
            border-color:<?php echo  esc_html($singlebuttonbg); ?> !important;
            font-weight: 700;
            font-size: 18px;
            border-radius: 3px;
        }


        .custombuttona.btn{
            background:<?php echo  esc_html($dualbuttona); ?> !important;
            border-color:<?php echo  esc_html($dualbuttona); ?> !important;
            border-width: 2px !important;
            padding: 12px 40px;
            font-weight: 700;
            font-size: 18px;
            border-radius: 3px;
        }


        .custombuttonb.btn{
            border-width: 2px !important;
            padding: 12px 40px;
            font-weight: 700;
            font-size: 18px;
            border-radius: 3px;
        }
        <?php if ($testimonialbg) { ?>
        .grid-testimonal-promo .testimonial_details{

            background:<?php echo  esc_html($testimonialbg); ?>;
        }
        .arrow-down{
            border-top-color:<?php echo esc_html($testimonialbg); ?>;
        }
        <?php } ?>

        .load-mayosis {
            background: linear-gradient(135deg, <?php echo esc_html($loader_gradient['color1'])  ?>, <?php echo esc_html($loader_gradient['color2'])  ?>);
        }
        .loading.reversed li{
            background-color:<?php echo esc_html($loader_gradient['color1'])  ?>;
        }
        <?php if($stickyhideshow == 'on') : ?>
        <?php else:?>
        header.sticky{
            display:none;
        }
        <?php  endif;?>

        /**End Product Style**/
        .bottom_meta p a, .bottom_meta a{
            border-color:<?php echo  esc_html($tagboorderrgb); ?>;
            color:<?php echo esc_html($maintextcolor); ?>;
        }
        .bottom_meta p a:hover, .bottom_meta a:hover{
            background-color:<?php echo esc_html($maintextcolor); ?>;
        }

        .download_cat_filter,.search-btn::after,.download_cat_filter select option{
            background-color:<?php echo esc_html($searchmaincolor); ?>;
            color:<?php echo esc_html($searchaccenttxtcolor); ?>;
        }
        .product-search-form select{
            color:<?php echo esc_html($searchaccenttxtcolor); ?>;
        }
        .product-search-form  .search-fields{
            background-color:<?php echo esc_html($searchmainbgcolor); ?>;
        }
        .product-search-form  input[type="text"]{
            border-color:<?php echo esc_html($searchmainbordercolor); ?>;
        }
        .download-template-download-photo-template{
            background:<?php echo esc_html($phototemplatebg); ?>;
        }
        <?php if ($phototemplateview=="fixed"): ?>
        .photo-template-author,.photo--section--image img {
            max-height: 750px;
        }
        .photo--section--image{
            height: 750px;
        }
        .photo-credential{
            min-height: 750px;
            max-height: 750px;
        }
        .photo--template--author--meta{
            position:absolute;
        }
        .photo-template-author {
            background: #fcfdff;
            -webkit-box-shadow: 0px 4px 32px 0px rgba(15, 20, 30, 0.08);
            -moz-box-shadow:    0px 4px 32px 0px rgba(15, 20, 30, 0.08);
            box-shadow:         0px 4px 32px 0px rgba(15, 20, 30, 0.08);
        }
        .photo--template--button{
            border-color:<?php echo esc_html($secondarycoloropacity); ?>;;
            color:<?php echo esc_html($secondarycolorfifty); ?>;;
        }
        <?php else : ?>
        <?php endif; ?>
        <?php if ($productgridsystem=='two'): ?>
        .edd_downloads_list.edd_download_columns_3{
            column-count: 3;
            display: block;
            column-gap: 30px;
        }
        @media (min-width: 768px){
            #edd_download_pagination {
                margin-top: 60px;
                width: 1170px;
                text-align: center;
                display: block;
                margin-left: 0%;
                position: absolute;
                left: 22%;
                bottom: 0;
                right: 0;
            }}
        <?php endif; ?>

    </style>

<?php }
add_action('wp_head', 'mayosis_dynamic_css');
?>