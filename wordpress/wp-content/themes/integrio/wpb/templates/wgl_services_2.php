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
		'service_content' => '',
		'alignment' => 'left',
		'values' => '',
		'item_el_class' => '',
		'custom_colors' => false,
		'title_color' => $header_font_color,
		'icon_color' => $theme_color,
		'content_color' => '#616161',
		'button_color' => $header_font_color,
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$output = $services_wrap_classes = $animation_class = $services_title = $icon_type_html = $services_links = $services_content = $services_logo = $bg_style = '';

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

	// title
	if (!empty($title)) {
		$services_title .= '<h4 class="services_title" '.((bool)$custom_colors && !empty($title_color) ? 'style="color:'.esc_attr($title_color).'"' : '').'>'.wp_kses($title ,$allowed_html).'</h4>';
	}

	// subtitle
	if (!empty($service_content)) {
		$services_content .= '<div class="services_content" '.((bool)$custom_colors && !empty($content_color) ? 'style="color:'.esc_attr($content_color).'"' : '').'>'.esc_html($service_content).'</div>';
	}

	$values = (array) vc_param_group_parse_atts( $values );
	$item_data = array();
	foreach ( $values as $data ) {
		$data['link'] = isset( $data['link'] ) ? $data['link'] : '#';

		$item_data[] = $data;
	}

	foreach ( $item_data as $item_d ) {
		$link_temp = vc_build_link($item_d['link']);
		$url = $link_temp['url'];
		$link_title = $link_temp['title'];
		$target = $link_temp['target'];

		// image html
		$services_links .=  '<div><a href="'.(!empty($url) ? esc_url($url) : '#').'" class="services_link" target="'.esc_attr($target).'" '.((bool)$custom_colors && !empty($button_color) ? 'style="color:'.esc_attr($button_color).'"' : '').'>'.esc_html($link_title).'</a></div>';
	}

	// render html
	$output .= '<div class="integrio_module_services_2'.esc_attr($services_wrap_classes).'">';
		$output .= '<div class="services_wrapper">';
			$output .= !empty($icon_type_html) ? $icon_type_html : '';
			$output .= '<div class="services_content-wrap">';
				$output .= $services_title;
				$output .= $services_content;
				$output .= '<div class="services_links-wrapper">';
					$output .= $services_links;
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
	$output .= '</div>';

	echo Integrio_Theme_Helper::render_html($output);

?>