<?php

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color') );
$theme_gradient_start = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['to']);
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);

$defaults = array(
	// General
	'counter_layout' => 'top',
	'counter_align' => 'left ',
	'animation_class' => '',
	'extra_class' => '',
	// Content
	'count_title' => '',
    'add_counter_divider' => false,
	'count_prefix' => '',
	'count_value' => '',
	'count_suffix' => '',
	'counter_offsets' => '',
	'add_shadow' => false,
	'shadow_appearance' => 'always',
	'shadow_type' => 'inset',
	'shadow_offset_x' => '0',
	'shadow_offset_y' => '14',
	'shadow_blur' => '10',
	'shadow_spread' => '0',
	'shadow_color' => 'rgba(0,0,0,0.06)',
	// Icon
	'icon_type' => '',
	'icon_pack' => 'fontawesome',
	'icon_fontawesome' => 'fa fa-adjust',
	'icon_flaticon' => '',
	'custom_icon_size' => '',
	'thumbnail' => '',
	'custom_image_width' => '',
	'custom_image_height' => '',
	// Icon Container
	'custom_icon_bg_width' => '',
	'custom_icon_bg_height' => '',
	'icon_offsets' => '',
	// Colors
	'custom_icon_color' => false,
	'icon_color' => '#000000',
	'icon_color_hover' => '',
	'icon_bg_color_type' => '',
	'icon_bg_color' => '#000000',
	'icon_bg_color_hover' => '',
	'custom_icon_border_color' => false,
	'icon_border_color' => '#ffffff',
	'icon_border_color_hover' => '#ffffff',
	'icon_bg_gradient_start' => $theme_gradient_start,
	'icon_bg_gradient_end' => $theme_gradient_end,
	'icon_bg_gradient_hover_start' => '',
	'icon_bg_gradient_hover_end' => '',
	'custom_value_color' => false,
	'value_color' => $header_font_color,
	'add_value_text_stroke' => false,
	'value_text_stroke_color' => $theme_color,
	'custom_title_color' => false,
	'title_color' => $header_font_color,
	// Typography
	'title_tag' => 'div',
	'title_margin_top' => '',
	'title_weight' => '',
	'title_size' => '',
	'value_height' => '',
	'value_size' => '',
	'value_weight' => '',
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$counter_id_attr = $icon_output = $counter_icon = $counter_value = $counter_value_placeholder = '';

wp_enqueue_script('appear', get_template_directory_uri() . '/js/jquery.appear.js', array(), false, false);

// RegExs for defining custom offsets
preg_match('/\{(.+)\}/', $counter_offsets, $counter_offsets_css);
$counter_offsets_css = !empty($counter_offsets_css) ? $counter_offsets_css[1] : '';

preg_match('/\{(.+)\}/', $icon_offsets, $icon_offsets_css);
$icon_offsets_css = !empty($icon_offsets_css) ? $icon_offsets_css[1] : '';

// Adding unique id for counter module
if ( !empty($counter_offsets_css) || !empty($icon_offsets_css) || (bool)$custom_title_color || (bool)$custom_value_color || (bool)$custom_icon_color || !empty($icon_bg_color_type) || (bool)$custom_icon_border_color || (bool)$add_value_text_stroke) {
	$counter_id = uniqid( "integrio_counter_" );
	$counter_id_attr = ' id='.$counter_id;
}

// Custom styles
ob_start();
	// custom colors
	if ((bool)$custom_title_color) {
		echo "#$counter_id .counter_title {
				  color: ".(!empty($title_color) ? esc_attr($title_color) : 'transparent').";
			  }";
	}
	if ((bool)$custom_value_color) {
		switch ((bool)$add_value_text_stroke) {
			case false:
				echo "#$counter_id .counter_value_wrapper,
					  #$counter_id.layout_top .counter_content_wrapper {
						  color: ".(!empty($value_color) ? esc_attr($value_color) : 'transparent').";
					  }";
						echo "#$counter_id .counter_value_suffix{
									color: ".(!empty($value_color) ? esc_attr($value_color) : 'transparent').";
								}";
				break;
			case true:
				echo "#$counter_id .counter_value{
						  color: ".(!empty($value_text_stroke_color) ? esc_attr($value_text_stroke_color) : 'transparent').";
						  -webkit-text-fill-color: ".(!empty($value_color) ? esc_attr($value_color) : 'transparent').";
						  -webkit-text-stroke: 1px ".(!empty($value_text_stroke_color) ? esc_attr($value_text_stroke_color) : 'transparent').";
					  }";
				break;
		}
	}
	if ((bool)$custom_icon_color) {
		echo "#$counter_id .counter_icon{
				  color: ".(!empty($icon_color) ? esc_attr($icon_color) : 'transparent').";
			  }";
		if (!empty($icon_color_hover)) {
			echo "#$counter_id:hover .counter_icon{
					  color: ".esc_attr($icon_color_hover).";
				  }";
		}
	}
	if ((bool)$custom_icon_border_color) {
		echo "#$counter_id .counter_icon_container{
				  border-color: ".(!empty($icon_border_color) ? esc_attr($icon_border_color) : 'transparent').";
			  }";
		if (!empty($icon_border_color_hover)) {
			echo "#$counter_id:hover .counter_icon_container{
					  border-color: ".esc_attr($icon_border_color_hover).";
				  }";
		}
	}
	if ( !empty($icon_bg_color_type) ) {
		switch ( $icon_bg_color_type ) {
			case 'color':
				echo "#$counter_id .counter_icon_container{
						  background-color: ".(!empty($icon_bg_color) ? esc_attr($icon_bg_color) : 'transparent').";
					  }";
				if (!empty($icon_bg_color_hover)) {
					echo "#$counter_id:hover .counter_icon_container{
							  background-color: ".esc_attr($icon_bg_color_hover).";
						  }";
				}
				break;
			case 'gradient':
				$icon_bg_gradient_start = !empty($icon_bg_gradient_start) ? esc_attr($icon_bg_gradient_start) : 'transparent';
				$icon_bg_gradient_end = !empty($icon_bg_gradient_end) ? esc_attr($icon_bg_gradient_end) : 'transparent';
				$gradient_idle = 'background: -webkit-radial-gradient(100% 110%, circle farthest-corner, '.$icon_bg_gradient_end.' 10%, '.$icon_bg_gradient_start.' 50%);';
				$gradient_idle .= 'background: radial-gradient(circle farthest-corner at 100% 110%, '.$icon_bg_gradient_end.' 10%, '.$icon_bg_gradient_start.' 50%);';
				echo "#$counter_id .counter_icon_container{
						".$gradient_idle."
					  }";
				echo "#$counter_id .counter_icon_container:after{
						content: '';
						background: ".$icon_bg_gradient_start."
					  }";
			break;
		}
	}
	// counter offsets
	if ( !empty($counter_offsets_css) ) {
		echo "#$counter_id .counter_content_wrapper{".$counter_offsets_css."}";
	}
	// icon container offsets
	if ( !empty($icon_offsets_css) ) {
		echo "#$counter_id .counter_icon_container{".$icon_offsets_css."}";
	}
	// counter shadow
	if ( (bool)$add_shadow ) {
		$counter_shadow = 'box-shadow: ';
		$counter_shadow .= !empty($shadow_type) ? 'inset ' : '';
		$counter_shadow .= ($shadow_offset_x !== '') ? esc_attr((int)$shadow_offset_x.'px ') : '0px ';
		$counter_shadow .= ($shadow_offset_y !== '') ? esc_attr((int)$shadow_offset_y.'px ') : '0px ';
		$counter_shadow .= ($shadow_blur !== '') ? esc_attr((int)$shadow_blur.'px ') : '0px ';
		$counter_shadow .= ($shadow_spread !== '') ? esc_attr((int)$shadow_spread.'px ') : '0px ';
		$counter_shadow .= !empty($shadow_color) ? esc_attr($shadow_color).';' : 'rgba(0,0,0,0.1);';
		switch ( $shadow_appearance ) {
			case 'before_hover':
				echo "#$counter_id .counter_content_wrapper{".$counter_shadow."}";
				echo "#$counter_id:hover .counter_content_wrapper{box-shadow: none;}";
				break;
			case 'on_hover':
				echo "#$counter_id .counter_content_wrapper{box-shadow: none;}";
				echo "#$counter_id:hover .counter_content_wrapper{"
						.$counter_shadow.
						"border-color: transparent;
					}";
				break;
			case 'always':
				echo "#$counter_id .counter_content_wrapper{".$counter_shadow."}";
				break;
		}
	}
$styles = ob_get_clean();
Integrio_shortcode_css()->enqueue_integrio_css($styles);

// Animation
if (!empty($atts['css_animation'])) {
	$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
}

// Counter wrapper classes
$counter_wrap_classes = ' layout_'.$counter_layout;
$counter_wrap_classes .= ' alignment_'.$counter_align;
$counter_wrap_classes .= (bool)$add_counter_divider ? ' counter_divider' : '';
$counter_wrap_classes .= $animation_class;
$counter_wrap_classes .= !empty($extra_class) ? ' '.$extra_class : '';

// Render Google Fonts
	extract( Integrio_GoogleFontsRender::getAttributes( $atts, $this, array('google_fonts_title', 'google_fonts_count_value') ) );
	$title_font = !empty($styles_google_fonts_title) ? ' '.esc_attr($styles_google_fonts_title) : '';
	$count_value_font = !empty($styles_google_fonts_count_value) ? ' '.esc_attr($styles_google_fonts_count_value) : '';

// Font sizes
$title_font_size = !empty($title_size) ? 'font-size:'.esc_attr((int)$title_size).'px;' : '';
$count_value_font_size = !empty($value_size) ? 'font-size:'.(int)$value_size.'px; ' : '';

// Font weight
$title_font_weight = !empty($title_weight) ? 'font-weight:'.esc_attr($title_weight).';' : '';
$value_font_weight = !empty($value_weight) ? 'font-weight:'.esc_attr($value_weight).';' : '';

// Margins
$title_margin = ($title_margin_top != '') ? 'margin-top:'.esc_attr((int)$title_margin_top).'px;' : '';

// Title styles output
$title_styles = $title_font_size.$title_font_weight.esc_attr($title_font).$title_margin;
$title_styles = !empty($title_styles) ? ' style="'.$title_styles.'"' : '';

// Value styles output
$count_value_styles = esc_attr($count_value_font_size).esc_attr($count_value_font).esc_attr($value_font_weight);
$count_value_styles .= !empty($value_height) ? 'height: '.esc_attr((int)$value_height).'px;' : '';
$count_value_styles = !empty($count_value_styles) ? ' style="'.$count_value_styles.'"' : '';

// Title output
$counter_title = !empty($count_title) ? '<'.esc_attr($title_tag).' class="counter_title" '.$title_styles.'>'.esc_html($count_title).'</'.esc_attr($title_tag).'>' : '';

if (!empty($count_value)) {
	$counter_value .= '<div class="counter_value_placeholder"'.$count_value_styles.'>';
	$counter_value .= !empty($count_prefix) ? '<span class="value_prefix_placeholder">'.esc_html($count_prefix).'</span>' : '';
	$counter_value .= '<span class="value_placeholder">'.esc_html($count_value).'</span>';
	$counter_value .= !empty($count_suffix) ? '<span class="value_suffix_placeholder">'.esc_html($count_suffix).'</span>' : '';
		$counter_value .= '<div class="counter_value_wrapper"'.$count_value_styles.'>';
		$counter_value .= !empty($count_prefix) ? '<span class="counter_value_prefix">'.esc_html($count_prefix).'</span>' : '';
		$counter_value .= '<span class="counter_value">'.esc_html($count_value).'</span>';
		$counter_value .= !empty($count_suffix) ? '<span class="counter_value_suffix">'.esc_html($count_suffix).'</span>' : '';
		$counter_value .= '</div>';
	$counter_value .= '</div>';
}

// Icon/Image output
if ( !empty($icon_type) ) {
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
		$icon_size = ($custom_icon_size != '') ? ' style="font-size: '.esc_attr((int)$custom_icon_size).'px;"' : '';
		$icon_output .= '<i class="counter_icon '.esc_attr($icon_font).'" '.$icon_size.'></i>';
	}
	if ($icon_type == 'image' && !empty($thumbnail)) {
		$featured_image = wp_get_attachment_image_src($thumbnail, 'full');
		$featured_image_url = $featured_image[0];
		$image_width_crop = ($custom_image_width != '') ? $custom_image_width*2 : '';
		$image_height_crop = ($custom_image_height != '') ? $custom_image_height*2 : '';
		$iconbox_image_src = ($custom_image_width != '' || $custom_image_height != '') ? (aq_resize($featured_image_url, $image_width_crop, $image_height_crop, true, true, true)) : $featured_image_url;
		$image_width = ($custom_image_width != '') ? 'width:'.(int)$custom_image_width.'px; ' : '';
		$image_height = ($custom_image_height != '') ? 'height:'.(int)$custom_image_height.'px;' : '';
		$iconbox_img_width_style = (!empty($image_width) || !empty($image_height))  ? ' style="'.$image_width.$image_height.'"' : '';
		$icon_output .= '<div class="counter_icon"><img src="'.esc_url($iconbox_image_src).'" alt="'.esc_attr($count_title).'" '.$iconbox_img_width_style.' /></div>';
	}
	$icon_bg_width = ($custom_icon_bg_width != '') ? 'width:'.(int)$custom_icon_bg_width.'px; ' : '';
	$icon_bg_height = ($custom_icon_bg_height != '') ? 'height:'.(int)$custom_icon_bg_height.'px; ' : '';
	$icon_bg_style = $icon_bg_width.$icon_bg_height;
	$icon_bg_style = !empty($icon_bg_style) ? ' style="'.$icon_bg_style.'"' : '';

	$counter_icon .= '<div class="counter_icon_container"'.$icon_bg_style.'>'.$icon_output.'</div>';
}

// Switch layout
switch ($counter_layout) {
	case 'top':
		$counter_inner = '<div class="counter_content_wrapper">';
			$counter_inner .= $counter_icon;
			$counter_inner .= $counter_value;
			$counter_inner .= $counter_title;
		$counter_inner .= '</div>';
		break;
	case 'left':
	case 'right':
		$counter_inner = $counter_icon;
		$counter_inner .= '<div class="counter_content_wrapper">';
		$counter_inner .= $counter_value;
		$counter_inner .= $counter_title;
		$counter_inner .= '</div>';
		break;
}

// Render html
$output = '<div'.esc_attr($counter_id_attr).' class="integrio_module_counter'.esc_attr($counter_wrap_classes).'">';
	$output .= $counter_inner;
$output .= '</div>';

echo Integrio_Theme_Helper::render_html($output);

?>