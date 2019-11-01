<?php

	$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
	$theme_color_secondary = esc_attr(Integrio_Theme_Helper::get_option('theme-secondary-color'));
	$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);
	$theme_gradient_start = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['from']);
	$theme_gradient_end = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['to']);

	$defaults = array(
		// General
		'fb_dir' => 'flip_right',
		'fb_align' => 'center',
		'fb_height' => '',
		'extra_class' => '',
		// Front Side
		'front_bg_style' => 'front_color',
		'front_bg_color' => '',
		'front_bg_image' => '',
		'front_logo_image' => '',
		'front_subtitle' => '',
		'front_subtitle_color' => '',
		'front_subtitle_font_size' => '',
		'front_title' => '',
		'front_title_color' => '',
		'front_title_font_size' => '',
		'front_descr' => '',
		'front_descr_color' => '',
		'front_descr_font_size' => '',
		// Back Side
		'back_bg_style' => 'back_color',
		'back_bg_color' => '',
		'back_bg_image' => '',
		'bg_gradient_idle_start' => $theme_gradient_start,
		'bg_gradient_idle_end' => $theme_gradient_end,
		'add_back_logo_image' => false,
		'back_logo_image' => '',
		'back_title' => '',
		'back_title_color' => '',
		'back_descr' => '',
		'back_descr_color' => '',
		'add_read_more' => false,
		'read_more_color' => $theme_color,
		'read_more_text' => 'Read More',
		'link' => '',
		'add_icon_button' => false,
		'button_icon_fontawesome' => 'fa fa-adjust',
		'button_icon_position' => 'left',
		// Spacings
		'front_offsets' => '',
		'back_offsets' => '',
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$flipbox_id_attr = $animation_class = '';

	// RegExs for defining custom offsets
	preg_match('/\{(.+)\}/', $front_offsets, $front_offsets_css);
	$front_offsets_css = !empty($front_offsets_css) ? $front_offsets_css[1] : '';

	preg_match('/\{(.+)\}/', $back_offsets, $back_offsets_css);
	$back_offsets_css = !empty($back_offsets_css) ? $back_offsets_css[1] : '';

	// Adding unique id for flip box item
	if ($front_offsets_css || $back_offsets_css || $read_more_color != $theme_color) {
		$flipbox_id = uniqid( "integrio_flipbox_" );
		$flipbox_id_attr = ' id='.$flipbox_id;
	}

	// Custom styles
	ob_start();
		if ( !empty($front_offsets_css) ) {
			echo "#$flipbox_id .flipbox_front { $front_offsets_css }";
		}
		if ( !empty($back_offsets_css) ) {
			echo "#$flipbox_id .flipbox_back { $back_offsets_css }";
		}
		if ($read_more_color != $theme_color) {
			echo "#$flipbox_id .flipbox_button {
					  color: ".(!empty($read_more_color) ? esc_attr($read_more_color) : '#ffffff').";
				  }";
		}
	$styles = ob_get_clean();
	Integrio_shortcode_css()->enqueue_integrio_css($styles);

	// Animation
	if (!empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	}

	// Flipbox wrapper classes
	$flipbox_wrap_classes = ' type_'.$fb_dir;
	$flipbox_wrap_classes .= ' align-'.$fb_align;
	$flipbox_wrap_classes .= $animation_class;
	$flipbox_wrap_classes .= !empty($extra_class) ? ' '.$extra_class : '';

	// Front side styles
	switch ($front_bg_style) {
		case 'front_color':
			$front_styles = !empty($front_bg_color) ? 'background-color:'.esc_attr($front_bg_color).';' : '';
			break;
		case 'front_image':
			$front_image = wp_get_attachment_image_src($front_bg_image, 'full');
			$front_image_url = $front_image[0];
			$front_styles = 'background-image: url('.esc_url($front_image_url).');';
			break;
	}
	$front_styles = !empty($front_styles) ? ' style="'.$front_styles.'"' : '';

	// Back side styles
	switch ($back_bg_style) {
		case 'back_color':
			$back_styles = !empty($back_bg_color) ? 'background-color:'.esc_attr($back_bg_color).';' : '';
			break;
		case 'back_image':
			$back_image = wp_get_attachment_image_src($back_bg_image, 'full');
			$back_image_url = $back_image[0];
			$back_styles = 'background-image: url('.esc_url($back_image_url).');';
			break;
		case 'gradient':
			$bg_gradient_idle_start = !empty($bg_gradient_idle_start) ? esc_attr($bg_gradient_idle_start) : 'transparent';
			$bg_gradient_idle_end = !empty($bg_gradient_idle_end) ? esc_attr($bg_gradient_idle_end) : 'transparent';
			$back_styles = 'background: linear-gradient(90deg, '.$bg_gradient_idle_start.', '.$bg_gradient_idle_end.');';
			break;
	}
	$back_styles = !empty($back_styles) ? ' style="'.$back_styles.'"' : '';

	// Frontside logo image
	$flipbox_front_logo = wp_get_attachment_image_src($front_logo_image, 'full');
	$front_logo_img_alt = get_post_meta($front_logo_image, '_wp_attachment_image_alt', true);
	$front_logo_url = $flipbox_front_logo[0];

	// Read more button
	$link_temp = vc_build_link($link);
	$url = $link_temp['url'];
	$button_title = $link_temp['title'];
	$target = $link_temp['target'];
	$button_attr = !empty($url) ? 'href="'.esc_url($url).'"' : 'href="#"';
	$button_attr .= !empty($button_title) ? " title='".esc_attr($button_title)."'" : '';
	$button_attr .= !empty($target) ? ' target="'.esc_attr($target).'"' : '';
	$flipbox_button = (bool)$add_read_more ? '<a class="flipbox_button button-read-more" '.$button_attr.'>'.esc_html($read_more_text).'</a>' : '';

	// Back side logo image
	$flipbox_back_logo = wp_get_attachment_image_src($back_logo_image, 'full');
	$back_logo_img_alt = get_post_meta($back_logo_image, '_wp_attachment_image_alt', true);
	$back_logo_url = $flipbox_back_logo[0];

	// Flipbox Wrapper Styles
	$flipbox_height = !empty($fb_height) ? 'min-height: '.$fb_height.'px; ' : '';
	$flipbox_styles = !empty($flipbox_height) ? 'style="'.$flipbox_height.'"' : '';

	// Front subtitle
	$front_subtitle_style = !empty($front_subtitle_color) ? 'color: '.esc_attr($front_subtitle_color).';' : '';
	$front_subtitle_style .= !empty($front_subtitle_font_size) ? 'font-size:'.esc_attr((int)$front_subtitle_font_size).'px;' : '';
	$front_subtitle_styles = !empty($front_subtitle_style) ? ' style="'.$front_subtitle_style.'"' : '';
	$front_subtitle_output = !empty($front_subtitle) ? '<div class="flipbox_subtitle" '.$front_subtitle_styles.'>'.esc_html($front_subtitle).'</div>' : '';

	// Front title
	$front_title_style = !empty($front_title_color) ? 'color: '.esc_attr($front_title_color).';' : '';
	$front_title_style .= !empty($front_title_font_size) ? 'font-size: '.esc_attr((int)$front_title_font_size).'px;' : '';
	$front_title_styles = !empty($front_title_style) ? ' style="'.$front_title_style.'"' : '';
	$front_title_output = !empty($front_title) ? '<h5 class="flipbox_title"'.$front_title_styles.'>'.esc_html($front_title).'</h5>' : '';

	// Front desciption
	$front_descr_style = !empty($front_descr_color) ? 'color: '.esc_attr($front_descr_color).';' : '';
	$front_descr_style .= !empty($front_descr_font_size) ? 'font-size: '.esc_attr((int)$front_descr_font_size).'px;' : '';
	$front_descr_styles = !empty($front_descr_style) ? ' style="'.$front_descr_style.'"' : '';
	$front_descr_output = !empty($front_descr) ? '<div class="flipbox_description"'.$front_descr_styles.'>'.esc_html($front_descr).'</div>' : '';

	// Back desciption
	$back_descr_style = !empty($back_descr_color) ? 'color: '.esc_attr($back_descr_color).';' : '';
	$back_descr_styles = !empty($back_descr_style) ? ' style="'.$back_descr_style.'"' : '';
	$back_descr_output = !empty($back_descr) ? '<div class="flipbox_content"'.$back_descr_styles.'>'.esc_html($back_descr).'</div>' : '';

	// Front Side
	$flipbox_front = '<div class="flipbox_front" '.$front_styles.'>';
		$flipbox_front .= !empty($front_logo_url) ? '<img class="flipbox_logo" src="'.esc_url($front_logo_url).'" alt="'.(!empty($front_logo_img_alt) ? esc_attr($front_logo_img_alt) : 'front-logo').'" />' : '';
		$flipbox_front .= $front_subtitle_output;
		$flipbox_front .= $front_title_output;
		$flipbox_front .= $front_descr_output;
	$flipbox_front .= '</div>';

	// Back Side
	$flipbox_back = '<div class="flipbox_back"'.$back_styles.'>';
		$flipbox_back .= !empty($back_logo_url) ? '<div class="flipbox_logo"><img src="'.esc_url($back_logo_url).'" alt="'.(!empty($back_logo_img_alt) ? esc_attr($back_logo_img_alt) : 'back-logo').'"></div>' : '';
		$flipbox_back .= !empty($back_title) ? '<h5 class="flipbox_title" '.(!empty($back_title_color) ? 'style="color:'.esc_attr($back_title_color).';"' : '').'>'.esc_html($back_title).'</h5>' : '';
		$flipbox_back .= $back_descr_output;
		$flipbox_back .= $flipbox_button;
	$flipbox_back .= '</div>';

	// Render html
	$output = '<div'.$flipbox_id_attr.' class="integrio_module_flipbox'.esc_attr($flipbox_wrap_classes).'">';
		$output .= '<div class="flipbox_wrapper" '.$flipbox_styles.'>';
			$output .= $flipbox_front;
			$output .= $flipbox_back;
		$output .= '</div>';
	$output .= '</div>';

	echo Integrio_Theme_Helper::render_html($output);

?>  
