<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('sweet_dessert_sc_image_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_sc_image_theme_setup' );
	function sweet_dessert_sc_image_theme_setup() {
		add_action('sweet_dessert_action_shortcodes_list', 		'sweet_dessert_sc_image_reg_shortcodes');
		if (function_exists('sweet_dessert_exists_visual_composer') && sweet_dessert_exists_visual_composer())
			add_action('sweet_dessert_action_shortcodes_list_vc','sweet_dessert_sc_image_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_image id="unique_id" src="image_url" width="width_in_pixels" height="height_in_pixels" title="image's_title" align="left|right"]
*/

if (!function_exists('sweet_dessert_sc_image')) {	
	function sweet_dessert_sc_image($atts, $content=null){	
		if (sweet_dessert_in_shortcode_blogger()) return '';
		extract(sweet_dessert_html_decode(shortcode_atts(array(
			// Individual params
			"title" => "",
			"align" => "",
			"shape" => "square",
			"src" => "",
			"url" => "",
			"icon" => "",
			"link" => "",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => "",
			"width" => "",
			"height" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . sweet_dessert_get_css_position_as_classes($top, $right, $bottom, $left);
		$css .= sweet_dessert_get_css_dimensions_from_values($width, $height);
		$src = $src!='' ? $src : $url;
		if ($src > 0) {
			$attach = wp_get_attachment_image_src( $src, 'full' );
			if (isset($attach[0]) && $attach[0]!='')
				$src = $attach[0];
		}
		if (!empty($width) || !empty($height)) {
			$w = !empty($width) && strlen(intval($width)) == strlen($width) ? $width : null;
			$h = !empty($height) && strlen(intval($height)) == strlen($height) ? $height : null;
			if ($w || $h) $src = sweet_dessert_get_resized_image_url($src, $w, $h);
		}
		if (trim($link)) sweet_dessert_enqueue_popup();
		$output = empty($src) ? '' : ('<figure' . ($id ? ' id="'.esc_attr($id).'"' : '') 
			. ' class="sc_image ' . ($align && $align!='none' ? ' align' . esc_attr($align) : '') . (!empty($shape) ? ' sc_image_shape_'.esc_attr($shape) : '') . (!empty($class) ? ' '.esc_attr($class) : '') . '"'
			. (!sweet_dessert_param_is_off($animation) ? ' data-animation="'.esc_attr(sweet_dessert_get_animation_classes($animation)).'"' : '')
			. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
			. '>'
				. (trim($link) ? '<a href="'.esc_url($link).'">' : '')
				. '<img src="'.esc_url($src).'" alt="" />'
				. (trim($link) ? '</a>' : '')
				. (trim($title) || trim($icon) ? '<figcaption><span'.($icon ? ' class="'.esc_attr($icon).'"' : '').'></span> ' . ($title) . '</figcaption>' : '')
			. '</figure>');
		return apply_filters('sweet_dessert_shortcode_output', $output, 'trx_image', $atts, $content);
	}
	sweet_dessert_require_shortcode('trx_image', 'sweet_dessert_sc_image');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'sweet_dessert_sc_image_reg_shortcodes' ) ) {
	function sweet_dessert_sc_image_reg_shortcodes() {
	
		sweet_dessert_sc_map("trx_image", array(
			"title" => esc_html__("Image", 'trx_utils'),
			"desc" => wp_kses_data( __("Insert image into your post (page)", 'trx_utils') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"url" => array(
					"title" => esc_html__("URL for image file", 'trx_utils'),
					"desc" => wp_kses_data( __("Select or upload image or write URL from other site", 'trx_utils') ),
					"readonly" => false,
					"value" => "",
					"type" => "media",
					"before" => array(
						'sizes' => true		// If you want allow user select thumb size for image. Otherwise, thumb size is ignored - image fullsize used
					)
				),
				"title" => array(
					"title" => esc_html__("Title", 'trx_utils'),
					"desc" => wp_kses_data( __("Image title (if need)", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"icon" => array(
					"title" => esc_html__("Icon before title",  'trx_utils'),
					"desc" => wp_kses_data( __('Select icon for the title from Fontello icons set',  'trx_utils') ),
					"value" => "",
					"type" => "icons",
					"options" => sweet_dessert_get_sc_param('icons')
				),
				"align" => array(
					"title" => esc_html__("Float image", 'trx_utils'),
					"desc" => wp_kses_data( __("Float image to left or right side", 'trx_utils') ),
					"value" => "",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => sweet_dessert_get_sc_param('float')
				), 
				"shape" => array(
					"title" => esc_html__("Image Shape", 'trx_utils'),
					"desc" => wp_kses_data( __("Shape of the image: square (rectangle) or round", 'trx_utils') ),
					"value" => "square",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => array(
						"square" => esc_html__('Square', 'trx_utils'),
						"round" => esc_html__('Round', 'trx_utils')
					)
				), 
				"link" => array(
					"title" => esc_html__("Link", 'trx_utils'),
					"desc" => wp_kses_data( __("The link URL from the image", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"width" => sweet_dessert_shortcodes_width(),
				"height" => sweet_dessert_shortcodes_height(),
				"top" => sweet_dessert_get_sc_param('top'),
				"bottom" => sweet_dessert_get_sc_param('bottom'),
				"left" => sweet_dessert_get_sc_param('left'),
				"right" => sweet_dessert_get_sc_param('right'),
				"id" => sweet_dessert_get_sc_param('id'),
				"class" => sweet_dessert_get_sc_param('class'),
				"animation" => sweet_dessert_get_sc_param('animation'),
				"css" => sweet_dessert_get_sc_param('css')
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'sweet_dessert_sc_image_reg_shortcodes_vc' ) ) {
	function sweet_dessert_sc_image_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_image",
			"name" => esc_html__("Image", 'trx_utils'),
			"description" => wp_kses_data( __("Insert image", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_image',
			"class" => "trx_sc_single trx_sc_image",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "url",
					"heading" => esc_html__("Select image", 'trx_utils'),
					"description" => wp_kses_data( __("Select image from library", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "attach_image"
				),
				array(
					"param_name" => "align",
					"heading" => esc_html__("Image alignment", 'trx_utils'),
					"description" => wp_kses_data( __("Align image to left or right side", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => array_flip(sweet_dessert_get_sc_param('float')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "shape",
					"heading" => esc_html__("Image shape", 'trx_utils'),
					"description" => wp_kses_data( __("Shape of the image: square or round", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => array(
						esc_html__('Square', 'trx_utils') => 'square',
						esc_html__('Round', 'trx_utils') => 'round'
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "title",
					"heading" => esc_html__("Title", 'trx_utils'),
					"description" => wp_kses_data( __("Image's title", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "icon",
					"heading" => esc_html__("Title's icon", 'trx_utils'),
					"description" => wp_kses_data( __("Select icon for the title from Fontello icons set", 'trx_utils') ),
					"class" => "",
					"value" => sweet_dessert_get_sc_param('icons'),
					"type" => "dropdown"
				),
				array(
					"param_name" => "link",
					"heading" => esc_html__("Link", 'trx_utils'),
					"description" => wp_kses_data( __("The link URL from the image", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				sweet_dessert_get_vc_param('id'),
				sweet_dessert_get_vc_param('class'),
				sweet_dessert_get_vc_param('animation'),
				sweet_dessert_get_vc_param('css'),
				sweet_dessert_vc_width(),
				sweet_dessert_vc_height(),
				sweet_dessert_get_vc_param('margin_top'),
				sweet_dessert_get_vc_param('margin_bottom'),
				sweet_dessert_get_vc_param('margin_left'),
				sweet_dessert_get_vc_param('margin_right')
			)
		) );
		
		class WPBakeryShortCode_Trx_Image extends Sweet_Dessert_VC_ShortCodeSingle {}
	}
}
?>