<?php

	$theme_color = esc_attr(Integrio_Theme_Helper::get_option("theme-custom-color"));
	$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);

	$defaults = array(
		// General
		'icon_type' => 'none',
		'icon_font_type' => 'type_flaticon',
		'icon_fontawesome' => 'fa fa-adjust',
		'icon_flaticon' => '',
		'thumbnail' => '',
		'custom_icon_size' => '',
		'title' => '',
		'subtitle' => '',
		'service_content' => '',
		'alignment' => 'left',
		'item_pad' => '',
		'item_pad_top' => '',
		'add_shadow' => false,
		'add_link' => false,
		'link_container' => false,
		'link' => '',
		'item_el_class' => '',
		'title_color' => $header_font_color,
		'icon_color' => $theme_color,
		'title_size' => '',
		'title_weight' => '',
		'content_size' => '',
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$output = $services_wrap_classes = $animation_class = $services_title = $icon_type_html = $services_links = $services_content = $services_logo = $services_subtitle = '';

	// Animation
	if (!empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	}

	// Allowed HTML render
	$allowed_html = array(
		'a' => array(
			'href' => true,
			'title' => true,
		),
		'br' => array(),
		'b' => array(),
		'em' => array(),
		'strong' => array()
	); 

	// services wrapper classes
	$services_wrap_classes .= $animation_class;
	$services_wrap_classes .=  ' services_'.$alignment;
	$services_wrap_classes .=  (bool)$add_shadow ? ' add_shadow' : '';
	$services_wrap_classes .= !empty($item_el_class) ? ' '.$item_el_class : '';

	// Icon/Image output
	if ($icon_type != 'none') {
		if ($icon_type == 'font' && (!empty($icon_fontawesome) || !empty($icon_flaticon))) {
			if ($icon_font_type == 'type_fontawesome') {
				wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
				$icon_font = $icon_fontawesome;
			} else if($icon_font_type == 'type_flaticon'){
				wp_enqueue_style('flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
				$icon_font = $icon_flaticon;
			}
			$icon_style = ($custom_icon_size != '' || !empty($icon_color)) ? ' style="'.($custom_icon_size != '' ? 'font-size:'.esc_attr((int)$custom_icon_size).'px; ' : '').(!empty($icon_color) ? 'color:'.esc_attr($icon_color).';' : '' ).'"' : '';
			$icon_type_html .= '<i class="services_icon '.esc_attr($icon_font).'" '.$icon_style.'></i>';
		} else if ($icon_type == 'image' && !empty($thumbnail)) {
			$featured_image = wp_get_attachment_image_src($thumbnail, 'full');
			$featured_image_url = $featured_image[0];
			$img_alt = get_post_meta($thumbnail, '_wp_attachment_image_alt', true);
			$icon_type_html .= '<div class="services_icon"><img src="'.esc_url($featured_image_url).'" alt="'.(!empty($img_alt) ? esc_attr($img_alt) : '').'" /></div>';
		}
	}
	$title_font_color = !empty($title_color) ? 'color:'.esc_attr($title_color).'; ' : '';
	$title_font_size = ($title_size != '') ? 'font-size:'.(int)$title_size.'px; ' : '';
	$title_font_weight = ($title_weight != '') ? 'font-weight:'.$title_weight.'; ' : '';
	$title_styles = esc_attr($title_font_size).esc_attr($title_font_weight).$title_font_color;
	$title_styles = !empty($title_styles) ? ' style="'.$title_styles.'"' : '';

	// title
	if (!empty($title)) {
		$services_title .= '<h4 class="services_title" '.$title_styles.'>'.wp_kses($title ,$allowed_html).'</h4>';
	}

	// subtitle
	if (!empty($subtitle)) {
		$services_subtitle .= '<div class="services_subtitle">'.esc_html($subtitle).'</div>';
	}

	// content
	if (!empty($service_content)) {
		$services_content .= '<div class="services_content" '.(($content_size != '') ? 'style="font-size:'.esc_attr((int)$content_size).'px;"' : '').'>'.esc_html($service_content).'</div>';
	}

	if ((bool)$add_link) {
		$link_temp = vc_build_link($link);
		$url = $link_temp['url'];
		$link_title = $link_temp['title'];
		$target = $link_temp['target'];
	
		// image html
		if (!(bool)$link_container) {
			$services_links .= '<div class="services_link-wrapper"><div><a href="'.(!empty($url) ? esc_url($url) : '#').'" class="services_link" target="'.esc_attr($target).'">'.esc_html($link_title).'</a></div></div>';
		}
	}

	// styles wrap
	$item_pad_st = ($item_pad != '') ? 'padding-left: '.esc_attr((int)$item_pad).'px; padding-right: '.esc_attr((int)$item_pad).'px; ' : '';
	$item_pad_top = ($item_pad_top != '') ? 'padding-top: '.esc_attr((int)$item_pad_top).'px;' : '';
	$services_styles = $item_pad_st.$item_pad_top;
	$services_styles = !empty($services_styles) ? ' style="'.$services_styles.'"' : '';

	// render html
	$output .= '<div class="integrio_module_services_4'.esc_attr($services_wrap_classes).'" '.$services_styles.'>';
		$output .= ((bool)$add_link && (bool)$link_container) ? '<a href="'.(!empty($url) ? esc_url($url) : '#').'" class="services_link-container" target="'.esc_attr($target).'">' : '';
			$output .= '<div class="services_wrapper">';
				$output .= '<div class="services_icon-wrap">';
					$output .= !empty($icon_type_html) ? $icon_type_html : '';
				$output .= '</div>';
				$output .= $services_title;
				$output .= $services_subtitle;
				$output .= '<div class="services_content-wrap">';
					$output .= $services_content;
					$output .= $services_links;
				$output .= '</div>';
			$output .= '</div>';
		$output .= ((bool)$add_link && (bool)$link_container) ? '</a>' : '';
	$output .= '</div>';

	echo Integrio_Theme_Helper::render_html($output);

?>