<?php

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);

$defaults = array(
	// General
	'item_type' => 'author_top',
	'item_grid' => '1',
	'item_align' => 'left',
	'hover_animation' => false,
	'add_bg_image' => false,
	'bg_image' => '',
	'extra_class' => '',
	// Item
	'values' => '',
	'custom_img_width' => '',
	'custom_img_height' => '',
	'custom_img_radius' => '',
	// Styles
	'quote_tag' => 'div',
	'quote_size' => '',
	'custom_quote_color' => false,
	'quote_color' => '#606568',
	'custom_quote_icon_color' => false,
	'quote_icon_color' => $theme_color,
	'name_tag' => 'h3',
	'name_size' => '',
	'custom_name_color' => false,
	'name_color' => $header_font_color,
	'position_tag' => 'span',
	'position_size' => '',
	'custom_position_color' => false,
	'position_color' => '#9a9a9a',
	'date_size' => '',
	'custom_date_color' => false,
	'date_color' => '#c4cdd7',
	// Carousel
	'use_carousel' => false,
	'autoplay' => false,
	'autoplay_speed' => '3000',
	'fade_animation' => false,
	'use_pagination' => true,
	'pag_type' => 'circle',
	'pag_offset' => '',
	'pag_align' => 'center',
	'custom_pag_color' => false,
	'pag_color' => $header_font_color,
	'use_prev_next' => false,
	'prev_next_position' => '',
	'custom_prev_next_color' => false,
	'prev_next_color' => 'rgba('.Integrio_Theme_Helper::hexToRGB($header_font_color).',0.5)',
	'prev_next_color_hover' => $header_font_color,
	'prev_next_border_color' => '',
	'prev_next_bg_idle' => '',
	'prev_next_bg_hover' => '',
	// Responsive
	'custom_resp' => false,
	'resp_medium' => '1025',
	'resp_medium_slides' => '',
	'resp_tablets' => '800',
	'resp_tablets_slides' => '',
	'resp_mobile' => '480',
	'resp_mobile_slides' => '',
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

if ((bool)$use_carousel) {
	// carousel options array
	$carousel_options_arr = array(
		'slide_to_show' => $item_grid,
		'autoplay' => $autoplay,
		'autoplay_speed' => $autoplay_speed,
		'fade_animation' => $fade_animation,
		'slides_to_scroll' => true,
		'infinite' => true,
		'use_pagination' => $use_pagination,
		'pag_type' => $pag_type,
		'pag_offset' => $pag_offset,
		'pag_align' => $pag_align,
		'custom_pag_color' => $custom_pag_color,
		'pag_color' => $pag_color,
		'use_prev_next' => $use_prev_next,
		'prev_next_position' => $prev_next_position,
		'custom_prev_next_color' => $custom_prev_next_color,
		'prev_next_color' => $prev_next_color,
		'prev_next_color_hover' => $prev_next_color_hover,
		'prev_next_border_color' => $prev_next_border_color,
		'prev_next_bg_idle' => $prev_next_bg_idle,
		'prev_next_bg_hover' => $prev_next_bg_hover,
		'custom_resp' => $custom_resp,
		'resp_medium' => $resp_medium,
		'resp_medium_slides' => $resp_medium_slides,
		'resp_tablets' => $resp_tablets,
		'resp_tablets_slides' => $resp_tablets_slides,
		'resp_mobile' => $resp_mobile,
		'resp_mobile_slides' => $resp_mobile_slides,
	);
	// carousel options
	$carousel_options = array_map(function($k, $v) { return "$k=\"$v\" "; }, array_keys($carousel_options_arr), $carousel_options_arr);
	$carousel_options = implode('', $carousel_options);

	wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);
}

$content = $testimonials_id = $testimonials_attr = '';

if ((bool)$custom_quote_color || (bool)$custom_name_color || (bool)$custom_position_color || (bool)$custom_quote_icon_color || (bool)$custom_prev_next_color) {
	$testimonials_id = uniqid( "integrio_testimonials_" );
	$testimonials_attr = ' id='.$testimonials_id;
}

switch ($item_grid) {
	case '1': $col = 12;	break;  
	case '2': $col = 6;		break;
	case '3': $col = 4;		break;
	case '4': $col = 3;		break;
	case '5': $col = '1/5';	break;
}

// Custom colors
ob_start();
	if ((bool)$custom_name_color) {
		echo "#$testimonials_id .testimonials_name {
				  color: ".(!empty($name_color) ? esc_html($name_color) : 'transparent').";
			  }";
	}
	if ((bool)$custom_quote_color) {
		echo "#$testimonials_id .testimonials_quote {
				  color: ".(!empty($quote_color) ? esc_attr($quote_color) : 'transparent').";
			  }";
	}
	if ((bool)$custom_quote_icon_color) {
		echo "#$testimonials_id .testimonials_quote:after {
				  color: ".(!empty($quote_icon_color) ? esc_attr($quote_icon_color) : 'transparent').";
			  }";
	}
	if ((bool)$custom_position_color) {
		echo "#$testimonials_id .testimonials_position {
				  color: ".(!empty($position_color) ? esc_attr($position_color) : 'transparent').";
			  }";
	}
	if ((bool)$custom_date_color) {
		echo "#$testimonials_id .testimonials_date {
				  color: ".(!empty($date_color) ? esc_attr($date_color) : 'transparent').";
			  }";
	}
$styles = ob_get_clean();
Integrio_shortcode_css()->enqueue_integrio_css($styles);

// Animation
$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation( $atts['css_animation'] ) : '';

// Wrapper classes
$testimonials_wrap_classes = ' type_'.$item_type;
$testimonials_wrap_classes .= ' alignment_'.$item_align;
$testimonials_wrap_classes .= (bool)$add_bg_image ? ' with_bg' : '';
$testimonials_wrap_classes .= (bool)$hover_animation ? ' hover_animation' : '';
$testimonials_wrap_classes .= $animation_class;
$testimonials_wrap_classes .= !empty($extra_class) ? ' '.$extra_class : '';

// Render Google Fonts
extract( Integrio_GoogleFontsRender::getAttributes( $atts, $this, array('google_fonts_name', 'google_fonts_status', 'google_fonts_quote') ) );
$name_font = (!empty($styles_google_fonts_name)) ? esc_attr($styles_google_fonts_name) : '';
$status_font = (!empty($styles_google_fonts_status)) ? esc_attr($styles_google_fonts_status) : '';
$quote_font = (!empty($styles_google_fonts_quote)) ? esc_attr($styles_google_fonts_quote) : '';

// Name styles
$name_font_size = !empty($name_size) ? ' font-size: '.esc_attr((int)$name_size).'px;' : '';
$name_styles = $name_font_size.$name_font;
$name_styles = !empty($name_styles) ? ' style="'.$name_styles.'"' : '';

// Status styles
$status_font_size = !empty($position_size) ? ' font-size: '.esc_attr((int)$position_size).'px;' : '';
$status_styles = $status_font_size.$status_font;
$status_styles = !empty($status_styles) ? ' style="'.$status_styles.'"' : '';

// Quote styles
$quote_font_size = !empty($quote_size) ? ' font-size: '.esc_attr((int)$quote_size).'px;' : '';
$quote_styles = $quote_font_size.$quote_font;
$quote_styles = !empty($quote_styles) ? ' style="'.$quote_styles.'"' : '';

// Image styles
$designed_img_width = 70; // define manually
$image_width_crop = !empty($custom_img_width) ? $custom_img_width*2 : $designed_img_width*2;
$image_width = 'width: '.(!empty($custom_img_width) ? esc_attr((int)$custom_img_width) : $designed_img_width).'px;';
$image_radius = !empty($custom_img_radius) ? ' border-radius: '.esc_attr((int)$custom_img_radius).'px;' : '';
$testimonials_img_style = $image_width.$image_radius;
$testimonials_img_style = !empty($testimonials_img_style) ? ' style="'.$testimonials_img_style.'"' : '';

// Background image
$bg_image_url = !empty($bg_image) ? wp_get_attachment_image_src($bg_image, 'full') : '';
$bg_image_style = (bool)$add_bg_image && !empty($bg_image_url[0]) ? 'background-image: url('.esc_url($bg_image_url[0]).')' : '';
$testimonials_wrap_styles = !empty($bg_image_style) ? 'style="'.$bg_image_style.'"' : '';

$values = (array) vc_param_group_parse_atts( $values );
$item_data = array();
foreach ( $values as $data ) {
	$new_data = $data;
	$new_data['thumbnail'] = isset( $data['thumbnail'] ) ? $data['thumbnail'] : '';
	$new_data['quote'] = isset( $data['quote'] ) ? $data['quote'] : '';
	$new_data['author_name'] = isset( $data['author_name'] ) ? $data['author_name'] : '';
	$new_data['author_position'] = isset( $data['author_position'] ) ? $data['author_position'] : '';

	$item_data[] = $new_data;
}

foreach ( $item_data as $item_d ) {
	// image styles
	$featured_image = wp_get_attachment_image_src($item_d['thumbnail'], 'full');
	$testimonials_image_src = (aq_resize($featured_image[0], $image_width_crop, $image_width_crop, true, true, true));

	// outputs
	$name_output = '<'.esc_attr($name_tag).' class="testimonials_name"'.$name_styles.'>'.esc_html($item_d['author_name']).'</'.esc_attr($name_tag).'>';

	$quote_output = '<'.esc_attr($quote_tag).' class="testimonials_quote"'.$quote_styles.'>'.esc_html($item_d['quote']).'</'.esc_attr($quote_tag).'>';
	
	$status_output = '<'.esc_attr($position_tag).' class="testimonials_position"'.$status_styles.'>'.esc_html($item_d['author_position']).'</'.esc_attr($position_tag).'>';
	
	
	$image_output = '';
	if (!empty( $testimonials_image_src )) { 
		$image_output = '<div class="testimonials_image">';
			$image_output .= '<img src="'.esc_url($testimonials_image_src).'" alt="'.esc_attr($item_d['author_name']).' photo" '.$testimonials_img_style.'>';
		$image_output .= '</div>';
	}


	$content .= '<div class="testimonials_item_wrap'.(!(bool)$use_carousel ? " vc_col-md-".$col : '').'">';
		switch ($item_type) {
			case 'author_top':
				$content .= '<div class="testimonials_item">';
					$content .= '<div class="testimonials_content_wrap">';
						$content .= $image_output;
						$content .= $quote_output;
					$content .= '</div>';
					$content .= '<div class="testimonials_meta_wrap">';
						$content .= '<div class="testimonials_name_wrap">';
							$content .= $name_output;
							$content .= $status_output;
						$content .= '</div>';
					$content .= '</div>';
				$content .= '</div>';
				break;
			case 'author_bottom':
				$content .= '<div class="testimonials_item">';
					$content .= '<div class="testimonials_content_wrap">';
						$content .= $quote_output;
					$content .= '</div>';
					$content .= '<div class="testimonials_meta_wrap">';
						$content .= $image_output;
						$content .= '<div class="testimonials_name_wrap">';
							$content .= $name_output;
							$content .= $status_output;
						$content .= '</div>';
					$content .= '</div>';
				$content .= '</div>';
				break;
			case 'inline_top':
				$content .= '<div class="testimonials_item">';
					$content .= '<div class="testimonials_content_wrap">';
						$content .= '<div class="testimonials_meta_wrap">';
							$content .= $image_output;
							$content .= '<div class="testimonials_name_wrap">';
								$content .= $name_output;
								$content .= $status_output;
							$content .= '</div>';
						$content .= '</div>';
						$content .= $quote_output;
					$content .= '</div>';
				$content .= '</div>';
				break;
			case 'inline_bottom':
				$content .= '<div class="testimonials_item">';
					$content .= '<div class="testimonials_content_wrap">';
						$content .= $quote_output;
					$content .= '</div>';
					$content .= '<div class="testimonials_meta_wrap">';
						$content .= $image_output;
						$content .= '<div class="testimonials_name_wrap">';
							$content .= $name_output;
							$content .= $status_output;
						$content .= '</div>';
					$content .= '</div>';
				$content .= '</div>';
				break;
		}
	$content .= '</div>';
}

$output = '<div '.esc_attr($testimonials_attr).' class="integrio_module_testimonials'.esc_attr($testimonials_wrap_classes).'" '.$testimonials_wrap_styles.'>';
	switch ((bool)$use_carousel) {
		case true: $output .= do_shortcode('[wgl_carousel '.$carousel_options.']'.$content.'[/wgl_carousel]');
			break;
		case false: $output .= $content;
			break;
	}
$output .= '</div>';

echo Integrio_Theme_Helper::render_html($output);

?>