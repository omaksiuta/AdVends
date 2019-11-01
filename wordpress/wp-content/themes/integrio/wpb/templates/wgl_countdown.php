<?php

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);

$defaults = array(
	// General
	'icon_type' => 'font',
	'countdown_year' => '2019',
	'countdown_month' => '10',
	'countdown_day' => '17',
	'countdown_hours' => '11',
	'countdown_min' => '30',
	'hide_day' => '',
	'hide_hours' => '',
	'hide_minutes' => '',
	'hide_seconds' => '',
    'show_value_names' => true,
	// Style
	'size' => 'large',
	'align' => 'center',
	'font_size' => '',  
	'font_size_number' => '',
	'font_size_text' => '',
	'font_weight' => '',
	'font_text_weight' => '',
	'values_color' => $header_font_color,
	'value_names_color' => $theme_color,
	'points_color' => $theme_color,
	'custom_fonts_countdown' => false,
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

wp_enqueue_script('coundown', get_template_directory_uri() . '/js/jquery.countdown.min.js', array(), false, false);
extract( Integrio_GoogleFontsRender::getAttributes( $atts, $this, array('google_fonts_countdown') ) );

$countdown_class = $countdown_value_font = '';

// Module unique id
$countdown_id = uniqid( "countdown_" );
$countdown_attr = ' id='.$countdown_id;

// Custom styles
ob_start();
    echo "#$countdown_id .countdown-amount {
        	  color: ".(!empty($values_color) ? esc_attr($values_color) : 'transparent').";
    	  }";
    echo "#$countdown_id .countdown-amount:before,
          #$countdown_id .countdown-amount:after {
        	  border-color: ".(!empty($points_color) ? esc_attr($points_color) : 'transparent').";
        	  background-color: ".(!empty($points_color) ? esc_attr($points_color) : 'transparent').";
    	  }";
	switch ((bool)$show_value_names) {
		case true:
			echo "#$countdown_id .countdown-period {
					  color: ".(!empty($value_names_color) ? esc_attr($value_names_color) : 'transparent').";
				  }";
			break;
		default: echo "#$countdown_id .countdown-period { display: none; }"; 
			break;
	}
    if ( !empty($font_weight) ) {
		echo "#$countdown_id .countdown-amount {
				  font-weight: ".$font_weight.";
			  }";
    }
    if ( !empty($font_text_weight) ) {
        echo "#$countdown_id .countdown-period {
            	  font-weight: ".$font_text_weight.";
        	  }";
    }
    if ( $size == 'custom' ) {
        if( !empty($font_size_number) ) {
            echo "#$countdown_id .countdown-amount {
                	  font-size: ".floatval($font_size_number)."em;
            	  }";                
        }
        if ( !empty($font_size_text) ) {
            echo "#$countdown_id .countdown-period{
                	  font-size: ".floatval($font_size_text)."em;
            	  }";
        }
    }
$styles = ob_get_clean();
Integrio_shortcode_css()->enqueue_integrio_css($styles);


if (isset($styles_google_fonts_countdown) && !empty($styles_google_fonts_countdown)) {
    $countdown_value_font = esc_attr( $styles_google_fonts_countdown ).'; ';
}

$countdown_class .= (bool)$custom_fonts_countdown ? ' custom_font' : '';

$countdown_class .= ' cd_'.$size;
$countdown_class .= ' align_'.$align;

$countdown_style = !empty($countdown_value_font) ? $countdown_value_font : '';
$countdown_style .= ($size == 'custom') ? 'font-size:'.esc_attr($font_size).'px;' : '';

$f = !(bool)$hide_day ? 'd' : '';
$f .= !(bool)$hide_hours ? 'H' : '';
$f .= !(bool)$hide_minutes ? 'M' : '';
$f .= !(bool)$hide_seconds ? 'S' : '';

// Countdown data attribute http://keith-wood.name/countdown.html
$data_array = array(); 

$data_array['format'] = !empty($f) ? esc_attr($f) : '';

$data_array['year'] =  esc_attr($countdown_year);
$data_array['month'] =  esc_attr($countdown_month);
$data_array['day'] =  esc_attr($countdown_day);
$data_array['hours'] =  esc_attr($countdown_hours);
$data_array['minutes'] =  esc_attr($countdown_min);

$data_array['labels'][]  =  esc_attr( esc_html__( 'Years', 'integrio' ) );
$data_array['labels'][]  =  esc_attr( esc_html__( 'Months', 'integrio' ) );
$data_array['labels'][]  =  esc_attr( esc_html__( 'Weeks', 'integrio' ) );
$data_array['labels'][]  =  esc_attr( esc_html__( 'Days', 'integrio' ) );
$data_array['labels'][]  =  esc_attr( esc_html__( 'Hours', 'integrio' ) );
$data_array['labels'][]  =  esc_attr( esc_html__( 'Minutes', 'integrio' ) );
$data_array['labels'][]  =  esc_attr( esc_html__( 'Seconds', 'integrio' ) );
$data_array['labels1'][] =  esc_attr( esc_html__( 'Year', 'integrio' ) );
$data_array['labels1'][] =  esc_attr( esc_html__( 'Month', 'integrio' ) );
$data_array['labels1'][] =  esc_attr( esc_html__( 'Week', 'integrio' ) );
$data_array['labels1'][] =  esc_attr( esc_html__( 'Day', 'integrio' ) );
$data_array['labels1'][] =  esc_attr( esc_html__( 'Hour', 'integrio' ) );
$data_array['labels1'][] =  esc_attr( esc_html__( 'Minute', 'integrio' ) );
$data_array['labels1'][] =  esc_attr( esc_html__( 'Second', 'integrio' ) );

$data_attribute = json_encode($data_array, true);

$output = '<div'.$countdown_attr.' class="integrio_module_countdown'.esc_attr($countdown_class).'" data-atts="'.esc_js($data_attribute).'" style="'.esc_attr($countdown_style).'">';
$output .= '</div>';

echo Integrio_Theme_Helper::render_html($output);

?>
    
