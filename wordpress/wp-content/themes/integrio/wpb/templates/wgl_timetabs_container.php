<?php
	$defaults = array(
		// General
		'icon_type' => '',
		'icon_font_type' => '',
		'icon_fontawesome' => '',
		'icon_flaticon' => '',
		'thumbnail' => '',
		'tab_title' => '',
		'tab_id' => '',
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);
	
	echo '<div class="timetab_container" data-tab-id="tab-'.esc_attr($tab_id).'">'.do_shortcode($content).'</div>';

?>