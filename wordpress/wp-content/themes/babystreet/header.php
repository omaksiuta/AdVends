<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, maximum-scale=1" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php esc_url(bloginfo('pingback_url')); ?>" />
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<?php if (babystreet_get_option('show_preloader')): ?>
			<div class="mask">
				<div id="spinner"></div>
			</div>
		<?php endif; ?>
		<?php if (babystreet_get_option('add_to_cart_sound')): ?>
            <audio id="cart_add_sound" controls preload="auto" hidden="hidden">
                <source src="<?php echo BABYSTREET_IMAGES_PATH ?>cart_add.wav" type="audio/wav">
            </audio>
		<?php endif; ?>
		<?php
		global $babystreet_is_blank;

		// Set main menu as mobile if no mobile menu was set
		$mobile_menu_id  = 'primary';
		if ( has_nav_menu('mobile') ) {
			$mobile_menu_id = "mobile";
		}

		if (!$babystreet_is_blank) {
			// Top mobile menu
			$babystreet_top_nav_mobile_args = array(
					'theme_location' => $mobile_menu_id,
					'container' => 'div',
					'container_id' => 'menu_mobile',
					'menu_id' => 'mobile-menu',
					'items_wrap' => babystreet_build_mobile_menu_items_wrap(),
					'fallback_cb' => '',
					'walker' => new BabystreetMobileMenuWalker()
			);
			wp_nav_menu($babystreet_top_nav_mobile_args);
		}

		// Are search or cart enabled or is account page
		$babystreet_is_search_or_cart_or_account = false;
		if (babystreet_get_option('show_searchform') || (BABYSTREET_IS_WOOCOMMERCE && babystreet_get_option('show_shopping_cart'))|| (BABYSTREET_IS_WOOCOMMERCE && get_option( 'woocommerce_myaccount_page_id' ))) {
			$babystreet_is_search_or_cart_or_account = true;
		}

		$babystreet_general_layout = babystreet_get_option('general_layout');
		$babystreet_specific_layout = get_post_meta(get_queried_object_id(), 'babystreet_layout', true);

		$babystreet_meta_show_top_header = get_post_meta(get_queried_object_id(), 'babystreet_top_header', true);
		if (!$babystreet_meta_show_top_header) {
			$babystreet_meta_show_top_header = 'default';
		}

		$babystreet_featured_slider = get_post_meta(get_queried_object_id(), 'babystreet_rev_slider', true);
		if (!$babystreet_featured_slider) {
			$babystreet_featured_slider = 'none';
		}

		$babystreet_rev_slider_before_header = get_post_meta(get_queried_object_id(), 'babystreet_rev_slider_before_header', true);
		if (!$babystreet_rev_slider_before_header) {
			$babystreet_rev_slider_before_header = 0;
		}
		?>
		<?php if (babystreet_get_option('show_searchform')): ?>
            <div id="search">
				<?php $babystreet_search_options = babystreet_get_option('search_options'); ?>
				<?php if (BABYSTREET_IS_WOOCOMMERCE && isset($babystreet_search_options['only_products']) && $babystreet_search_options['only_products']): ?>
					<?php get_product_search_form(true) ?>
				<?php else: ?>
					<?php get_search_form(); ?>
				<?php endif; ?>
            </div>
		<?php endif; ?>
		<!-- MAIN WRAPPER -->
		<div id="container">
			<!-- If it is not a blank page template -->
			<?php if (!$babystreet_is_blank): ?>
				<?php if (is_page() && $babystreet_featured_slider != 'none' && function_exists('putRevSlider') && $babystreet_rev_slider_before_header): ?>
					<!-- FEATURED REVOLUTION SLIDER -->
					<div class="babystreet-intro slideshow">
						<div class="inner">
							<?php putRevSlider($babystreet_featured_slider) ?>
						</div>
					</div>
					<!-- END OF FEATURED REVOLUTION SLIDER -->
				<?php endif; ?>
				<!-- Collapsible Pre-Header -->
				<?php if (babystreet_get_option('enable_pre_header') && is_active_sidebar('pre_header_sidebar')): ?>
					<div id="pre_header"> <a href="#" class="toggler" id="toggle_switch" title="<?php esc_attr_e('Show/Hide', 'babystreet') ?>"><?php esc_html_e('Slide toggle', 'babystreet') ?></a>
						<div id="togglerone" class="inner">
							<!-- Pre-Header widget area -->
							<?php dynamic_sidebar('pre_header_sidebar') ?>
							<div class="clear"></div>
						</div>
					</div>
				<?php endif; ?>
				<!-- END Collapsible Pre-Header -->
				<!-- HEADER -->
				<?php
                    $babystreet_should_show_top_header = false;
                    if( babystreet_get_option('enable_top_header') && $babystreet_meta_show_top_header == 'default' || $babystreet_meta_show_top_header == 'show') {
	                    $babystreet_should_show_top_header = true;
                    }

                    $babystreet_theme_logo_img = babystreet_get_option('theme_logo');
                    $babystreet_transparent_theme_logo_img = babystreet_get_option('transparent_theme_logo');
                    $babystreet_mobile_logo_img = babystreet_get_option('mobile_theme_logo');

                    // If there is no secondary logo add 'persistent_logo' class to the main logo
                    $babystreet_persistent_logo_class = $babystreet_transparent_theme_logo_img ? '' : 'persistent_logo';

                    if (!$babystreet_theme_logo_img && !$babystreet_transparent_theme_logo_img && (get_bloginfo('name') || get_bloginfo('description'))) {
                        $babystreet_is_text_logo = true;
                    } else {
                        $babystreet_is_text_logo = false;
                    }

                    $babystreet_header_classes = array();
                    if($babystreet_should_show_top_header) {
                        $babystreet_header_classes[] = 'babystreet-has-header-top';
                    }
                    if($babystreet_is_text_logo) {
                        $babystreet_header_classes[] = 'babystreet_text_logo';
                    }
                ?>
				<div id="header" <?php if(!empty($babystreet_header_classes)):?>class="<?php echo esc_attr(implode(' ', $babystreet_header_classes)) ?>" <?php endif; ?> >
					<?php if ( $babystreet_should_show_top_header ): ?>
						<div id="header_top" class="fixed">
							<div class="inner<?php if(has_nav_menu("secondary")) echo " has-top-menu" ?>">
								<?php if (function_exists('icl_get_languages')): ?>
									<div id="language">
										<?php babystreet_language_selector_flags(); ?>
									</div>
								<?php endif; ?>
								<!--	Social profiles in header-->
								<?php if (babystreet_get_option('social_in_header')): ?>
									<?php get_template_part('partials/social-profiles'); ?>
								<?php endif; ?>
								<?php if (babystreet_get_option('top_bar_message') || babystreet_get_option('top_bar_message_phone') || babystreet_get_option('top_bar_message_email')): ?>
									<div class="babystreet-top-bar-message">
										<?php echo esc_html(babystreet_get_option('top_bar_message')) ?>
										<?php if (babystreet_get_option('top_bar_message_email')): ?>
											<span class="babystreet-top-bar-mail">
												<?php if ( babystreet_get_option( 'top_bar_message_email_link' ) ): ?><a href="mailto:<?php echo esc_html( babystreet_get_option( 'top_bar_message_email' ) ) ?>"><?php endif; ?>
													<?php echo esc_html(babystreet_get_option('top_bar_message_email')) ?>
												<?php if ( babystreet_get_option( 'top_bar_message_email_link' ) ): ?></a><?php endif; ?>
											</span>
										<?php endif; ?>
										<?php if (babystreet_get_option('top_bar_message_phone')): ?>
											<span class="babystreet-top-bar-phone">
												<?php if ( babystreet_get_option( 'top_bar_message_phone_link' ) ): ?><a href="tel:<?php echo preg_replace( "/[^0-9+-]/", "", esc_html( babystreet_get_option( 'top_bar_message_phone' ) ) ) ?>"><?php endif; ?>
													<?php echo esc_html( babystreet_get_option( 'top_bar_message_phone' ) ) ?>
												<?php if ( babystreet_get_option( 'top_bar_message_phone_link' ) ): ?></a><?php endif; ?>
											</span>
										<?php endif; ?>
									</div>
								<?php endif; ?>
								<?php
								/* Secondary menu */
								$babystreet_side_nav_args = array(
										'theme_location' => 'secondary',
										'container' => 'div',
										'container_id' => 'menu',
										'menu_class' => '',
										'menu_id' => 'topnav2',
										'fallback_cb' => '',
								);
								wp_nav_menu($babystreet_side_nav_args);
								?>
							</div>
						</div>
					<?php endif; ?>

					<div class="inner main_menu_holder fixed<?php if(has_nav_menu('primary')) echo ' has-main-menu' ?>">
						<div <?php if ($babystreet_is_text_logo) echo 'class="babystreet_text_logo"' ?> id="logo">
							<a href="<?php echo esc_url(babystreet_wpml_get_home_url()); ?>"  title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
								<?php
								// Main logo
								if ($babystreet_theme_logo_img) {
									echo wp_get_attachment_image($babystreet_theme_logo_img, 'full', false, array('class' => esc_attr($babystreet_persistent_logo_class)));
								}

								// Secondary logo
								if ($babystreet_transparent_theme_logo_img) {
									echo wp_get_attachment_image($babystreet_transparent_theme_logo_img, 'full', false, array('class' => 'transparent_logo'));
								}

								// Mobile logo
								if ($babystreet_mobile_logo_img) {
									echo wp_get_attachment_image($babystreet_mobile_logo_img, 'full', false, array('class' => 'babystreet_mobile_logo'));
								}
								?>
								<?php if ($babystreet_is_text_logo): ?>
									<span class="babystreet-logo-title"><?php bloginfo('name') ?></span>
									<span class="babystreet-logo-subtitle"><?php bloginfo('description') ?></span>
								<?php endif; ?>
							</a>
						</div>
						<a class="mob-menu-toggle" href="#"><i class="fa fa-bars"></i></a>

						<?php if ($babystreet_is_search_or_cart_or_account): ?>
							<div class="babystreet-search-cart-holder">
								<?php if (babystreet_get_option('show_searchform')): ?>
                                    <div class="babystreet-search-trigger">
                                        <a href="#" title="<?php echo esc_attr__('Search', 'babystreet') ?>"><i class="fa fa-search"></i></a>
                                    </div>
								<?php endif; ?>

								<!-- SHOPPING CART -->
								<?php if (BABYSTREET_IS_WOOCOMMERCE && babystreet_get_option('show_shopping_cart')): ?>
									<ul id="cart-module" class="site-header-cart">
										<?php babystreet_cart_link(); ?>
										<li>
											<?php the_widget('WC_Widget_Cart', 'title='); ?>
										</li>
									</ul>
								<?php endif; ?>
								<!-- END OF SHOPPING CART -->

								<?php if (babystreet_should_show_wishlist_icon()): ?>
									<div class="babystreet-wishlist-counter">
										<a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>" title="<?php echo esc_attr__('Wishlist', 'babystreet') ?>">
											<i class="fa fa-heart"></i>
											<span class="babystreet-wish-number"><?php echo esc_html(YITH_WCWL()->count_products()); ?></span>
										</a>
									</div>
								<?php endif; ?>

								<?php global $current_user; ?>

								<?php $babystreet_has_content_woocommerce_my_account = false; ?>
								<?php if(isset($post->post_content) && has_shortcode($post->post_content, 'woocommerce_my_account') ): ?>
									<?php $babystreet_has_content_woocommerce_my_account = true; ?>
								<?php endif; ?>

								<?php if (babystreet_should_show_account_icon() && (is_user_logged_in() || (!is_user_logged_in() && !$babystreet_has_content_woocommerce_my_account))): ?>
									<?php wp_get_current_user(); ?>
									<?php
									$babystreet_account_holder_classes = array();
									if(is_user_logged_in()) {
										$babystreet_account_holder_classes[] = 'babystreet-user-is-logged';
									} else {
										$babystreet_account_holder_classes[] = 'babystreet-user-not-logged';
									}
									?>
                                    <div id="babystreet-account-holder" <?php if(count($babystreet_account_holder_classes)) echo 'class="'.implode(' ', $babystreet_account_holder_classes).'"' ?> >
                                        <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" title="<?php esc_attr_e( 'My Account', 'babystreet' ); ?>">
                                            <i class="fa fa-user"></i>
                                        </a>
                                        <div class="babystreet-header-account-link-holder">
		                                    <?php if(is_user_logged_in()): ?>
                                                <ul>
                                                    <li>
                                                        <span class="babystreet-header-user-data">
                                                            <?php echo get_avatar($current_user->ID, 60); ?>
                                                            <small><?php echo esc_html($current_user->display_name); ?></small>
                                                        </span>
                                                    </li>
				                                    <?php if (BABYSTREET_IS_WC_MARKETPLACE && is_user_wcmp_vendor($current_user)): ?>
                                                        <li class="babystreet-header-account-wcmp-dash">
	                                                        <?php $babystreet_wcmp_dashboard_page_link = wcmp_vendor_dashboard_page_id() ? get_permalink(wcmp_vendor_dashboard_page_id()) : '#'; ?>
	                                                        <?php echo apply_filters('wcmp_vendor_goto_dashboard', '<a href="' . esc_url($babystreet_wcmp_dashboard_page_link) . '">' . esc_html__('Vendor Dashboard', 'babystreet') . '</a>'); ?>
                                                        </li>
				                                    <?php elseif(BABYSTREET_IS_WC_VENDORS_PRO && WCV_Vendors::is_vendor( $current_user->ID )): ?>
                                                        <li class="babystreet-header-account-vcvendors-pro-dash">
						                                    <?php $babystreet_wcv_pro_dashboard_page 	= WCVendors_Pro::get_option( 'dashboard_page_id' ); ?>
						                                    <?php if($babystreet_wcv_pro_dashboard_page): ?>
                                                                <a href="<?php echo esc_url(get_permalink($babystreet_wcv_pro_dashboard_page)); ?>"><?php echo esc_html__('Vendor Dashboard', 'babystreet'); ?></a>
						                                    <?php endif; ?>
                                                        </li>
				                                    <?php elseif(BABYSTREET_IS_WC_VENDORS && WCV_Vendors::is_vendor( $current_user->ID )): ?>
                                                        <li class="babystreet-header-account-vcvendors-dash">
						                                    <?php $babystreet_wcv_free_dashboard_page 	= WC_Vendors::$pv_options->get_option( 'vendor_dashboard_page' ); ?>
						                                    <?php if($babystreet_wcv_free_dashboard_page): ?>
                                                                <a href="<?php echo esc_url(get_permalink($babystreet_wcv_free_dashboard_page)); ?>"><?php echo esc_html__('Vendor Dashboard', 'babystreet'); ?></a>
						                                    <?php endif; ?>
                                                        </li>
				                                    <?php endif; ?>
				                                    <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                                                        <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                                                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                                                        </li>
				                                    <?php endforeach; ?>
                                                </ul>
		                                    <?php elseif(!$babystreet_has_content_woocommerce_my_account): ?>
			                                    <?php echo do_shortcode('[woocommerce_my_account]'); ?>
		                                    <?php endif; ?>
                                        </div>
                                    </div>
								<?php endif; ?>

							</div>
						<?php endif; ?>
						<?php
						// Top menu
						$babystreet_top_menu_container_class = 'menu-main-menu-container';

						$babystreet_top_nav_args = array(
								'theme_location' => 'primary',
								'container' => 'div',
								'container_id' => 'main-menu',
								'container_class' => $babystreet_top_menu_container_class,
								'menu_id' => 'main_nav',
								'fallback_cb' => '',
								'walker' => new BabystreetFrontWalker()
						);
						wp_nav_menu($babystreet_top_nav_args);
						?>
					</div>
				</div>
				<!-- END OF HEADER -->
			<?php endif; ?>
