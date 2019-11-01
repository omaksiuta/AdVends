<?php

	$theme_color = esc_attr(Integrio_Theme_Helper::get_option("theme-custom-color"));
	$second_color = esc_attr(Integrio_Theme_Helper::get_option("second-custom-color"));
	$theme_gradient = Integrio_Theme_Helper::get_option("theme-gradient");

	$defaults = array(
		// General
		'title' => '',
		'descr' => '',
		'add_read_more' => false,
		'link' => '',
		'min_height' => '',
		'item_el_class' => '',
		// Background
		'front_side_type' => 'none',
		'front_side_color_type' => 'color',
		'bg_color' => $theme_color,
		'bg_gradient_from' => $theme_gradient['from'],
		'bg_gradient_to' => $theme_gradient['to'],
		'thumbnail' => '',
		'back_side_type' => 'none',
		'back_side_color_type' => 'color',
		'back_bg_color' => $theme_color,
		'back_bg_gradient_from' => $theme_gradient['from'],
		'back_bg_gradient_to' => $theme_gradient['to'],
		'back_thumbnail' => '',
		// Styles
		'custom_title_color' => false,
		'title_color' => '#ffffff',
		'custom_content_color' => false,
		'content_color' => '#ffffff',
		'custom_btn_color' => false,
		'btn_color' => '#ffffff',
		'btn_bg_color' => 'transparent',
		'btn_color_hover' => '#232323',
		'btn_bg_color_hover' => '#ffffff',
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$output = $services_wrap_classes = $animation_class = $icon_type_html = $button_attr = $services_title = $services_descr = $services_id_attr = '';

	$services_id = uniqid( "integrio_services_" );
	$services_id_attr = 'id='.$services_id;

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

	// Custom services styles
	ob_start();
	
	if ((bool)$custom_btn_color) {
		echo "#$services_id .services_button{
				color: ".(!empty($btn_color) ? esc_attr($btn_color) : 'transparent').";
				border-color: ".(!empty($btn_color) ? esc_attr($btn_color) : 'transparent').";
				background: ".(!empty($btn_bg_color) ? esc_attr($btn_bg_color) : 'transparent').";
			  }";
		echo "#$services_id .services_button:hover{
				color: ".(!empty($btn_color_hover) ? esc_attr($btn_color_hover) : 'transparent').";
				background: ".(!empty($btn_bg_color_hover) ? esc_attr($btn_bg_color_hover) : 'transparent').";
				border-color: ".(!empty($btn_bg_color_hover) ? esc_attr($btn_bg_color_hover) : 'transparent').";
			  }";
	}

	$styles = ob_get_clean();
	Integrio_shortcode_css()->enqueue_integrio_css($styles);

	// Animation
	if (!empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	}

	// services wrapper classes
	$services_wrap_classes .= $animation_class;
	$services_wrap_classes .= !empty($item_el_class) ? ' '.$item_el_class : '';

	// Read more button
	$link_temp = vc_build_link($link);
	$url = $link_temp['url'];
	$button_title = $link_temp['title'];
	$target = $link_temp['target'];
	$button_attr .= !empty($url) ? 'href="'.esc_url($url).'"' : 'href="#"';
	$button_attr .= !empty($button_title) ? " title='".esc_attr($button_title)."'" : '';
	$button_attr .= !empty($target) ? ' target="'.esc_attr($target).'"' : '';
	$button_attr .= !empty($button_styles) ? $button_styles : '';
	$services_button = (bool)$add_read_more ? '<a class="services_button flaticon-right-arrow" '.$button_attr.'></a>' : '';

	// front bg
	switch ($front_side_type) {
		case 'color':
			switch ($front_side_color_type) {
				case 'color':
					$color_style = 'background-color: '.esc_attr($bg_color);
					break;
				case 'gradient':
					$color_style = 'background-image: linear-gradient(90deg, '.esc_attr($bg_gradient_from).' 0%, '.esc_attr($bg_gradient_to).' 100%);';
					break;
				default:
					$color_style = 'background-color: '.esc_attr($bg_color);
					break;
			}
			$services_front_styles = 'style="'.$color_style.'"';
			break;
		case 'image':
			$featured_image = wp_get_attachment_image_src($thumbnail, 'full');
			$featured_image_url = $featured_image[0];
			$services_front_styles = 'style="background-image: url('.esc_url($featured_image_url).');"';
			break;
		default:
			$services_front_styles = '';
			break;
	}
	$services_front_bg = '<div class="services_front-bg" '.$services_front_styles.'></div>';

	// back bg
	switch ($back_side_type) {
		case 'color':
			switch ($back_side_color_type) {
				case 'color':
					$back_color_style = 'background-color: '.esc_attr($back_bg_color);
					break;
				case 'gradient':
					$back_color_style = 'background-image: linear-gradient(90deg, '.esc_attr($back_bg_gradient_from).' 0%, '.esc_attr($back_bg_gradient_to).' 100%);';
					break;
				default:
					$back_color_style = 'background-color: '.esc_attr($back_bg_color);
					break;
			}
			$services_back_styles = 'style="'.$back_color_style.'"';
			break;
		case 'image':
			$back_featured_image = wp_get_attachment_image_src($back_thumbnail, 'full');
			$back_featured_image_url = $back_featured_image[0];
			$services_back_styles = 'style="background-image: url('.esc_url($back_featured_image_url).');"';
			break;
		default:
			$services_back_styles = '';
			break;
	}
	$services_back_bg = '<div class="services_back-bg" '.$services_back_styles.'></div>';

	// title
	if (!empty($title)) {
		$services_title .= '<h3 class="services_title" '.((bool)$custom_title_color ? 'style="color:'.esc_attr($title_color).'"' : '').'>'.wp_kses($title ,$allowed_html).'</h3>';
	}

	// content
	if (!empty($descr)) {
		$services_descr .= '<div class="services_content" '.((bool)$custom_content_color ? 'style="color:'.esc_attr($content_color).'"' : '').'>'.esc_html($descr).'</div>';
	}

	// render html
	$output .= '<div '.esc_attr($services_id_attr).' class="integrio_module_services_5'.esc_attr($services_wrap_classes).'">';
		$output .= '<div class="services_wrapper" '.(!empty($min_height) ? 'style="min-height: '.esc_attr((int)$min_height).'px;"' : '').'>';
			$output .= $services_title;
			$output .= $services_descr;
			$output .= $services_button;
			$output .= $services_front_bg;
			$output .= $services_back_bg;
		$output .= '</div>';
	$output .= '</div>';
	
	echo Integrio_Theme_Helper::render_html($output);

?>