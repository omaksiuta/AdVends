<?php

$theme_color = esc_attr(Integrio_Theme_Helper::get_option("theme-custom-color"));
$theme_color_secondary = esc_attr(Integrio_Theme_Helper::get_option('theme-secondary-color'));
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);
$main_font_color = esc_attr(Integrio_Theme_Helper::get_option('main-font')['color']);
$theme_gradient_start = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['to']);

$defaults = array(
	// General
	'pricing_title' => '',
	'pricing_cur' => '',
	'pricing_price' => '',
	'pricing_desc' => '',
	'add_highlighter' => false,
	'highlighter_title' => 'RECOMENDED',
	'hover_animation' => true,
	'extra_class' => '',
	// Icon
	'icon_type' => '',
	'icon_pack' => 'fontawesome',
	'icon_fontawesome' => 'fa fa-adjust',
	'icon_flaticon' => '',
	'custom_icon_size' => '',
	'thumbnail' => '',
	'custom_image_width' => '',
	'custom_image_height' => '',
	// Content
	'descr_text' => '',
	'button_title' => esc_html__( 'Choose Plan', 'integrio' ),
	'link' => '',
	// Colors
	'custom_icon_color' => false,
	'icon_color' => '#ffffff',
	'custom_title_color' => false,
	'title_color' => $theme_color,
	'custom_price_color' => false,
	'currency_color' => $header_font_color,
	'price_color' => $header_font_color,
	'custom_description_color' => false,
	'description_color' => '#939393',
	'pricing_customize' => '',
	'pricing_bg_color' => '#fcf5f0',
	'pricing_bg_image' => '',
	'header_customize' => '',
	'header_bg_color' => '#f7f9fd',
	'header_bg_image' => '',
	'bg_gradient_idle_start' => $theme_gradient_start,
	'bg_gradient_idle_end' => $theme_gradient_end,
	'content_customize' => '',
	'content_bg_color' => '#f7f9fd',
	'footer_customize' => '',
	'footer_bg_color' => '#f7f9fd',
	'button_customize' => 'color',
	'button_text_color' => $theme_color,
	'button_text_color_hover' => '#ffffff',
	'button_bg_color' => '#ffffff',
	'button_bg_color_hover' => $theme_color,
	'button_bg_gradient_idle_start' => '#ffffff',
	'button_bg_gradient_idle_end' => '#ffffff',
	'button_bg_gradient_hover_start' => $theme_gradient_start,
	'button_bg_gradient_hover_end' => $theme_gradient_end,
	'button_border_color' => $theme_color,
	'button_border_color_hover' => $theme_color,
	'button_border_gradient_idle_start' => $theme_gradient_start,
	'button_border_gradient_idle_end' => $theme_gradient_start,
	'button_border_gradient_hover_start' => $theme_gradient_start,
	'button_border_gradient_hover_end' => $theme_gradient_end,
	// Typography
	'title_size' => '',
	'title_weight' => '',
	'price_size' => '',
	'description_size' => '',
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

if (!empty($button_title)) {
	// button options array
	$button_options_arr = array(
		'button_text' => $button_title,
		'link' => $link,
		'align' => 'center',
		'full_width' => true,
		'size' => 'l',
		'customize' => $button_customize,
		'text_color' => $button_text_color,
		'text_color_hover' => $button_text_color_hover,
		'bg_color' => $button_bg_color,
		'bg_color_hover' => $button_bg_color_hover,
		'bg_gradient_idle_start' => $button_bg_gradient_idle_start,
		'bg_gradient_idle_end' => $button_bg_gradient_idle_end,
		'bg_gradient_hover_start' => $button_bg_gradient_hover_start,
		'bg_gradient_hover_end' => $button_bg_gradient_hover_end,
		'border_color' => $button_border_color,
		'border_color_hover' => $button_border_color_hover,
		'border_gradient_idle_start' => $button_border_gradient_idle_start,
		'border_gradient_idle_end' => $button_border_gradient_idle_end,
		'border_gradient_hover_start' => $button_border_gradient_hover_start,
		'border_gradient_hover_end' => $button_border_gradient_hover_end,
		'shadow_style' => '',
	);
	// button options
	$button_options = array_map(function($k, $v) { return "$k=\"$v\" "; }, array_keys($button_options_arr), $button_options_arr);
	$button_options = implode('', $button_options);
}

$pricing_icon_out = $icon_output = $pricing_plan_id_attr = $highlighter_out = '';

// Adding unique id for module
if ((bool)$custom_icon_color || (bool)$custom_price_color || (bool)$custom_description_color || (bool)$custom_title_color || $pricing_customize != 'def' || !empty($header_customize) || !empty($content_customize) || !empty($footer_customize)) {
	$pricing_plan_id = uniqid( "integrio_pricing_plan_" );
	$pricing_plan_id_attr = ' id='.$pricing_plan_id;
}

// Custom pricing colors
ob_start();
	if ((bool)$custom_icon_color) {
		echo "#$pricing_plan_id .pricing_icon {
				  color: ".(!empty($icon_color) ? esc_attr($icon_color) : 'transparent').";
			  }";
	}
	if ((bool)$custom_title_color) {
		echo "#$pricing_plan_id .pricing_title {
				  color: ".(!empty($title_color) ? esc_attr($title_color) : 'transparent').";
			  }";
	}
	if ((bool)$custom_price_color) {
		echo "#$pricing_plan_id .pricing_price_wrap {
				  color: ".(!empty($price_color) ? esc_attr($price_color) : 'transparent').";
			  }";
		if (!empty($currency_color)) {
			echo "#$pricing_plan_id .pricing_cur {
					  color: ".esc_attr($currency_color).";
				  }";
		}
	}
	if ((bool)$custom_description_color) {
		echo "#$pricing_plan_id .pricing_desc {
				  color: ".(!empty($description_color) ? esc_attr($description_color) : 'transparent').";
			  }";
	}
	if ($header_customize == 'color') {
		echo "#$pricing_plan_id .pricing_header {
				  background-color: ".(!empty($header_bg_color) ? esc_attr($header_bg_color) : 'transparent').";
			  }";
	}
	if ($content_customize == 'color') {
		echo "#$pricing_plan_id .pricing_content {
				  background-color: ".(!empty($content_bg_color) ? esc_attr($content_bg_color) : 'transparent').";
			  }";
	}
	if ($footer_customize == 'color') {
		echo "#$pricing_plan_id .pricing_footer {
				  background-color: ".(!empty($footer_bg_color) ? esc_attr($footer_bg_color) : 'transparent').";
			  }";
	}
	if ($pricing_customize != 'def') {
		if ($pricing_customize == 'color') {
			echo "#$pricing_plan_id .pricing_plan_wrap{
					  background-color: ".(!empty($pricing_bg_color) ? esc_attr($pricing_bg_color) : 'transparent').";
				  }";
		}
		if ($pricing_customize == 'image') {
			echo "#$pricing_plan_id .pricing_header,
				  #$pricing_plan_id .pricing_content,
				  #$pricing_plan_id .pricing_footer {
					  background-color: transparent;
				  }";
		}
	}
	if ($header_customize == 'gradient') {
		$bg_gradient_idle_start = !empty($bg_gradient_idle_start) ? esc_attr($bg_gradient_idle_start) : 'transparent';
		$bg_gradient_idle_end = !empty($bg_gradient_idle_end) ? esc_attr($bg_gradient_idle_end) : 'transparent';
		echo "#$pricing_plan_id .pricing_header{
				background: linear-gradient(90deg, $bg_gradient_idle_start, $bg_gradient_idle_end);
			}";
	}
$styles = ob_get_clean();
integrio_shortcode_css()->enqueue_integrio_css($styles);

// Animation
$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation( $atts['css_animation'] ) : '';

// Wrapper classes
$pricing_wrap_classes = (bool)$hover_animation ? ' hover-animation' : '';
$pricing_wrap_classes .= (bool)$add_highlighter ? ' highlighter' : '';
$pricing_wrap_classes .= $animation_class;
$pricing_wrap_classes .= !empty($extra_class) ? ' '.$extra_class : '';

// Render Google Fonts
extract( Integrio_GoogleFontsRender::getAttributes( $atts, $this, array('google_fonts_title') ) );
$title_font = (!empty($styles_google_fonts_title)) ? esc_attr($styles_google_fonts_title).';' : '';

// Price styles
$price_font_size = !empty($price_size) ? 'font-size:'.esc_attr((int)$price_size).'px; ' : '';
$price_styles = !empty($price_font_size) ? ' style="'.$price_font_size.'"' : '';

// Highlighter
$highlighter_out .= ((bool)$add_highlighter && !empty($highlighter_title)) ? '<div class="pricing_highlighter">'.esc_html($highlighter_title).'</div>' : '';

// Title output
$title_font_size = !empty($title_size) ? 'font-size:'.esc_attr((int)$title_size).'px; ' : '';
$title_styles = $title_font.$title_font_size;
$title_style = !empty($title_styles) ? ' style="'.$title_styles.'"' : '';
$pricing_title_out = !empty($pricing_title) ? '<h4 class="pricing_title"'.$title_style.'>'.esc_html($pricing_title).'</h4>' : '';

// Currency output
$pricing_cur_out = !empty($pricing_cur) ? '<span class="pricing_cur">'.esc_html($pricing_cur).'</span>' : '';

// Price output
if (isset($pricing_price)) {
	preg_match( "/(\d+)(\.| |,)(\d+)$/", $pricing_price, $matches, PREG_OFFSET_CAPTURE );
	switch (isset($matches[0])) {
		case false:
			$pricing_price_out = '<div class="pricing_price">'.esc_html($pricing_price).'</div>';
			break;
		case true:
			$pricing_price_out = '<div class="pricing_price">';
				$pricing_price_out .= esc_html($matches[1][0]);
				$pricing_price_out .= '<span class="price_decimal">'.esc_html($matches[3][0]).'</span>';
			$pricing_price_out .= '</div>';
			break;
	}
}

// Price description output
$description_font_size = !empty($description_size) ? 'font-size:'.esc_attr((int)$description_size).'px; ' : '';
$description_styles = !empty($description_font_size) ? ' style="'.$description_font_size.'"' : '';
$pricing_desc_out = !empty($pricing_desc) ? '<div class="pricing_desc"'.$description_styles.'>'.esc_html($pricing_desc).'</div>' : '';

// Icon/Image output
if (!empty($icon_type)) {
	if ($icon_type == 'font' && (!empty($icon_fontawesome) || !empty($icon_flaticon))) {
		switch ($icon_pack) {
			case 'fontawesome':
				wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
				$icon_font = $icon_fontawesome;
				break;
			case 'flaticon':
				wp_enqueue_style('flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
				$icon_font = $icon_flaticon;
				break;
		}
		$icon_size = ($custom_icon_size != '') ? 'style="font-size:'.esc_attr((int)$custom_icon_size).'px;"' : '';
		$icon_output .= '<i class="pricing_icon '.esc_attr($icon_font).'" '.$icon_size.'></i>';
	}
	if ($icon_type == 'image' && !empty($thumbnail)) {
		$featured_image = wp_get_attachment_image_src($thumbnail, 'full');
		$featured_image_url = $featured_image[0];
		$image_width_crop = ($custom_image_width != '') ? $custom_image_width*2 : '';
		$image_height_crop = ($custom_image_height != '') ? $custom_image_height*2 : '';
		$pricing_image_src = ($custom_image_width != '' || $custom_image_height != '') ? (aq_resize($featured_image_url, $image_width_crop, $image_height_crop, true, true, true)) : $featured_image_url;
		$image_width = ($custom_image_width != '') ? 'width:'.esc_attr((int)$custom_image_width).'px; ' : '';
		$image_height = ($custom_image_height != '') ? 'height:'.esc_attr((int)$custom_image_height).'px;' : '';
		$pricing_img_width_style = (!empty($image_width) || !empty($image_height))  ? 'style="'.$image_width.$image_height.'"' : '';
		$img_alt = get_post_meta($thumbnail, '_wp_attachment_image_alt', true);
		$icon_output .= '<div class="pricing_icon"><img src="'.esc_url($pricing_image_src).'" alt="'.(!empty($img_alt) ? esc_attr($img_alt) : '').'" '.$pricing_img_width_style.' /></div>';
	}
	$pricing_icon_out .= '<div class="pricing_icon_wrapper">';
		$pricing_icon_out .= '<div class="pricing_icon_container ">'.$icon_output.'</div>';
	$pricing_icon_out .= '</div>';
}

// Content
$pricing_content = !empty($content) ? do_shortcode($content) : '';

// Header bg image
$header_image = wp_get_attachment_image_src($header_bg_image, 'full');
$header_image_url = $header_image[0];
$pricing_header_style = !empty($header_bg_image) ? 'style="background-image: url('.$header_image_url.')"' : '';

// Module bg image
$pricing_bg = wp_get_attachment_image_src($pricing_bg_image , 'full');
$pricing_bg_url = $pricing_bg[0];
$pricing_bg_style = !empty($pricing_bg) ? ' style="background: url('.esc_url($pricing_bg_url).') center / cover"' : '';

// Footer description output
$pricing_desc_footer = !empty($descr_text) ? '<div class="pricing_description">'.esc_html($descr_text).'</div>' : '';

// Button output
$pricing_button = !empty($button_title) ? do_shortcode('[wgl_button '.$button_options.'][/wgl_button]') : '';

// Render html
$pricing_inner = '<div class="pricing_header" '.$pricing_header_style.'>';
	$pricing_inner .= $pricing_icon_out;
	$pricing_inner .= $pricing_title_out;
	$pricing_inner .= '<div class="pricing_price_wrap"'.$price_styles.'>';
		$pricing_inner .= $pricing_cur_out;
		$pricing_inner .= $pricing_price_out;
		$pricing_inner .= $pricing_desc_out;
	$pricing_inner .= '</div>';
$pricing_inner .= '</div>';
$pricing_inner .= '<div class="pricing_content">';
	$pricing_inner .= $pricing_content;
$pricing_inner .= '</div>';
$pricing_inner .= '<div class="pricing_footer">';
	$pricing_inner .= $pricing_desc_footer;
	$pricing_inner .= $pricing_button;
	$pricing_inner .= $highlighter_out;
$pricing_inner .= '</div>';


$output = '<div'.$pricing_plan_id_attr.' class="integrio_module_pricing_plan'.esc_attr($pricing_wrap_classes).'">';
	$output .= '<div class="pricing_plan_wrap"'.$pricing_bg_style.'>';
		$output .= $pricing_inner;
	$output .= '</div>';
$output .= '</div>';

echo Integrio_Theme_Helper::render_html($output);

?>
