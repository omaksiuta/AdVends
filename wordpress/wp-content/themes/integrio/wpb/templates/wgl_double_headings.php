<?php

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$theme_secondary_color = esc_attr(Integrio_Theme_Helper::get_option('theme-secondary-color'));
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);

$defaults = array(
	// General
	'title' => '',
	'subtitle' => '',
	'add_squares' => false,
	'squares_color' => '#f6f6f6',
	'align' => 'left',
	'extra_class' => '',
	// Title
	'title_tag' => 'div',
	'title_size' => '42px',
	'title_line_height' => '52px',
	'title_weight' => '',
	'custom_title_color' => false,
	'title_color' => $header_font_color,
	'responsive_font' => false,
	'font_size_desktop' => '',
	'font_size_tablet' => '',
	'font_size_mobile' => '',
	'custom_fonts_title' => false,
	// Subtitle
	'subtitle_tag' => 'div',
	'subtitle_size' => '14px',
	'subtitle_line_height' => '20px',
	'subtitle_weight' => '',
	'custom_subtitle_color' => false,
	'subtitle_color' => '$theme_color',
	'custom_fonts_subtitle' => false,
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$title = $content;
$title_render = $subtitle_render = '';

// Allowed HTML render
$allowed_html = array(
	'a' => array(
		'href' => true,
		'title' => true,
	),
	'br' => array(),
	'em' => array(),
	'strong' => array(),
	'span' => array(
		'class' => true,
		'style' => true,
	),
	'p' => array(
		'class' => true,
		'style' => true,
	)
);

// Unique id
$dbl_id = uniqid( "integrio_dbl_" );
$dbl_attr = ' id='.$dbl_id;

// Animation
$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation( $atts['css_animation'] ) : '';

// Render Google Fonts
extract( Integrio_GoogleFontsRender::getAttributes( $atts, $this, array('google_fonts_title','google_fonts_subtitle') ) );
$title_font_style = !empty($styles_google_fonts_title) ? esc_attr( $styles_google_fonts_title ) : '';
$subtitle_font_style = !empty($styles_google_fonts_subtitle) ? esc_attr( $styles_google_fonts_subtitle ) : '';

ob_start();
if ((bool)$custom_subtitle_color) {
	echo "#$dbl_id .heading_subtitle{
			  color: ".(!empty($subtitle_color) ? esc_attr($subtitle_color) : 'transparent').";
		  }";
}
if ((bool)$add_squares) {
	echo "#$dbl_id.with_squares .heading_subtitle:before,
	#$dbl_id.with_squares .heading_subtitle:after{
			  background-color: ".(!empty($squares_color) ? esc_attr($squares_color) : 'transparent').";
		  }";
}
$styles = ob_get_clean();
Integrio_shortcode_css()->enqueue_integrio_css($styles);

// Wrapper classes
$wrap_classes = ' a'.$align;
$wrap_classes .= ' '.$extra_class;
$wrap_classes .= (bool)$add_squares ? ' with_squares' : '';
$wrap_classes .= !empty($animation_class) ? ' '.$animation_class : '';

// Title styles
$title_size_style = !empty($title_size) ? 'font-size:' .esc_attr((int)$title_size).'px; ' : '';
$title_line_height_responsive = !empty($title_line_height) ? round(((int)$title_line_height / (int)$title_size), 3) : '';
$title_line_height_style = !empty($title_line_height_responsive) ? 'line-height:' .esc_attr($title_line_height_responsive).'; ' : '';
$title_weight_style = !empty($title_weight) ? 'font-weight:' . (int)$title_weight.'; ' : '';
$title_color_style = !empty($title_color && (bool)$custom_title_color) ? 'color:' . esc_attr($title_color) . '; ' : '';
$title_styles = $title_size_style.$title_line_height_style.$title_weight_style.$title_color_style.$title_font_style;
$title_styles = !empty($title_styles) ? ' style="'.$title_styles.'"' : '';

// Subtitle styles
$subtitle_size_style = !empty($subtitle_size) ? 'font-size:' .esc_attr((int)$subtitle_size).'px; ' : '';
$subtitle_line_height_style = !empty($subtitle_line_height) ? 'line-height:' .esc_attr((int)$subtitle_line_height).'px; ' : '';
$subtitle_weight_style = !empty($subtitle_weight) ? 'font-weight:' . (int)$subtitle_weight . '; ' : '';
$subtitle_styles = $subtitle_size_style.$subtitle_line_height_style.$subtitle_weight_style.$subtitle_font_style;
$subtitle_styles = 'style="'.$subtitle_styles.'"';

// Title output
if (!empty($title)) {
	$title_render .= '<div class="heading_title" '.$title_styles.'>';
	if ((bool)$responsive_font) {
		$title_render .= !empty($font_size_desktop) ? '<div class="heading_title_desktop" style="font-size:'.esc_attr((int)$font_size_desktop).'px;">' : '';
		$title_render .= !empty($font_size_tablet) ? '<div class="heading_title_tablet" style="font-size:'.esc_attr((int)$font_size_tablet).'px;">' : '';
		$title_render .= !empty($font_size_mobile) ? '<div class="heading_title_mobile" style="font-size:'.esc_attr((int)$font_size_mobile).'px;">' : '';
	}
	$title_render .= '<'.esc_attr($title_tag).'>'.wp_kses($title, $allowed_html).'</'.esc_attr($title_tag).'>';
	if ((bool)$responsive_font) {
		$title_render .= !empty($font_size_desktop) ? '</div>' : '';
		$title_render .= !empty($font_size_tablet) ? '</div>' : '';
		$title_render .= !empty($font_size_mobile) ? '</div>' : '';
	}
	$title_render .= '</div>';
}

// Subtitle output
if (!empty($subtitle)) {
	$subtitle_render .= '<div class="heading_subtitle" '.$subtitle_styles.'>';
		$subtitle_render .= '<'.esc_attr($subtitle_tag).'>'.esc_html($subtitle).'</'.esc_attr($subtitle_tag).'>';
	$subtitle_render .= '</div>';
}

// Render
$output = '<div'.esc_attr($dbl_attr).' class="integrio_module_double_headings'.esc_attr($wrap_classes).'">';
	$output .= $subtitle_render;
	$output .= $title_render;
$output .= '</div>';

echo Integrio_Theme_Helper::render_html($output);

?>  
