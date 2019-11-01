<?php

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);

$defaults = array(
	// General
    'slide_to_show' => '1',
    'speed' => '300',
    'autoplay' => true,
    'autoplay_speed' => '3000',
    'slides_to_scroll' => false,
	'infinite' => false,
	'adaptive_height' => false,
	'fade_animation' => false,
	'variable_width' => false,
	'extra_class' => '',
	// Navigation
	'use_pagination' => true,
	'use_navigation' => false,
	'pag_type' => 'circle',
	'nav_type' => 'element',
	'pag_offset' => '',
	'pag_align' => 'center',
	'custom_prev_next_offset' => false,
	'prev_next_offset' => '50%',
	'custom_pag_color' => false,
	'pag_color' => $theme_color,
	'center_mode' => false,
	'use_prev_next' => false,
	'prev_next_position' => '',
	'custom_prev_next_color' => false,
	'prev_next_color' => $theme_color,
	'prev_next_color_hover' => $theme_color,
	'prev_next_border_color' => $theme_color,
	'prev_next_bg_idle' => '#ffffff',
	'prev_next_bg_hover' => '#ffffff',
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

$carousel_id_attr = $animation_class = '';
if ((bool)$custom_pag_color || (bool)$custom_prev_next_color || !empty($pag_offset) || !empty($prev_next_offset)) {
	$carousel_id = uniqid( "integrio_carousel_" );
	$carousel_id_attr = ' id='.$carousel_id;
}

// Custom colors
ob_start();
	if ( (bool)$custom_pag_color ) {
		echo "#$carousel_id.pagination_circle .slick-dots li button,
			  #$carousel_id.pagination_square .slick-dots li button,
			  #$carousel_id.pagination_line .slick-dots li button:before {
				  background: ".(!empty($pag_color) ? esc_attr($pag_color) : 'transparent').";
			  }";
	}
	if ( (bool)$custom_prev_next_color ) {
		$bg_color_idle = !empty($prev_next_bg_idle) ? esc_attr($prev_next_bg_idle) : 'transparent';
		$bg_color_hover = !empty($prev_next_bg_hover) ? esc_attr($prev_next_bg_hover) : 'transparent';
		$bg_color_idle_shadow = '0px 9px 30px 0px rgba('.(!empty($prev_next_bg_idle) ? Integrio_Theme_Helper::hexToRGB($prev_next_bg_idle).',0.4' : '0,0,0,0').')';
		$bg_color_hover_shadow = '0px 9px 30px 0px rgba('.(!empty($prev_next_bg_hover) ? Integrio_Theme_Helper::hexToRGB($prev_next_bg_hover).',0.4' : '0,0,0,0').')';
		echo "#$carousel_id .slick-arrow {
				  border-color: ".(!empty($prev_next_border_color) ? esc_attr($prev_next_border_color) : 'transparent').";
				  background-color: $bg_color_idle;
			  	  box-shadow: $bg_color_idle_shadow;
			  }
			  #$carousel_id .slick-arrow:after {
				  color: ".(!empty($prev_next_color) ? esc_attr($prev_next_color) : 'transparent').";
			  }";
		echo "#$carousel_id .slick-arrow:hover {
				  background-color: $bg_color_hover;
			  	  box-shadow: $bg_color_hover_shadow;
			  }
			  #$carousel_id .slick-arrow:hover:after {
				  color: ".(!empty($prev_next_color_hover) ? esc_attr($prev_next_color_hover) : 'transparent').";
			  }
			  #$carousel_id .slick-arrow:hover:before {
				  opacity: 0;
			  }";
	}
	if ( !empty($pag_offset) ) {
		echo "#$carousel_id.integrio_module_carousel .slick-dots{
				  margin-top: ".esc_attr((int)$pag_offset)."px;
			  }";
	}
	if ( (bool)$custom_prev_next_offset ) {
		if ( !empty($prev_next_offset) ) {
			echo "#$carousel_id.integrio_module_carousel .slick-next,
				  #$carousel_id.integrio_module_carousel .slick-prev{
					  top: ".esc_attr((int)$prev_next_offset)."%;
				  }";
		}
	}
$styles = ob_get_clean();
Integrio_shortcode_css()->enqueue_integrio_css($styles);

// Animation
if (!empty($atts['css_animation'])) {
	$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
}

switch ($slide_to_show) {
	case '2':
		$responsive_medium = 2;
		$responsive_tablets = 2;
		$responsive_mobile = 1;
		break;
	case '3':
		$responsive_medium = 3;
		$responsive_tablets = 2;
		$responsive_mobile = 1;
		break;
	case '4':
	case '5':
	case '6':
		$responsive_medium = 4;
		$responsive_tablets = 2;
		$responsive_mobile = 1;
		break;
	default:
		$responsive_medium = 1;
		$responsive_tablets = 1;
		$responsive_mobile = 1;
		break;
}

// If custom responsive
if ($custom_resp) {
	$responsive_medium = !empty($resp_medium_slides) ? (int)$resp_medium_slides : $responsive_medium;
	$responsive_tablets = !empty($resp_tablets_slides) ? (int)$resp_tablets_slides : $responsive_tablets;
	$responsive_mobile = !empty($resp_mobile_slides) ? (int)$resp_mobile_slides : $responsive_mobile;
}

if ( $slides_to_scroll ) {
	$responsive_sltscrl_medium = $responsive_sltscrl_tablets = $responsive_sltscrl_mobile = 1;
} else {
	$responsive_sltscrl_medium = $responsive_medium;
	$responsive_sltscrl_tablets = $responsive_tablets;
	$responsive_sltscrl_mobile = $responsive_mobile;
}

$data_array = array(); 
$data_array['slidesToShow'] = (int)$slide_to_show;
$data_array['slidesToScroll'] = $slides_to_scroll ? 1 : (int)$slide_to_show;
$data_array['infinite'] = $infinite ? true : false;
$data_array['variableWidth'] = $variable_width ? true : false;

$data_array['autoplay'] = $autoplay ? true : false;
$data_array['autoplaySpeed'] = $autoplay_speed ? $autoplay_speed : '';
$data_array['speed'] = $speed ? (int)$speed : '300';
if((bool) $center_mode){
	$data_array['centerMode'] = $center_mode ? true : false;
	$data_array['centerPadding'] = '0px';	
}


$data_array['arrows'] = $use_prev_next ? true : false;
$data_array['dots'] = $use_pagination ? true : false;
$data_array['adaptiveHeight'] = $adaptive_height ? true : false;

// Responsive settings
$data_array['responsive'][0]['breakpoint'] = (int)$resp_medium;
$data_array['responsive'][0]['settings']['slidesToShow'] = (int)esc_attr($responsive_medium);
$data_array['responsive'][0]['settings']['slidesToScroll'] = (int)esc_attr($responsive_sltscrl_medium);

$data_array['responsive'][1]['breakpoint'] = (int)$resp_tablets;
$data_array['responsive'][1]['settings']['slidesToShow'] = (int)esc_attr($responsive_tablets);
$data_array['responsive'][1]['settings']['slidesToScroll'] = (int)esc_attr($responsive_sltscrl_tablets);

$data_array['responsive'][2]['breakpoint'] = (int)$resp_mobile;
$data_array['responsive'][2]['settings']['slidesToShow'] = (int)esc_attr($responsive_mobile);
$data_array['responsive'][2]['settings']['slidesToScroll'] = (int)esc_attr($responsive_sltscrl_mobile);

$prev_next_position_class = ((bool)$use_prev_next && !empty($prev_next_position)) ? ' prev_next_pos_'.$prev_next_position : '';
$data_attribute = " data-slick='".json_encode($data_array, true)."'";

// Classes
$carousel_wrap_classes = $use_pagination ? ' pagination_'.$pag_type : '';
$carousel_wrap_classes .= $use_navigation ? ' navigation_'.$nav_type : '';
$carousel_wrap_classes .= ' pag_align_'.$pag_align;
$carousel_wrap_classes .= $prev_next_position_class;
$carousel_wrap_classes .= $animation_class;
$carousel_wrap_classes .= !empty($extra_class) ? ' '.$extra_class : '';

$carousel_classes = (bool)$fade_animation ? ' fade_slick' : '';

// Render
$output = '<div class="integrio_module_carousel-wrapper">';
	$output .= '<div'.esc_attr($carousel_id_attr).' class="integrio_module_carousel'.esc_attr($carousel_wrap_classes).'">';
		$output .= '<div class="integrio_carousel_slick'.$carousel_classes.'"'.$data_attribute.'>';	
			$output .= do_shortcode($content);
		$output .= '</div>';
	$output .= '</div>';
$output .= '</div>';

echo Integrio_Theme_Helper::render_html($output);

?>