<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $css_animation = '';
$disable_element = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

$css_classes = array(
	'vc_row',
	'wpb_row',
	//deprecated
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( vc_shortcode_custom_css_has_property( $css, array(
		'border',
		'background',
	) ) || $video_bg || $parallax
) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = 'vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

if (isset($add_extended) && (bool)$add_extended) {
	$css_classes[] = 'wgl-row-animation';
}

if (isset($extended_animation) && 'sphere' == $extended_animation) {

	$figure_color = isset($figure_color) ? $figure_color : '#ffffff';
	$width = isset($sphere_width) ? $sphere_width : '750';
	$extended_animation_pos_vertical = isset($extended_animation_pos_vertical) ? $extended_animation_pos_vertical : '50';
	$extended_animation_pos_horizont = isset($extended_animation_pos_horizont) ? $extended_animation_pos_horizont : '70';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
	$css_classes[] = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( false !== strpos( $parallax, 'fade' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}



if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';


// row inline styles
$zindex = ($z_index !== '' && $z_index !== '1') ? 'z-index: '.esc_attr($z_index).'; ' : '';
$row_styles = !empty($zindex) ? 'style="'.$zindex.'"' : '';

//Render row
$output .= '<div '.$row_styles.' ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= wpb_js_remove_wpautop( $content );

if (isset($add_extended) && (bool)$add_extended) {
	$values = (array) vc_param_group_parse_atts( $values );
	$item_data = array();

	foreach ( $values as $data ) {
	    $new_data = $data;
	    $new_data['extended_animation'] = isset( $data['extended_animation'] ) ? $data['extended_animation'] : 'sphere';
	    $new_data['figure_color'] = isset( $data['figure_color'] ) ? $data['figure_color'] : '#ffffff';
	    $new_data['drop_colors'] = isset( $data['drop_colors'] ) ? $data['drop_colors'] : 'one_color';
	    $new_data['part_color'] = isset( $data['part_color'] ) ? $data['part_color'] : '#ff7e00';
	    $new_data['part_color_1'] = isset( $data['part_color_1'] ) ? $data['part_color_1'] : '#ff7e00';
	    $new_data['part_color_2'] = isset( $data['part_color_2'] ) ? $data['part_color_2'] : '#3224e9';
	    $new_data['part_color_3'] = isset( $data['part_color_3'] ) ? $data['part_color_3'] : '#69e9f2';
	    $new_data['extended_animation_pos_horizont'] = isset( $data['extended_animation_pos_horizont'] ) ? $data['extended_animation_pos_horizont'] : '50';
	    $new_data['extended_animation_pos_vertical'] = isset( $data['extended_animation_pos_vertical'] ) ? $data['extended_animation_pos_vertical'] : '50';
	    $new_data['sphere_width'] = isset( $data['sphere_width'] ) ? $data['sphere_width'] : '100';
	    $new_data['add_second_sphere'] = isset( $data['add_second_sphere'] ) ? $data['add_second_sphere'] : false;
	    $new_data['particles_number'] = isset( $data['particles_number'] ) ? $data['particles_number'] : '50';
	    $new_data['particles_size'] = isset( $data['particles_size'] ) ? $data['particles_size'] : '10';
	    $new_data['particles_speed'] = isset( $data['particles_speed'] ) ? $data['particles_speed'] : '2';
	    $new_data['add_line'] = isset( $data['add_line'] ) ? $data['add_line'] : false;
	    $new_data['hover_anim'] = isset( $data['hover_anim'] ) ? $data['hover_anim'] : 'grab';
	    $new_data['image_bg'] = isset( $data['image_bg'] ) ? $data['image_bg'] : '';
	    $new_data['parallax_dir'] = isset( $data['parallax_dir'] ) ? $data['parallax_dir'] : 'horizontal';
	    $new_data['parallax_factor'] = isset( $data['parallax_factor'] ) ? $data['parallax_factor'] : '0.3';
	    $new_data['particles_position_top'] = isset( $data['particles_position_top'] ) ? $data['particles_position_top'] : '0';
	    $new_data['particles_position_left'] = isset( $data['particles_position_left'] ) ? $data['particles_position_left'] : '0';
	    $new_data['particles_width'] = isset( $data['particles_width'] ) ? $data['particles_width'] : '100';
	    $new_data['particles_height'] = isset( $data['particles_height'] ) ? $data['particles_height'] : '100';
	    $new_data['hide_on_mobile'] = isset( $data['hide_on_mobile'] ) ? $data['hide_on_mobile'] : false;
	    $new_data['resp_hide'] = isset( $data['resp_hide'] ) ? $data['resp_hide'] : '768';
	    $new_data['morph_style'] = isset( $data['morph_style'] ) ? $data['morph_style'] : 'style_1';
	    $new_data['morph_speed'] = isset( $data['morph_speed'] ) ? $data['morph_speed'] : '10';
	    $new_data['morph_color'] = isset( $data['morph_color'] ) ? $data['morph_color'] : '#f8f7f6';
	    $new_data['morph_rotation'] = isset( $data['morph_rotation'] ) ? $data['morph_rotation'] : '0';

	    $item_data[] = $new_data;
	}

	foreach ( $item_data as $item_d ) {

		$extended_id = uniqid( 'extended_' );

		if ($item_d['extended_animation'] == 'particles' || $item_d['extended_animation'] == 'hexagons') {
			wp_enqueue_script('particles', get_template_directory_uri() . '/js/particles.min.js', array('jquery'), false, true);
		}

	    // Add animation sphere
		if ('sphere' == $item_d['extended_animation']) {
			$output .= '<div class="wgl-row_background" style="top: '.esc_attr($item_d['extended_animation_pos_vertical']).'%;left: '.esc_attr($item_d['extended_animation_pos_horizont']).'%">'.do_shortcode('[wgl_earth figure_color="'.($item_d['figure_color']).'" width="'.($item_d['sphere_width']).'" add_second_sphere="'.($item_d['add_second_sphere']).'"]').'</div>';
		}
		
		// Add Animation particles
		if ('particles' == $item_d['extended_animation'] || 'hexagons' == $item_d['extended_animation']) {

			// data attributes
			$color_1 = !empty($item_d['part_color_1']) ? esc_attr($item_d['part_color_1']) : '#ff7e00';
			$color_2 = !empty($item_d['part_color_2']) ? esc_attr($item_d['part_color_2']) : '#3224e9';
			$color_3 = !empty($item_d['part_color_3']) ? esc_attr($item_d['part_color_3']) : '#69e9f2';
			$data_colors_type = 'data-particles-colors-type="'.esc_attr($item_d['drop_colors']).'" ';
			$data_type = 'data-particles-type="'.esc_attr($item_d['extended_animation']).'" ';
			$data_number = 'data-particles-number="'.esc_attr((int)$item_d['particles_number']).'" ';
			$data_size = 'data-particles-size="'.esc_attr((int)$item_d['particles_size']).'" ';
			$data_speed = 'data-particles-speed="'.esc_attr((int)$item_d['particles_speed']).'" ';
			$data_line = (bool)$item_d['add_line'] ? 'data-particles-line="true" ' : 'data-particles-line="false" ';
			$data_hover = $item_d['hover_anim'] == 'none' ? 'data-particles-hover="false" ' : 'data-particles-hover="true" ';
			$data_hover_mode = $item_d['hover_anim'] !== 'none' ? 'data-particles-hover-mode="'.esc_attr($item_d['hover_anim']).'" ' : 'data-particles-hover-mode="grab" ';
			switch ($item_d['drop_colors']) {
				case 'one_color':
					$data_color = 'data-particles-color="'.esc_attr($item_d['part_color']).'" ';
					break;
				case 'random_colors':
					$data_color = 'data-particles-color="'.$color_1.','.$color_2.','.$color_3.'" ';
					break;
				default:
					$data_color = 'data-particles-color="'.esc_attr($item_d['part_color']).'" ';
					break;
			} 
			
			$particles_data = $data_type.$data_number.$data_color.$data_line.$data_size.$data_speed.$data_hover.$data_hover_mode.$data_colors_type;

			// position
			$particles_position_top = 'top:'.((int)$item_d['particles_position_top']).'%; ';
			$particles_position_left = 'left:'.((int)$item_d['particles_position_left']).'%; ';
			$particles_width = 'width:'.((int)$item_d['particles_width']).'%; ';
			$particles_height = 'height:'.((int)$item_d['particles_height']).'%; ';
			$particles_style = $particles_position_top . $particles_position_left . $particles_width . $particles_height;

			$output .= '<div id="'.esc_attr($extended_id).'" class="particles-js" style="'.$particles_style.'" '.$particles_data.'></div>';
		}

		// Add Animation parallax
		if ('parallax' == $item_d['extended_animation'] && !empty($item_d['image_bg'])) {
			wp_enqueue_script('parallax', get_template_directory_uri() . '/js/jquery.paroller.min.js', array(), false, false);

			// position
			$parallax_position_top = 'top:'.((int)$item_d['particles_position_top']).'%; ';
			$parallax_position_left = 'left:'.((int)$item_d['particles_position_left']).'%; ';
			$parallax_style = $parallax_position_top . $parallax_position_left;

			// data attributes
			$data_direction = 'data-paroller-direction="'.esc_attr($item_d['parallax_dir']).'" ';
			$data_factor = 'data-paroller-factor="'.esc_attr($item_d['parallax_factor']).'" ';
			
			$parallax_data = $data_direction.$data_factor;

			// image
			$image_src = wp_get_attachment_image_src($item_d['image_bg'], 'full');
			$img_alt = get_post_meta($item_d['image_bg'], '_wp_attachment_image_alt', true);

			$output .= '<div id="'.esc_attr($extended_id).'" class="extended-parallax" data-paroller-type="foreground" style="'.$parallax_style.'" '.$parallax_data.'><img src="'.esc_url($image_src[0]).'" alt="'.(!empty($img_alt) ? esc_attr($img_alt) : '').'" /></div>';

		}

		if ('morph' == $item_d['extended_animation']) {
			$morph_svg = $morph_value = '';
			// position
			$morph_position_top = 'top:'.((int)$item_d['particles_position_top']).'%; ';
			$morph_position_left = 'left:'.((int)$item_d['particles_position_left']).'%; ';
			$morph_width = 'width:'.((int)$item_d['particles_width']).'%; ';
			$morph_height = 'height:'.((int)$item_d['particles_height']).'%; ';
			$morph_rotation = 'transform: rotate('.((int)$item_d['morph_rotation']).'deg); ';
			$morph_style = $morph_position_top . $morph_position_left . $morph_width . $morph_height .$morph_rotation;

			// morph styles
			$morph_bg_color = !empty($item_d['morph_color']) ? esc_attr($item_d['morph_color']) : '';
			$morph_bg_color_style = !empty($morph_bg_color) ? 'fill:'.$morph_bg_color.'; ' : '';
			$morph_style_svg = !empty($morph_bg_color_style) ? 'style="'.$morph_bg_color_style.'"' : '';
			
			// morph animation speed
			$morph_speed = !empty($item_d['morph_speed']) ? esc_attr($item_d['morph_speed']) : '10';
			$morph_speed_attr = 'dur="'.esc_attr((int)$morph_speed).'s"';

			switch ($item_d['morph_style']) {
				case 'style_1':
					$morph_value = '
					M161.5,95.7c-0.6-1.5-1.2-2.9-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1
					c-3.2-12.6-12.8-20.4-15.4-22.4C126.5,5,105.2,5.7,90.9,11.8c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1
					c-6.4,0.9-12.8,2.9-18.9,6.3C10.4,41.9-0.2,68.5,8.9,90.6c6,14.4,18.7,23.8,33.4,26.8c11.1,2.3,20.3,9,24.8,18.7
					c0.1,0.3,0.3,0.6,0.4,0.9c11.6,24,42.7,32.7,68.6,19C158.9,144,169.9,117.9,161.5,95.7z;
		
					M163.7,95.5c0.2-2,0.3-4,0.3-4c0.5-7.2,1.2-15.6,0.3-24.7c-1.1-12-4.4-21.6-6.6-27.1c-2.4-5.8-4-9.7-7.1-13.8
					C138.2,9.3,113.4,3.8,95.3,8.2c-2.5,0.6-1.8,0.6-6.7,2c-16.3,4.5-23.5,3.9-32.3,6.3c0,0-12.6,3.5-23,12.9
					c-17.4,16-26.2,47.3-14.7,63.4c8.4,11.8,20.7,5.7,29,19.7c3.5,5.9,5.8,14.5,15.3,24.7c0,0,1.4,1.5,3,3c9.4,8.8,52.1,35.9,76.3,19.3 C158.7,148.2,161.3,120.5,163.7,95.5z;
		
					M161.5,95.7c-0.3-0.7-0.8-2.2-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1
					c-3.2-12.6-12.8-20.4-15.4-22.4c-15.7-12.3-37-11.6-51.3-5.5c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1
					C46,24,39.6,26,33.5,29.4C14,40.3-1,72.5,8.9,90.6c11.4,21,51.5,14.4,57.8,36.1c1.1,3.9,0.8,7.3,0.4,9.4c0.1,0.3,0.3,0.6,0.4,0.9
					c12.2,24.8,41.2,35.8,65.5,26.3C166.2,150.1,167.2,107.6,161.5,95.7z;
		
					M161.5,95.7c-0.6-1.5-1.2-2.9-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1
					c-3.2-12.6-12.8-20.4-15.4-22.4C126.5,5,105.2,5.7,90.9,11.8c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1
					c-6.4,0.9-12.8,2.9-18.9,6.3C10.4,41.9-0.2,68.5,8.9,90.6c6,14.4,18.7,23.8,33.4,26.8c11.1,2.3,20.3,9,24.8,18.7
					c0.1,0.3,0.3,0.6,0.4,0.9c11.6,24,42.7,32.7,68.6,19C158.9,144,169.9,117.9,161.5,95.7z';
					break;
				
				case 'style_2':
					$morph_value = '
					M78.8,23.2c-3.5,3-8.7,7.6-14.9,13.3c-8.9,8.3-13.5,12.4-17.5,16.6c-5,5.3-10.5,11-15.9,19c-4.9,7.2-11.9,17.7-14.5,32.8
					c-1.4,8.1-3.6,21.1,3.3,34.2c7.9,14.9,22.7,20.5,30.2,23.3c14.7,5.5,27.3,4.4,36,3.5c17.8-1.8,30.5-8.1,37-11.4
					c14.4-7.4,22.8-15.7,24.8-17.7c7-7.1,16.6-16.8,15.4-29c-0.3-3.1-1.2-5.6-2-7.3c-3.8-7.8-12-10.7-19.7-21.8c-9.7-13.9,9-32.9,3-47.9
					c-2.7-6.7-8.7-10.3-10.8-11.8c-9.6-6.7-19.7-6.7-24-6.7C95.2,12.3,84.5,18.3,78.8,23.2z;

					M78.8,23.2c-3.5,3-8.7,7.6-14.9,13.3c-8.9,8.3-13.5,12.4-17.5,16.6c-8.6,9-12.9,13.5-15.9,19c-7,12.9-6.5,25.7-6.2,32.6
					c0.3,7.5,0.7,18.7,8,30.7C40,148,50.8,153.8,55,156c6.4,3.3,23.5,12.3,35.7,5.3c9-5.2,5.4-13.5,14.3-20c13.1-9.5,26.7,4.6,42.3-4.7
					c9.8-5.8,16.7-18.6,15.4-29c-0.5-3.5-1.4-3.4-2-7.3c-1.8-12.1,7.2-17.3,9.3-28c3.1-16.1-11.2-35.8-25.9-41.7c-5-2-6.1-0.8-12.7-3.7
					c-13.5-5.8-13.6-12.6-22.1-14.8C98.4,9.4,86.4,16.7,78.8,23.2z;

					M82,8.3c-4.8,3-9.3,11.4-18.1,28.2c-5.2,9.9-5.8,12-10.2,19.5C47.4,66.7,44.3,72,40,76C27.5,87.6,16.6,81.5,8.7,89.7
					c-10.8,11.1-6.6,38.7,7,55c20,23.9,57.6,20,64,18.7c0.8-0.2,5.1-1.1,11-2c6.6-1,11.4-1.2,12.7-1.3c13.9-1.1,31.1-16,40.7-27.3
					c3.5-4.2,10.2-12.3,14.3-24.3c1.3-3.8,1-4.2,2.4-8c5.1-14.4,11.6-16.6,14-24c4.9-15.3-12.2-40-30.6-45.7c-5.1-1.5-7.5-0.8-12.7-3.7
					c-10.8-5.9-10-14.3-18.3-19.7C104.1,1.6,90.5,3,82,8.3z;

					M78.8,23.2c-3.5,3-8.7,7.6-14.9,13.3c-8.9,8.3-13.5,12.4-17.5,16.6c-5,5.3-10.5,11-15.9,19c-4.9,7.2-11.9,17.7-14.5,32.8
					c-1.4,8.1-3.6,21.1,3.3,34.2c7.9,14.9,22.7,20.5,30.2,23.3c14.7,5.5,27.3,4.4,36,3.5c17.8-1.8,30.5-8.1,37-11.4
					c14.4-7.4,22.8-15.7,24.8-17.7c7-7.1,16.6-16.8,15.4-29c-0.3-3.1-1.2-5.6-2-7.3c-3.8-7.8-12-10.7-19.7-21.8c-9.7-13.9,9-32.9,3-47.9
					c-2.7-6.7-8.7-10.3-10.8-11.8c-9.6-6.7-19.7-6.7-24-6.7C95.2,12.3,84.5,18.3,78.8,23.2z';
					break;

				case 'style_3':
					$morph_value = 'M6.5,39.4C7.9,62.9,6,81.5,3.8,94.8c-2.9,17.7-7.2,30.9,0.4,41.9c5.9,8.5,15.7,11,17.6,11.5
					c17.9,4.5,26.2-9.4,64-27c25.6-11.9,39.7-13.9,45.3-28c3.1-7.9,1.9-15.3,1.5-17.3c-2.7-12.7-14.2-21.9-28.5-30.4
					c-20-12-39.7-48.3-72-45.2C29.1,0.5,21.6,1.3,15.3,7C3.2,17.7,6,36.7,6.5,39.4z;
				
					M6.5,39.4C7.9,62.9,6,81.5,3.8,94.8c-4.1,24.8-5.6,33.6,0.4,41.9c10.6,14.8,41.6,17.2,56,4.3
					c11.2-9.9,4.2-21.5,15.8-31c13.8-11.4,29.9,0.5,45-12.3c9-7.6,11.1-18.4,11.7-21.9c2.5-17.1-9-30.9-16.7-40.1
					C92.4,7.4,57-3,32.2,0.2C25,1.1,19.7,3.1,15.3,7C3.2,17.7,6,36.7,6.5,39.4z;
				
					M6.5,39.4C4.9,52.6,3.2,71.6,3.8,94.8c1,39.1,7.2,45.3,10.4,47.7c9.5,7.1,18.1-0.1,46-1.5
					c38.4-1.9,56.7,10.1,63.5,0.8c6.6-9.2-9.5-22.7-2.8-44c3.6-11.4,9.7-11.7,11.7-21.9c3.5-17.9-11.9-34.9-16.7-40.1
					C91.8,9,56.5,9.9,47.7,10.2c-11.3,0.3-25.1,0.9-34,11.3C8.4,27.6,7,34.8,6.5,39.4z;
				
					M6.5,39.4C7.9,62.9,6,81.5,3.8,94.8c-2.9,17.7-7.2,30.9,0.4,41.9c5.9,8.5,15.7,11,17.6,11.5
					c17.9,4.5,26.2-9.4,64-27c25.6-11.9,39.7-13.9,45.3-28c3.1-7.9,1.9-15.3,1.5-17.3c-2.7-12.7-14.2-21.9-28.5-30.4
					c-20-12-39.7-48.3-72-45.2C29.1,0.5,21.6,1.3,15.3,7C3.2,17.7,6,36.7,6.5,39.4z';
					break;

				default:
					$morph_value = '';
					break;
			}

			$morph_svg .= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" '.$morph_style_svg.' x="0px" y="0px" viewBox="0 0 180 180">
			<path d="">
				<animate  repeatCount="indefinite" attributeName="d" '.$morph_speed_attr.' values="'.esc_attr($morph_value).'"/>
			</path>
			</svg>';

			$output .= '<div id="'.esc_attr($extended_id).'" class="morph-svg" style="'.$morph_style.'">'.$morph_svg.'</div>';
		}

		// custom social colors
        ob_start();
            if ((bool)$item_d['hide_on_mobile']) {
				echo "@media only screen and (max-width: ".(int)$item_d['resp_hide']."px) {
					#$extended_id{
						display: none;
					}
				}";
            }
        $styles = ob_get_clean();
        Integrio_shortcode_css()->enqueue_integrio_css($styles);

	}
}

$output .= '</div>';
$output .= $after_output;

echo Integrio_Theme_Helper::render_html($output);
