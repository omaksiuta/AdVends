<?php

$theme_color = esc_attr(Integrio_Theme_Helper::get_option("theme-custom-color"));
$theme_color_secondary = esc_attr(Integrio_Theme_Helper::get_option('theme-secondary-color'));

$defaults = array(
	// General
	'values' => '',
	'custom_crossline' => false,
	'crossline_color' => '#dbe4f4',
	'appear_anim' => true,
	'extra_class' => '',
	// Carousel
	'slide_to_show' => '4',
	'slides_to_scroll' => false,
	'autoplay' => false,
	'autoplay_speed' => '3000',
	'use_pagination' => true,
	'pag_type' => 'circle',
	'pag_offset' => '', 
	'pag_align' => 'center',
	'custom_pag_color' => false,
	'pag_color' => $theme_color,
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

// Carousel options array
$carousel_options_arr = array(
    'slide_to_show' => $slide_to_show,
    'autoplay' => $autoplay,
    'autoplay_speed' => $autoplay_speed,
    'use_pagination' => $use_pagination,
    'pag_type' => $pag_type,
    'pag_offset' => $pag_offset,
    'pag_align' => $pag_align,
    'custom_pag_color' => $custom_pag_color,
    'pag_color' => $pag_color,
    'custom_resp' => $custom_resp,
    'resp_medium' => $resp_medium,
    'resp_medium_slides' => $resp_medium_slides,
    'resp_tablets' => $resp_tablets,
    'resp_tablets_slides' => $resp_tablets_slides,
    'resp_mobile' => $resp_mobile,
    'resp_mobile_slides' => $resp_mobile_slides,
    'slides_to_scroll' => $slides_to_scroll,
);

// Carousel options
$carousel_options = array_map(function($k, $v) { return "$k=\"$v\" "; }, array_keys($carousel_options_arr), $carousel_options_arr);
$carousel_options = implode('', $carousel_options);

// Enqueue scripts
wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);
if ((bool)$appear_anim) wp_enqueue_script('appear', get_template_directory_uri() . '/js/jquery.appear.js', array(), false, false);

$tlh_module_attr = $content = '';
$i = 0; // extra identificator uniqueness

// Module unique id
if ((bool)$custom_crossline || !(bool)$use_pagination || !empty($pag_offset)) {
	$tlh_module_id = uniqid( "time_line_" );
	$tlh_module_attr = 'id='.$tlh_module_id;
}

// Module custom styles
ob_start();
	if ((bool)$custom_crossline) {
		$gradient_values = 'transparent 0%, '.$crossline_color.' 100px, '.$crossline_color.' calc(100% - 100px), transparent 100%';
		echo "#$tlh_module_id:before {
				  background: webkit-linear-gradient(right, $gradient_values);
				  background: linear-gradient(90deg, $gradient_values);
			  }";
	}
$styles = ob_get_clean();
Integrio_shortcode_css()->enqueue_integrio_css($styles);

// Animation
$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation( $atts['css_animation'] ) : '';

// Wrapper classes
$tl_wrap_classes = (bool)$appear_anim ? ' appear_anim' : '';
$tl_wrap_classes .= !empty($animation_class) ? ' '.$animation_class : '';
$tl_wrap_classes .= !empty($extra_class) ? ' '.$extra_class : '';

$values = (array) vc_param_group_parse_atts( $values );
$item_data = array();
foreach ( $values as $data ) {
    $new_data = $data;
    $new_data['thumbnail'] = isset( $data['thumbnail'] ) ? $data['thumbnail'] : '';
    $new_data['date'] = isset( $data['date'] ) ? $data['date'] : '';
    $new_data['title'] = isset( $data['title'] ) ? $data['title'] : '';
    $new_data['descr'] = isset( $data['descr'] ) ? $data['descr'] : '';
    $new_data['custom_item_colors'] = isset( $data['custom_item_colors'] ) ? $data['custom_item_colors'] : false;
    $new_data['circle_background'] = isset( $data['circle_background'] ) ? $data['circle_background'] : '#ffffff';
    $new_data['icon_color'] = isset( $data['icon_color'] ) ? $data['icon_color'] : '#dae3f4';

    $item_data[] = $new_data;
}

foreach ( $item_data as $item_d ) {
	// Item unique id
	$tl_item_attr = '';
	if ((bool)$item_d['custom_item_colors']) {
		$tl_item_id = uniqid( "time_line_" ).++$i;
		$tl_item_attr = 'id='.$tl_item_id;
	}

	// Variables validation
	$circle_shadow = ($item_d['circle_background'] != '#ffffff') ? $item_d['circle_background'] : 'rgba(0,0,0,0.25)';

	// Item custom styles
	ob_start();
		if ((bool)$item_d['custom_item_colors']) {
			echo "#$tl_item_id .tlh_check_wrap {
					  background: ".$item_d['circle_background'].";
					  color: $circle_shadow;
				  }";
			echo "#$tl_item_id .tlh_check {
					  color: ".$item_d['icon_color'].";
				  }";
    	}
    $styles = ob_get_clean();
    Integrio_shortcode_css()->enqueue_integrio_css($styles);

	$thumbnail = wp_get_attachment_image_src($item_d['thumbnail'], 'full');
	$thumbnail_out = !empty($thumbnail) ? '<div class="tlh_thumbnail"><img src="'.esc_url($thumbnail[0]).'" alt="thumbnail image"></div>' : '';


	$content .= '<div '.$tl_item_attr.' class="tlh_item">';
		$content .= '<div class="tlh_content">';
			$content .= $thumbnail_out;
			$content .= '<h5 class="tlh_title">'.esc_html($item_d['title']).'</h5>';
			$content .= '<div class="tlh_descr">'.esc_html($item_d['descr']).'</div>';
		$content .= '</div>';
		$content .= '<div class="tlh_check_wrap">';
			$content .= '<span class="tlh_date">'.esc_html($item_d['date']).'</span>';
			$content .= '<i class="tlh_check flaticon-check"></i>';
		$content .= '</div>';
		$content .= '<div class="tlh_hidden_placeholder">';
			$content .= '<div class="tlh_content">';
				$content .= '<h5 class="tlh_title">'.esc_html($item_d['title']).'</h5>';
				$content .= '<div class="tlh_descr">'.esc_html($item_d['descr']).'</div>';
			$content .= '</div>';
		$content .= '</div>';
	$content .= '</div>';

}

// Render
$output = '<div '.$tlh_module_attr.' class="integrio_module_time_line_horizontal'.esc_attr($tl_wrap_classes).'">';
    $output .= do_shortcode('[wgl_carousel '.$carousel_options.']'.$content.'[/wgl_carousel]');
$output .= '</div>';

echo Integrio_Theme_Helper::render_html($output);

?>