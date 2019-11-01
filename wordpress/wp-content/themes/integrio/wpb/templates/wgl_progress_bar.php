<?php

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(Integrio_Theme_Helper::get_option('theme-secondary-color'));
$theme_gradient_start = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['to']);
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);

$defaults = array(
    'values' => '',
    'units' => '%',
    'extra_class' => '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

wp_enqueue_script('appear', get_template_directory_uri() . '/js/jquery.appear.js', array(), false, false);

$output = $points_render = $content = $value_render = $progress_classes = $animation_class = '';
$i = 0; // extra identificator uniqueness

// Animation
    if (!empty($atts['css_animation'])) {
        $animation_class = $this->getCSSAnimation( $atts['css_animation'] );
    }

// Progress bar classes
$progress_classes .= !empty($animation_class) ? ' '.$animation_class : '';
$progress_classes .= !empty($extra_class) ? ' '.$extra_class : '';

// Progress bar
$values = (array) vc_param_group_parse_atts( $values );
$item_data = array();
foreach ( $values as $data ) {
	$new_data = $data;
	$new_data['label'] = isset( $data['label'] ) ? esc_html($data['label']) : '';
	$new_data['point_value'] = isset( $data['point_value'] ) ? esc_html((int)$data['point_value']) : '0';
	$new_data['bar_color_type'] = isset( $data['bar_color_type'] ) ? $data['bar_color_type'] : '';
	$new_data['bar_color'] = isset( $data['bar_color'] ) ? esc_attr($data['bar_color']) : $theme_color;
	$new_data['bar_gradient_start'] = isset( $data['bar_gradient_start'] ) ? esc_attr($data['bar_gradient_start']) : $theme_gradient_start;
	$new_data['bar_gradient_end'] = isset( $data['bar_gradient_end'] ) ? esc_attr($data['bar_gradient_end']) : $theme_gradient_end;
	$new_data['bar_bg_color'] = isset( $data['bar_bg_color'] ) ? esc_attr($data['bar_bg_color']) : '#f0f3fa';
	$new_data['label_color'] = isset( $data['label_color'] ) ? esc_attr($data['label_color']) : $header_font_color;
	$new_data['value_color'] = isset( $data['value_color'] ) ? esc_attr($data['value_color']) : $header_font_color;

	$item_data[] = $new_data;
}

foreach ( $item_data as $item_d ) {

    // Adding unique id for progress bar
    $progress_attr = '';
    if ( !empty($item_d['bar_color_type']) ) {
        $progress_id = uniqid( "progress_" ).++$i;
        $progress_attr = ' id='.$progress_id;
    }

    // Custom styles
	ob_start();
		if ( !empty($item_d['bar_color_type']) ) {
			echo "#$progress_id .progress_label {
					  color: ".$item_d['label_color'].";
				  }";
			echo "#$progress_id .progress_value,
				  #$progress_id .progress_units {
					  color: ".$item_d['value_color'].";
				  }";
			echo "#$progress_id.progress_bar_wrap {
					  background-color: ".$item_d['bar_bg_color'].";
				  }";
		}
		if ( $item_d['bar_color_type'] == 'color' ) {
			echo "#$progress_id .progress_bar{
					  background: ".$item_d['bar_color'].";
				  }";
		}
		if ( $item_d['bar_color_type'] == 'gradient' ) {
			$gradient = 'background: '.$item_d['bar_gradient_start'].';';
			$gradient .= 'background: -webkit-radial-gradient(100% 150%, circle farthest-corner, '.$item_d['bar_gradient_start'].' 10%, '.$item_d['bar_gradient_end'].' 50%);';
			$gradient .= 'background: radial-gradient(circle farthest-corner at 100% 150%, '.$item_d['bar_gradient_start'].' 10%, '.$item_d['bar_gradient_end'].' 50%)';
			echo "#$progress_id .progress_bar {
					  $gradient;
				  }";
			echo "#$progress_id .progress_bar:before {
					  background-color: ".$item_d['bar_gradient_start'].";;
				  }";
		}
	$styles = ob_get_clean();
	Integrio_shortcode_css()->enqueue_integrio_css($styles);
	    
	// Render html
	$content .= '<div'.$progress_attr.' class="progress_wrap">';
		$content .= '<div class="progress_label_wrap">';
		    $content .= '<h5 class="progress_label">'.$item_d['label'].'</h5>';
		    $content .= '<div class="progress_value_wrap">';
		        $content .= '<span class="progress_value">'.$item_d['point_value'].'</span>';
		        $content .= '<span class="progress_units">'.esc_html($units).'</span>';
		    $content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="progress_bar_wrap">';
		    $content .= '<div class="progress_bar" data-width="'.$item_d['point_value'].'"></div>';
		$content .= '</div>';
    $content .= '</div>';
}

$output .= '<div class="integrio_module_progress_bar'.esc_attr($progress_classes).'">';
    $output .= $content;
$output .= '</div>';

echo Integrio_Theme_Helper::render_html($output);

?>