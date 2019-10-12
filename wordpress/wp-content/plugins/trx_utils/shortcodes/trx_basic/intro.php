<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('sweet_dessert_sc_intro_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_sc_intro_theme_setup' );
	function sweet_dessert_sc_intro_theme_setup() {
		add_action('sweet_dessert_action_shortcodes_list', 		'sweet_dessert_sc_intro_reg_shortcodes');
		if (function_exists('sweet_dessert_exists_visual_composer') && sweet_dessert_exists_visual_composer())
			add_action('sweet_dessert_action_shortcodes_list_vc','sweet_dessert_sc_intro_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

if (!function_exists('sweet_dessert_sc_intro')) {	
	function sweet_dessert_sc_intro($atts, $content=null){	
		if (sweet_dessert_in_shortcode_blogger()) return '';
		extract(sweet_dessert_html_decode(shortcode_atts(array(
			// Individual params
			"style" => 1,
			"align" => "none",
			"image" => "",
			"bg_color" => "",
			"icon" => "",
			"scheme" => "",
			"title" => "",
			"subtitle" => "",
			"description" => "",
			"link" => '',
			"link_caption" => esc_html__('Read more', 'trx_utils'),
			"link2" => '',
			"link2_caption" => '',
			"url" => "",
			"content_position" => "",
			"content_width" => "",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"width" => "",
			"height" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
	
		if ($image > 0) {
			$attach = wp_get_attachment_image_src($image, 'full');
			if (isset($attach[0]) && $attach[0]!='')
				$image = $attach[0];
		}
		
		$width  = sweet_dessert_prepare_css_value($width);
		$height = sweet_dessert_prepare_css_value($height);
		
		$class .= ($class ? ' ' : '') . sweet_dessert_get_css_position_as_classes($top, $right, $bottom, $left);

		$css .= sweet_dessert_get_css_dimensions_from_values($width,$height);
		$css .= ($image ? 'background: url('.$image.');' : '');
		$css .= ($bg_color ? 'background-color: '.$bg_color.';' : '');
		
		$buttons = (!empty($link) || !empty($link2) 
						? '<div class="sc_intro_buttons sc_item_buttons">'
							. (!empty($link) 
								? '<div class="sc_intro_button sc_item_button">'.do_shortcode('[trx_button link="'.esc_url($link).'" size="medium"]'.esc_html($link_caption).'[/trx_button]').'</div>' 
								: '')
							. (!empty($link2) && $style==2 
								? '<div class="sc_intro_button sc_item_button">'.do_shortcode('[trx_button link="'.esc_url($link2).'" size="medium"]'.esc_html($link2_caption).'[/trx_button]').'</div>' 
								: '')
							. '</div>'
						: '');
						
		$output = '<div '.(!empty($url) ? 'data-href="'.esc_url($url).'"' : '') 
					. ($id ? ' id="'.esc_attr($id).'"' : '') 
					. ' class="sc_intro' 
						. ($class ? ' ' . esc_attr($class) : '') 
						. ($content_position && $style==1 ? ' sc_intro_position_' . esc_attr($content_position) : '') 
						. ($style==5 ? ' small_padding' : '') 
						. ($scheme && !sweet_dessert_param_is_off($scheme) && !sweet_dessert_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '') 
						. ($align && $align!='none' ? ' align'.esc_attr($align) : '') 
						. '"'
					. (!sweet_dessert_param_is_off($animation) ? ' data-animation="'.esc_attr(sweet_dessert_get_animation_classes($animation)).'"' : '')
					. ($css ? ' style="'.esc_attr($css).'"' : '')
					.'>' 
					. '<div class="sc_intro_inner '.($style ? ' sc_intro_style_' . esc_attr($style) : '').'"'.(!empty($content_width) ? ' style="width:'.esc_attr($content_width).';"' : '').'>'
						. (!empty($icon) && $style==5 ? '<div class="sc_intro_icon '.esc_attr($icon).'"></div>' : '')
						. '<div class="sc_intro_content">'
							. (!empty($subtitle) && $style!=4 && $style!=5 ? '<h6 class="sc_intro_subtitle">' . trim(sweet_dessert_strmacros($subtitle)) . '</h6>' : '')
							. (!empty($title) ? '<h2 class="sc_intro_title">' .  $title . '</h2>' : '')
							. (!empty($description) && $style!=1 ? '<div class="sc_intro_descr">' . trim(sweet_dessert_strmacros($description)) . '</div>' : '')
							. ($style==2 || $style==3 ? $buttons : '')
						. '</div>'
					. '</div>'
				.'</div>';
	
	
	
		return apply_filters('sweet_dessert_shortcode_output', $output, 'trx_intro', $atts, $content);
	}
	sweet_dessert_require_shortcode('trx_intro', 'sweet_dessert_sc_intro');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'sweet_dessert_sc_intro_reg_shortcodes' ) ) {
	function sweet_dessert_sc_intro_reg_shortcodes() {
	
		sweet_dessert_sc_map("trx_intro", array(
			"title" => esc_html__("Intro", 'trx_utils'),
			"desc" => wp_kses_data( __("Insert Intro block in your page (post)", 'trx_utils') ),
			"decorate" => true,
			"container" => false,
			"params" => array(
				"style" => array(
					"title" => esc_html__("Style", 'trx_utils'),
					"desc" => wp_kses_data( __("Select style to display block", 'trx_utils') ),
					"value" => "1",
					"type" => "checklist",
					"options" => sweet_dessert_get_list_styles(1, 5)
				),
				"align" => array(
					"title" => esc_html__("Alignment of the intro block", 'trx_utils'),
					"desc" => wp_kses_data( __("Align whole intro block to left or right side of the page or parent container", 'trx_utils') ),
					"value" => "",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => sweet_dessert_get_sc_param('float')
				), 
				"image" => array(
					"title" => esc_html__("Image URL", 'trx_utils'),
					"desc" => wp_kses_data( __("Select the intro image from the library for this section", 'trx_utils') ),
					"readonly" => false,
					"value" => "",
					"type" => "media"
				),
				"bg_color" => array(
					"title" => esc_html__("Background color", 'trx_utils'),
					"desc" => wp_kses_data( __("Select background color for the intro", 'trx_utils') ),
					"value" => "",
					"type" => "color"
				),
				"icon" => array(
					"title" => esc_html__('Icon',  'trx_utils'),
					"desc" => wp_kses_data( __("Select icon from Fontello icons set",  'trx_utils') ),
					"dependency" => array(
						'style' => array(5)
					),
					"value" => "",
					"type" => "icons",
					"options" => sweet_dessert_get_sc_param('icons')
				),
				"content_position" => array(
					"title" => esc_html__('Content position', 'trx_utils'),
					"desc" => wp_kses_data( __("Select content position", 'trx_utils') ),
					"dependency" => array(
						'style' => array(1)
					),
					"value" => "top_left",
					"type" => "checklist",
					"options" => array(
						'top_left' => esc_html__('Top Left', 'trx_utils'),
						'top_right' => esc_html__('Top Right', 'trx_utils'),
						'bottom_right' => esc_html__('Bottom Right', 'trx_utils'),
						'bottom_left' => esc_html__('Bottom Left', 'trx_utils')
					)
				),
				"content_width" => array(
					"title" => esc_html__('Content width', 'trx_utils'),
					"desc" => wp_kses_data( __("Select content width", 'trx_utils') ),
					"dependency" => array(
						'style' => array(1)
					),
					"value" => "100%",
					"type" => "checklist",
					"options" => array(
						'100%' => esc_html__('100%', 'trx_utils'),
						'90%' => esc_html__('90%', 'trx_utils'),
						'80%' => esc_html__('80%', 'trx_utils'),
						'70%' => esc_html__('70%', 'trx_utils'),
						'60%' => esc_html__('60%', 'trx_utils'),
						'50%' => esc_html__('50%', 'trx_utils'),
						'40%' => esc_html__('40%', 'trx_utils'),
						'30%' => esc_html__('30%', 'trx_utils')
					)
				),
				"subtitle" => array(
					"title" => esc_html__("Subtitle", 'trx_utils'),
					"desc" => wp_kses_data( __("Subtitle for the block", 'trx_utils') ),
					"divider" => true,
					"dependency" => array(
						'style' => array(1,2,3)
					),
					"value" => "",
					"type" => "text"
				),
				"title" => array(
					"title" => esc_html__("Title", 'trx_utils'),
					"desc" => wp_kses_data( __("Title for the block", 'trx_utils') ),
					"value" => "",
					"type" => "textarea"
				),
				"description" => array(
					"title" => esc_html__("Description", 'trx_utils'),
					"desc" => wp_kses_data( __("Short description for the block", 'trx_utils') ),
					"dependency" => array(
						'style' => array(2,3,4,5),
					),
					"value" => "",
					"type" => "textarea"
				),
				"link" => array(
					"title" => esc_html__("Button URL", 'trx_utils'),
					"desc" => wp_kses_data( __("Link URL for the button at the bottom of the block", 'trx_utils') ),
					"dependency" => array(
						'style' => array(2,3),
					),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
				"link_caption" => array(
					"title" => esc_html__("Button caption", 'trx_utils'),
					"desc" => wp_kses_data( __("Caption for the button at the bottom of the block", 'trx_utils') ),
					"dependency" => array(
						'style' => array(2,3),
					),
					"value" => "",
					"type" => "text"
				),
				"link2" => array(
					"title" => esc_html__("Button 2 URL", 'trx_utils'),
					"desc" => wp_kses_data( __("Link URL for the second button at the bottom of the block", 'trx_utils') ),
					"dependency" => array(
						'style' => array(2)
					),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
				"link2_caption" => array(
					"title" => esc_html__("Button 2 caption", 'trx_utils'),
					"desc" => wp_kses_data( __("Caption for the second button at the bottom of the block", 'trx_utils') ),
					"dependency" => array(
						'style' => array(2)
					),
					"value" => "",
					"type" => "text"
				),
				"url" => array(
					"title" => esc_html__("Link", 'trx_utils'),
					"desc" => wp_kses_data( __("Link of the intro block", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"scheme" => array(
					"title" => esc_html__("Color scheme", 'trx_utils'),
					"desc" => wp_kses_data( __("Select color scheme for the section with text", 'trx_utils') ),
					"value" => "",
					"type" => "checklist",
					"options" => sweet_dessert_get_sc_param('schemes')
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
if ( !function_exists( 'sweet_dessert_sc_intro_reg_shortcodes_vc' ) ) {
	function sweet_dessert_sc_intro_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_intro",
			"name" => esc_html__("Intro", 'trx_utils'),
			"description" => wp_kses_data( __("Insert Intro block", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_intro',
			"class" => "trx_sc_single trx_sc_intro",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "style",
					"heading" => esc_html__("Style of the block", 'trx_utils'),
					"description" => wp_kses_data( __("Select style to display this block", 'trx_utils') ),
					"class" => "",
					"admin_label" => true,
					"value" => array_flip(sweet_dessert_get_list_styles(1, 5)),
					"type" => "dropdown"
				),
				array(
					"param_name" => "align",
					"heading" => esc_html__("Alignment of the block", 'trx_utils'),
					"description" => wp_kses_data( __("Align whole intro block to left or right side of the page or parent container", 'trx_utils') ),
					"class" => "",
					"std" => 'none',
					"value" => array_flip(sweet_dessert_get_sc_param('float')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "image",
					"heading" => esc_html__("Image URL", 'trx_utils'),
					"description" => wp_kses_data( __("Select the intro image from the library for this section", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "attach_image"
				),
				array(
					"param_name" => "bg_color",
					"heading" => esc_html__("Background color", 'trx_utils'),
					"description" => wp_kses_data( __("Select background color for the intro", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				array(
					"param_name" => "icon",
					"heading" => esc_html__("Icon", 'trx_utils'),
					"description" => wp_kses_data( __("Select icon from Fontello icons set", 'trx_utils') ),
					"class" => "",
					'dependency' => array(
						'element' => 'style',
						'value' => array('5')
					),
					"value" => sweet_dessert_get_sc_param('icons'),
					"type" => "dropdown"
				),
				array(
					"param_name" => "content_position",
					"heading" => esc_html__("Content position", 'trx_utils'),
					"description" => wp_kses_data( __("Select content position", 'trx_utils') ),
					"class" => "",
					"admin_label" => true,
					"value" => array(
						esc_html__('Top Left', 'trx_utils') => 'top_left',
						esc_html__('Top Right', 'trx_utils') => 'top_right',
						esc_html__('Bottom Right', 'trx_utils') => 'bottom_right',
						esc_html__('Bottom Left', 'trx_utils') => 'bottom_left'
					),
					'dependency' => array(
						'element' => 'style',
						'value' => array('1')
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "content_width",
					"heading" => esc_html__("Content width", 'trx_utils'),
					"description" => wp_kses_data( __("Select content width", 'trx_utils') ),
					"class" => "",
					"admin_label" => true,
					"value" => array(
						esc_html__('100%', 'trx_utils') => '100%',
						esc_html__('90%', 'trx_utils') => '90%',
						esc_html__('80%', 'trx_utils') => '80%',
						esc_html__('70%', 'trx_utils') => '70%',
						esc_html__('60%', 'trx_utils') => '60%',
						esc_html__('50%', 'trx_utils') => '50%',
						esc_html__('40%', 'trx_utils') => '40%',
						esc_html__('30%', 'trx_utils') => '30%'
					),
					'dependency' => array(
						'element' => 'style',
						'value' => array('1')
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "subtitle",
					"heading" => esc_html__("Subtitle", 'trx_utils'),
					"description" => wp_kses_data( __("Subtitle for the block", 'trx_utils') ),
					'dependency' => array(
						'element' => 'style',
						'value' => array('1','2','3')
					),
					"group" => esc_html__('Captions', 'trx_utils'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "title",
					"heading" => esc_html__("Title", 'trx_utils'),
					"description" => wp_kses_data( __("Title for the block", 'trx_utils') ),
					"group" => esc_html__('Captions', 'trx_utils'),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textarea"
				),
				array(
					"param_name" => "description",
					"heading" => esc_html__("Description", 'trx_utils'),
					"description" => wp_kses_data( __("Description for the block", 'trx_utils') ),
					"group" => esc_html__('Captions', 'trx_utils'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('2','3','4','5')
					),
					"class" => "",
					"value" => "",
					"type" => "textarea"
				),
				array(
					"param_name" => "link",
					"heading" => esc_html__("Button URL", 'trx_utils'),
					"description" => wp_kses_data( __("Link URL for the button at the bottom of the block", 'trx_utils') ),
					"group" => esc_html__('Captions', 'trx_utils'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('2','3')
					),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "link_caption",
					"heading" => esc_html__("Button caption", 'trx_utils'),
					"description" => wp_kses_data( __("Caption for the button at the bottom of the block", 'trx_utils') ),
					"group" => esc_html__('Captions', 'trx_utils'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('2','3')
					),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "link2",
					"heading" => esc_html__("Button 2 URL", 'trx_utils'),
					"description" => wp_kses_data( __("Link URL for the second button at the bottom of the block", 'trx_utils') ),
					"group" => esc_html__('Captions', 'trx_utils'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('2')
					),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "link2_caption",
					"heading" => esc_html__("Button 2 caption", 'trx_utils'),
					"description" => wp_kses_data( __("Caption for the second button at the bottom of the block", 'trx_utils') ),
					"group" => esc_html__('Captions', 'trx_utils'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('2')
					),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "url",
					"heading" => esc_html__("Link", 'trx_utils'),
					"description" => wp_kses_data( __("Link of the intro block", 'trx_utils') ),
					"value" => '',
					"type" => "textfield"
				),
				array(
					"param_name" => "scheme",
					"heading" => esc_html__("Color scheme", 'trx_utils'),
					"description" => wp_kses_data( __("Select color scheme for the section with text", 'trx_utils') ),
					"class" => "",
					"value" => array_flip(sweet_dessert_get_sc_param('schemes')),
					"type" => "dropdown"
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
		
		class WPBakeryShortCode_Trx_Intro extends Sweet_Dessert_VC_ShortCodeSingle {}
	}
}
?>