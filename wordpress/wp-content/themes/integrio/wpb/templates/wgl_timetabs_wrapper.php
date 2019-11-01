<?php
	$theme_color = esc_attr(Integrio_Theme_Helper::get_option("theme-custom-color"));
	$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);

	$defaults = array(
		// Styles
		'title_custom_color' => false,
		'title_color' => $header_font_color,
		'title_color_hover' => $header_font_color,
		'icon_custom_color' => false,
		'icon_color' => $theme_color,
		'icon_color_hover' => $theme_color,
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);
	global $shortcode_tags;
	$title_array = $subtitle_array = $tab_id_array = $timetabs_id = $timetabs_id_attr = $icon_type_html = $icon_image_html = '';

	preg_match_all( '/(?:icon_type="([^\"]*)"[^\]]*icon_font_type="([^\"]*)"[^\]]*(?:icon_flaticon|icon_fontawesome)="([^\"]*)"[^\]])*(?:icon_type="([^\"]*)"[^\]]*thumbnail="([^\"]*)"[^\]])*tab_title="([^\"]*)"[^\]]*tab_id="([^\"]*)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
	$tab_titles = array();

	if ( isset( $matches[1] ) ) {$icon_type_array = $matches[1];}
	if ( isset( $matches[2] ) ) {$icon_font_type_array = $matches[2];}
	if ( isset( $matches[3] ) ) {$icon_font_array = $matches[3];}
	if ( isset( $matches[4] ) ) {$icon_type_image_array = $matches[4];}
	if ( isset( $matches[5] ) ) {$thumbnail_array = $matches[5];}
	if ( isset( $matches[6] ) ) {$title_array = $matches[6];}
	if ( isset( $matches[7] ) ) {$tab_id_array = $matches[7];}

	if ((bool)$title_custom_color || (bool)$icon_custom_color) {
		$timetabs_id = uniqid( "timetabs_" );
		$timetabs_id_attr = ' id='.$timetabs_id;
	}

	ob_start();
	if ((bool)$title_custom_color) {
		echo "#$timetabs_id .wgl_tab .tab_title {color:".(!empty($title_color) ? esc_attr($title_color) : 'transparent').";}";
		echo "#$timetabs_id .wgl_tab:hover .tab_title {color:".(!empty($title_color_hover) ? esc_attr($title_color_hover) : 'transparent').";}";
		echo "#$timetabs_id .wgl_tab.active .tab_title {color:".(!empty($title_color_hover) ? esc_attr($title_color_hover) : 'transparent').";}";
	}
	if ((bool)$icon_custom_color) {
		echo "#$timetabs_id .wgl_tab .services_icon {color:".(!empty($icon_color) ? esc_attr($icon_color) : 'transparent').";}";
		echo "#$timetabs_id .wgl_tab:hover .services_icon {color:".(!empty($icon_color_hover) ? esc_attr($icon_color_hover) : 'transparent').";}";
		echo "#$timetabs_id .wgl_tab.active .services_icon {color:".(!empty($icon_color_hover) ? esc_attr($icon_color_hover) : 'transparent').";}";
	}
	$styles = ob_get_clean();
	Integrio_shortcode_css()->enqueue_integrio_css($styles);

	$tab_titles_array = array();
	foreach ($title_array as $key => $val) {
		$headings = true;
		
		$tab_titles_array[] = array(
			'icon_type' => $icon_type_array[$key][0],
			'icon_font_type' => $icon_font_type_array[$key][0],
			'icon_font' => $icon_font_array[$key][0],
			'icon_image' => $icon_type_image_array[$key][0],
			'thumbnail' => $thumbnail_array[$key][0],
			'title' => $title_array[$key][0],
			'tab_id' => 'tab-'.$tab_id_array[$key][0]
		);
		if (empty($title_array[$key][0]) && empty($subtitle_array[$key][0])) {
			$headings = false;
		}
	}

	echo '<div class="wgl_timetabs"'.$timetabs_id_attr.'>';
		if ($headings) {
			echo '<div class="timetabs_headings">';
		}
			foreach ($tab_titles_array as $value) {

				// Icon/Image output
				if ($value['icon_type'] == 'font') {
					if ($value['icon_font_type'] == 'type_fontawesome') {
						wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
						$icon_font = $value['icon_font'];
					} else if($value['icon_font_type'] == 'type_flaticon'){
						wp_enqueue_style('flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
						$icon_font = $value['icon_font'];
					}
					$icon_type_html = '<i class="services_icon '.esc_attr($icon_font).'"></i>';
				}
				if ($value['icon_image'] == 'image' && !empty($value['thumbnail'])) {
					$featured_image = wp_get_attachment_image_src($value['thumbnail'], 'full');
					$featured_image_url = $featured_image[0];
					$img_alt = get_post_meta($value['thumbnail'], '_wp_attachment_image_alt', true);
					$icon_image_html = '<div class="services_image"><img src="'.esc_url($featured_image_url).'" alt="'.(!empty($img_alt) ? esc_attr($img_alt) : '').'" /></div>';
				}

				echo '<div class="wgl_tab" data-tab-id="'.esc_attr($value['tab_id']).'">';
					if ($value['icon_type'] == 'font') {
						echo !empty($icon_type_html) ? $icon_type_html : '';
					}
					if ($value['icon_image'] == 'image' && !empty($value['thumbnail'])) {
						echo !empty($icon_image_html) ? $icon_image_html : '';
					}
					echo !empty($value['title']) ? '<div class="tab_title">'.esc_html($value['title'],'integrio').'</div>' : '';
				echo '</div>';
			}
		if ($headings) {
			echo '</div>';
		}
		echo '<div class="timetabs_data">';
			echo do_shortcode($content);
		echo '</div>';
	echo '</div>';

?>