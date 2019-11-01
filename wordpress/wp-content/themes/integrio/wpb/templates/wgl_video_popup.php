<?php

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);
$theme_gradient_start = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['to']);


$defaults = array(
	// General
    'title' => '',
    'title_pos' => 'bot',
    'button_pos' => 'center',
    'link' => '',
    'bg_image' => '',
	'extra_class' => '',
    // Styles
    'title_color' => $header_font_color,
    'title_size' => '',
    'btn_size' => '',
    'triangle_size' => '',
    'triangle_color' => '#ffffff',
    'bg_color_type' => 'def',
    'border_color' => $theme_color,
    'background_color' => $theme_color,
    'background_gradient_start' => $theme_gradient_start,
    'background_gradient_end' => $theme_gradient_end,
	// Animation
	'animation_style' => 'animation_ring_pulse',
    'always_run_animation' => false,
    'animation_color' => $theme_color,
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

// Enqueue swipebox script
wp_enqueue_script('swipebox', get_template_directory_uri() . '/js/swipebox/js/jquery.swipebox.min.js', array(), false, false);
wp_enqueue_style('swipebox', get_template_directory_uri() . '/js/swipebox/css/swipebox.min.css');

$videobox_id = uniqid( "integrio_video_" );
$videobox_id_attr = ' id='.$videobox_id;

$title_font_family = $animated_element = $triangle_svg = '';
 
ob_start();
	switch ($bg_color_type) {
		case 'color':
			echo "#$videobox_id .videobox_link{
					  background-color: ".(!empty($background_color) ? esc_attr($background_color) : 'transparent').";
					  border-color: ".(!empty($border_color) ? esc_attr($border_color) : 'transparent').";
				  }";
			break;
		case 'gradient':
			$background_gradient_start = !empty($background_gradient_start) ? esc_attr($background_gradient_start) : 'transparent';
			$background_gradient_end = !empty($background_gradient_end) ? esc_attr($background_gradient_end) : 'transparent';
			echo "#$videobox_id .videobox_link{
					  background: radial-gradient(circle farthest-corner at 100% 150%, $background_gradient_end 10%, $background_gradient_start 50%);
				  }";
			break;
	}
$styles = ob_get_clean();
Integrio_shortcode_css()->enqueue_integrio_css($styles);

// Google Fonts
extract( Integrio_GoogleFontsRender::getAttributes( $atts, $this, array('google_fonts_title') ) );
if ( !empty( $styles_google_fonts_title ) ) {
	$title_font_family = ' '.esc_attr( $styles_google_fonts_title ).';';
}

// Animation
if (!empty($atts['css_animation'])) {
	$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
}

// Wrapper classes
$video_wrap_classes = ' button_align-'.$button_pos;
$video_wrap_classes .= ' title_pos-'.$title_pos;
$video_wrap_classes .= ' '.$animation_style;
$video_wrap_classes .= (bool)$always_run_animation ? ' always-run-animation' : '';
$video_wrap_classes .= !empty($bg_image) ? ' with_image' : '';
$video_wrap_classes .= !empty($animation_class) ? ' '.$animation_class : '';
$video_wrap_classes .= !empty($extra_class) ? ' '.$extra_class : '';

// Title style
$title_size_attr = !empty($title_size) ? ' font-size: '.esc_attr((int)$title_size).'px;' : '';
$title_color_attr = !empty($title_color) ? ' color: '.esc_attr($title_color).';' : '';
$title_margin = '';
if (!empty($btn_size) && $animation_style == 'animation_ring_rotate') {
	switch ($title_pos) {
		case 'left' : $title_margin .= ' margin-right:';  break;
		case 'right': $title_margin .= ' margin-left:';   break;
		case 'top'  : $title_margin .= ' margin-bottom:'; break;
		case 'bot'  : $title_margin .= ' margin-top:';    break;
	}
	$title_margin .= esc_attr((int)$btn_size * 0.7).'px;';
}
$title_style = $title_font_family.$title_size_attr.$title_color_attr.$title_margin;
$title_style = !empty($title_style) ? ' style="'.$title_style.'"' : '';

// Title output
$title = !empty($title) ? '<h2 class="title"'.$title_style.' >'.$title.'</h2>' : '';

// Button size (diameter)
$btn_size_style = !empty($btn_size) ? ' width:'.esc_attr((int)$btn_size).'px; height:'.esc_attr((int)$btn_size).'px;' : '';

// Link
$link = ' href="'.(!empty($link) ? esc_url($link) : '#').'"';

// Animation color
$animation_color_style = ' style="border-color: '.(!empty($animation_color) ? esc_attr($animation_color) : 'transparent').'"';

// Animation element output
switch ($animation_style) {
	case 'animation_circles':
		$animated_element .= '<div class="videobox_animation circle_1"'.$animation_color_style.'></div>';
		$animated_element .= '<div class="videobox_animation circle_2"'.$animation_color_style.'></div>';
		$animated_element .= '<div class="videobox_animation circle_3"'.$animation_color_style.'></div>';	
		break;
	case 'animation_ring_pulse':
		$animated_element .= '<div class="videobox_animation ring_1"></div>';
		break;
	case 'animation_ring_rotate':
		$svg_ring_circle_color = !empty($title_color) ?  'rgba('.Integrio_Theme_Helper::HexToRGB($title_color).', 0.1)' : 'rgba(0,0,0,0.1)';
		$svg_ring = '<svg class="ring_1" viewBox="0 0 202 202">';
			$svg_ring .= '<g fill="none" stroke-width="1">';
				$svg_ring .= '<circle stroke="'.$svg_ring_circle_color.'" cx="101" cy="101" r="100"/>';
				$svg_ring .= '<path stroke="'.esc_attr($background_color).'" d="M74,197.3c-33.5-9.4-59.9-35.8-69.3-69.2"/>';
				$svg_ring .= '<path stroke="'.esc_attr($background_color).'" d="M128,4.7c33.5,9.4,59.9,35.8,69.3,69.3"/>';
			$svg_ring .= '</g>';
		$svg_ring .= '</svg>';
		$animated_element .= '<div class="videobox_animation">';
		$animated_element .= $svg_ring;
		$animated_element .= '</div>';
		break;
}

// Triangle styles
$triangle_size_style = !empty($triangle_size) ? ' width="'.esc_attr((int)$triangle_size).'px" height="'.esc_attr((int)$triangle_size).'px" ' : ' width="31%" height="31%"';
$triangle_color_style = ' fill="'.(!empty($triangle_color) ? esc_attr($triangle_color) : 'white').'"';

// Triangle svg output
switch ($triangle_shape = 'sharp') {
	case 'sharp':
		$triangle_svg .= '<svg class="videobox_icon"'.$triangle_size_style.$triangle_color_style.' viewBox="0 0 10 10"><polygon points="1,0 1,10 8.5,5"/></svg>';
		break;
	case 'rounded':
		$triangle_svg .= '<svg class="videobox_icon"'.$triangle_size_style.$triangle_color_style.' viewBox="0 0 232 232"><path d="M203,99L49,2.3c-4.5-2.7-10.2-2.2-14.5-2.2 c-17.1,0-17,13-17,16.6v199c0,2.8-0.07,16.6,17,16.6c4.3,0,10,0.4,14.5-2.2 l154-97c12.7-7.5,10.5-16.5,10.5-16.5S216,107,204,100z"/></svg>';
		break;
}
 
$style = !empty($btn_size_style) ? ' style="'.$btn_size_style.'"' : '';

// Render html
$uniqrel = uniqid();

$output = '<div'.$videobox_id_attr.' class="integrio_module_videobox'.esc_attr($video_wrap_classes).'">';
	$output .= '<div class="videobox_content">';
		$output .= !empty($bg_image) ? '<div class="videobox_background">'.wp_get_attachment_image( $bg_image , 'full' ).'</div>' : '';
		$output .= !empty($bg_image) ? '<div class="videobox_link_wrapper">' : '';
		$output .= $title;
		$output .= '<a data-rel="youtube-'.esc_attr($uniqrel).'" class="videobox_link videobox"'.$link.$style.'>';
			$output .= $triangle_svg;
			$output .= $animated_element;
		$output .= '</a>';
		$output .= !empty($bg_image) ? '</div>' : '';
	$output .= '</div>';
$output .= '</div>';

echo Integrio_Theme_Helper::render_html($output);

?>