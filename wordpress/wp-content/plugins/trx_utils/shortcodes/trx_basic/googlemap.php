<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('sweet_dessert_sc_googlemap_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_sc_googlemap_theme_setup' );
	function sweet_dessert_sc_googlemap_theme_setup() {
		add_action('sweet_dessert_action_shortcodes_list', 		'sweet_dessert_sc_googlemap_reg_shortcodes');
		if (function_exists('sweet_dessert_exists_visual_composer') && sweet_dessert_exists_visual_composer())
			add_action('sweet_dessert_action_shortcodes_list_vc','sweet_dessert_sc_googlemap_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

//[trx_googlemap id="unique_id" width="width_in_pixels_or_percent" height="height_in_pixels"]
//	[trx_googlemap_marker address="your_address"]
//[/trx_googlemap]

if (!function_exists('sweet_dessert_sc_googlemap')) {	
	function sweet_dessert_sc_googlemap($atts, $content = null) {
		if (sweet_dessert_in_shortcode_blogger()) return '';
		extract(sweet_dessert_html_decode(shortcode_atts(array(
			// Individual params
			"zoom" => 16,
			"style" => 'default',
			"scheme" => "",
			// Common params
			"id" => "",
			"class" => "",
			"css" => "",
			"animation" => "",
			"width" => "100%",
			"height" => "400",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . sweet_dessert_get_css_position_as_classes($top, $right, $bottom, $left);
		$css .= sweet_dessert_get_css_dimensions_from_values($width, $height);
		if (empty($id)) $id = 'sc_googlemap_'.str_replace('.', '', mt_rand());
		if (empty($style)) $style = sweet_dessert_get_custom_option('googlemap_style');
		$api_key = sweet_dessert_get_theme_option('api_google');
        if ( sweet_dessert_get_theme_option('api_google') != '') {
		    wp_enqueue_script( 'googlemap', sweet_dessert_get_protocol().'://maps.google.com/maps/api/js'.($api_key ? '?key='.$api_key : ''), array(), null, true );
		    wp_enqueue_script( 'sweet-dessert-googlemap-script', sweet_dessert_get_file_url('js/core.googlemap.js'), array(), null, true );
        }
		sweet_dessert_storage_set('sc_googlemap_markers', array());
		$content = do_shortcode($content);
		$output = '';
		$markers = sweet_dessert_storage_get('sc_googlemap_markers');
		if (count($markers) == 0) {
			$markers[] = array(
				'title' => sweet_dessert_get_custom_option('googlemap_title'),
				'description' => sweet_dessert_strmacros(sweet_dessert_get_custom_option('googlemap_description')),
				'latlng' => sweet_dessert_get_custom_option('googlemap_latlng'),
				'address' => sweet_dessert_get_custom_option('googlemap_address'),
				'point' => sweet_dessert_get_custom_option('googlemap_marker')
			);
		}
		$output .= 
			($content ? '<div id="'.esc_attr($id).'_wrap" class="sc_googlemap_wrap'
					. ($scheme && !sweet_dessert_param_is_off($scheme) && !sweet_dessert_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '') 
					. '">' : '')
			. '<div id="'.esc_attr($id).'"'
				. ' class="sc_googlemap'. (!empty($class) ? ' '.esc_attr($class) : '').'"'
				. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
				. (!sweet_dessert_param_is_off($animation) ? ' data-animation="'.esc_attr(sweet_dessert_get_animation_classes($animation)).'"' : '')
				. ' data-zoom="'.esc_attr($zoom).'"'
				. ' data-style="'.esc_attr($style).'"'
				. '>';
		$cnt = 0;
		foreach ($markers as $marker) {
			$cnt++;
			if (empty($marker['id'])) $marker['id'] = $id.'_'.intval($cnt);
            if ( sweet_dessert_get_theme_option('api_google') != '') {
			$output .= '<div id="'.esc_attr($marker['id']).'" class="sc_googlemap_marker"'
				. ' data-title="'.esc_attr($marker['title']).'"'
				. ' data-description="'.esc_attr(sweet_dessert_strmacros($marker['description'])).'"'
				. ' data-address="'.esc_attr($marker['address']).'"'
				. ' data-latlng="'.esc_attr($marker['latlng']).'"'
				. ' data-point="'.esc_attr($marker['point']).'"'
				. '></div>';
            } else {
                $output .= '<iframe src="https://maps.google.com/maps?t=m&output=embed&iwloc=near&z='.esc_attr($zoom > 0 ? $zoom : 14).'&q='
                    . esc_attr(!empty($marker['address']) ? urlencode($marker['address']) : '')
                    . ( !empty($marker['latlng'])
                        ? ( !empty($marker['address']) ? '@' : '' ) . str_replace(' ', '', $marker['latlng'])
                        : ''
                    )
                    . '" scrolling="no" marginheight="0" marginwidth="0" frameborder="0"'
                    . ' aria-label="' . esc_attr(!empty($marker['title']) ? $marker['title'] : '') . '"></iframe>';
            }
        }
		$output .= '</div>'
			. ($content ? '<div class="sc_googlemap_content">' . trim($content) . '</div></div>' : '');
			
		return apply_filters('sweet_dessert_shortcode_output', $output, 'trx_googlemap', $atts, $content);
	}
	sweet_dessert_require_shortcode("trx_googlemap", "sweet_dessert_sc_googlemap");
}


if (!function_exists('sweet_dessert_sc_googlemap_marker')) {	
	function sweet_dessert_sc_googlemap_marker($atts, $content = null) {
		if (sweet_dessert_in_shortcode_blogger()) return '';
		extract(sweet_dessert_html_decode(shortcode_atts(array(
			// Individual params
			"title" => "",
			"address" => "",
			"latlng" => "",
			"point" => "",
			// Common params
			"id" => ""
		), $atts)));
		if (!empty($point)) {
			if ($point > 0) {
				$attach = wp_get_attachment_image_src( $point, 'full' );
				if (isset($attach[0]) && $attach[0]!='')
					$point = $attach[0];
			}
		}
		$content = do_shortcode($content);
		sweet_dessert_storage_set_array('sc_googlemap_markers', '', array(
			'id' => $id,
			'title' => $title,
			'description' => !empty($content) ? $content : $address,
			'latlng' => $latlng,
			'address' => $address,
			'point' => $point ? $point : sweet_dessert_get_custom_option('googlemap_marker')
			)
		);
		return '';
	}
	sweet_dessert_require_shortcode("trx_googlemap_marker", "sweet_dessert_sc_googlemap_marker");
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'sweet_dessert_sc_googlemap_reg_shortcodes' ) ) {
	function sweet_dessert_sc_googlemap_reg_shortcodes() {
	
		sweet_dessert_sc_map("trx_googlemap", array(
			"title" => esc_html__("Google map", 'trx_utils'),
			"desc" => wp_kses_data( __("Insert Google map with specified markers", 'trx_utils') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
				"zoom" => array(
					"title" => esc_html__("Zoom", 'trx_utils'),
					"desc" => wp_kses_data( __("Map zoom factor", 'trx_utils') ),
					"divider" => true,
					"value" => 16,
					"min" => 1,
					"max" => 20,
					"type" => "spinner"
				),
				"style" => array(
					"title" => esc_html__("Map style", 'trx_utils'),
					"desc" => wp_kses_data( __("Select map style", 'trx_utils') ),
					"value" => "default",
					"type" => "checklist",
					"options" => sweet_dessert_get_sc_param('googlemap_styles')
				),
				"scheme" => array(
					"title" => esc_html__("Color scheme", 'trx_utils'),
					"desc" => wp_kses_data( __("Select color scheme for this block", 'trx_utils') ),
					"value" => "",
					"type" => "checklist",
					"options" => sweet_dessert_get_sc_param('schemes')
				),
				"width" => sweet_dessert_shortcodes_width('100%'),
				"height" => sweet_dessert_shortcodes_height(240),
				"top" => sweet_dessert_get_sc_param('top'),
				"bottom" => sweet_dessert_get_sc_param('bottom'),
				"left" => sweet_dessert_get_sc_param('left'),
				"right" => sweet_dessert_get_sc_param('right'),
				"id" => sweet_dessert_get_sc_param('id'),
				"class" => sweet_dessert_get_sc_param('class'),
				"animation" => sweet_dessert_get_sc_param('animation'),
				"css" => sweet_dessert_get_sc_param('css')
			),
			"children" => array(
				"name" => "trx_googlemap_marker",
				"title" => esc_html__("Google map marker", 'trx_utils'),
				"desc" => wp_kses_data( __("Google map marker", 'trx_utils') ),
				"decorate" => false,
				"container" => true,
				"params" => array(
					"address" => array(
						"title" => esc_html__("Address", 'trx_utils'),
						"desc" => wp_kses_data( __("Address of this marker", 'trx_utils') ),
						"value" => "",
						"type" => "text"
					),
					"latlng" => array(
						"title" => esc_html__("Latitude and Longitude", 'trx_utils'),
						"desc" => wp_kses_data( __("Comma separated marker's coorditanes (instead Address)", 'trx_utils') ),
						"value" => "",
						"type" => "text"
					),
					"point" => array(
						"title" => esc_html__("URL for marker image file", 'trx_utils'),
						"desc" => wp_kses_data( __("Select or upload image or write URL from other site for this marker. If empty - use default marker", 'trx_utils') ),
						"readonly" => false,
						"value" => "",
						"type" => "media"
					),
					"title" => array(
						"title" => esc_html__("Title", 'trx_utils'),
						"desc" => wp_kses_data( __("Title for this marker", 'trx_utils') ),
						"value" => "",
						"type" => "text"
					),
					"_content_" => array(
						"title" => esc_html__("Description", 'trx_utils'),
						"desc" => wp_kses_data( __("Description for this marker", 'trx_utils') ),
						"rows" => 4,
						"value" => "",
						"type" => "textarea"
					),
					"id" => sweet_dessert_get_sc_param('id')
				)
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'sweet_dessert_sc_googlemap_reg_shortcodes_vc' ) ) {
	function sweet_dessert_sc_googlemap_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_googlemap",
			"name" => esc_html__("Google map", 'trx_utils'),
			"description" => wp_kses_data( __("Insert Google map with desired address or coordinates", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_googlemap',
			"class" => "trx_sc_collection trx_sc_googlemap",
			"content_element" => true,
			"is_container" => true,
			"as_parent" => array('only' => 'trx_googlemap_marker,trx_form,trx_section,trx_block,trx_promo'),
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "zoom",
					"heading" => esc_html__("Zoom", 'trx_utils'),
					"description" => wp_kses_data( __("Map zoom factor", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => "16",
					"type" => "textfield"
				),
				array(
					"param_name" => "style",
					"heading" => esc_html__("Style", 'trx_utils'),
					"description" => wp_kses_data( __("Map custom style", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => array_flip(sweet_dessert_get_sc_param('googlemap_styles')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "scheme",
					"heading" => esc_html__("Color scheme", 'trx_utils'),
					"description" => wp_kses_data( __("Select color scheme for this block", 'trx_utils') ),
					"class" => "",
					"value" => array_flip(sweet_dessert_get_sc_param('schemes')),
					"type" => "dropdown"
				),
				sweet_dessert_get_vc_param('id'),
				sweet_dessert_get_vc_param('class'),
				sweet_dessert_get_vc_param('animation'),
				sweet_dessert_get_vc_param('css'),
				sweet_dessert_vc_width('100%'),
				sweet_dessert_vc_height(240),
				sweet_dessert_get_vc_param('margin_top'),
				sweet_dessert_get_vc_param('margin_bottom'),
				sweet_dessert_get_vc_param('margin_left'),
				sweet_dessert_get_vc_param('margin_right')
			)
		) );
		
		vc_map( array(
			"base" => "trx_googlemap_marker",
			"name" => esc_html__("Googlemap marker", 'trx_utils'),
			"description" => wp_kses_data( __("Insert new marker into Google map", 'trx_utils') ),
			"class" => "trx_sc_collection trx_sc_googlemap_marker",
			'icon' => 'icon_trx_googlemap_marker',
			"show_settings_on_create" => true,
			"content_element" => true,
			"is_container" => true,
			"as_child" => array('only' => 'trx_googlemap'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"params" => array(
				array(
					"param_name" => "address",
					"heading" => esc_html__("Address", 'trx_utils'),
					"description" => wp_kses_data( __("Address of this marker", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "latlng",
					"heading" => esc_html__("Latitude and Longitude", 'trx_utils'),
					"description" => wp_kses_data( __("Comma separated marker's coorditanes (instead Address)", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "title",
					"heading" => esc_html__("Title", 'trx_utils'),
					"description" => wp_kses_data( __("Title for this marker", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "point",
					"heading" => esc_html__("URL for marker image file", 'trx_utils'),
					"description" => wp_kses_data( __("Select or upload image or write URL from other site for this marker. If empty - use default marker", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "attach_image"
				),
				sweet_dessert_get_vc_param('id')
			)
		) );
		
		class WPBakeryShortCode_Trx_Googlemap extends Sweet_Dessert_VC_ShortCodeCollection {}
		class WPBakeryShortCode_Trx_Googlemap_Marker extends Sweet_Dessert_VC_ShortCodeCollection {}
	}
}
?>