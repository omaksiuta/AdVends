<?php
$defaults = array(
	'side_style' => '',
	'screen_desktops' => '1024',
	'top_pad_d' => '',
	'bottom_pad_d' => '',
	'left_pad_d' => '',
	'right_pad_d' => '',	
	'screen_tablet' => '768',	
	'top_pad_t' => '',
	'bottom_pad_t' => '',
	'left_pad_t' => '',
	'right_pad_t' => '',	
	'screen_mobile' => '480',	
	'top_pad_m' => '',
	'bottom_pad_m' => '',
	'left_pad_m' => '',
	'right_pad_m' => '',
	'text_align' => 'center',
);
$atts = vc_shortcode_attribute_parse($defaults, $atts); 
extract($atts);
 
$custom_styles = esc_attr( $side_style );
$custom_css_class = "";
$custom_css_class 	= apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $side_style, ' ' ), 'wgl_split_slider_item', $atts );

$style = '';
$style .= !empty($text_align) ? ' style="text-align: '.esc_attr($text_align).';"': '';

$split_slider_id = uniqid( "integrio_split_slider_" );
$custom_css_class .= ' '.$split_slider_id;

ob_start();
	if(isset($top_pad_d) && $top_pad_d !== ''){
		echo '@media only screen and (max-width: '.(int) $screen_desktops.'px){
			.'.$split_slider_id.'{
				padding-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $top_pad_d ) ? $top_pad_d :  (int) $top_pad_d . 'px' ) . ' !important;
			}					
		}';					
	}	
	if(isset($bottom_pad_d) && $bottom_pad_d !== ''){
		echo '@media only screen and (max-width: '.(int) $screen_desktops.'px){
			.'.$split_slider_id.'{
				padding-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $bottom_pad_d ) ? $bottom_pad_d : (int) $bottom_pad_d . 'px' ) . ' !important;
			}					
		}';					 
	}	
	if(isset($left_pad_d) && $left_pad_d !== ''){
		echo '@media only screen and (max-width: '.(int) $screen_desktops.'px){
			.'.$split_slider_id.'{
				padding-left: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $left_pad_d ) ? $left_pad_d : (int) $left_pad_d . 'px' ) . ' !important;
			}					
		}';					
	}	
	if(isset($right_pad_d) && $right_pad_d !== ''){
		echo '@media only screen and (max-width: '.(int) $screen_desktops.'px){
			.'.$split_slider_id.'{
				padding-right: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $right_pad_d ) ? $right_pad_d : (int) $right_pad_d . 'px' ) . ' !important;
			}					
		}';					
	}	

	if(isset($top_pad_t) && $top_pad_t !== ''){
		echo '@media only screen and (max-width: '.(int) $screen_tablet.'px){
			.'.$split_slider_id.'{
				padding-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $top_pad_t ) ? $top_pad_t :  (int) $top_pad_t . 'px' ) . ' !important;
			}					
		}';					
	}	
	if(isset($bottom_pad_t) && $bottom_pad_t !== ''){
		echo '@media only screen and (max-width: '.(int) $screen_tablet.'px){
			.'.$split_slider_id.'{
				padding-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $bottom_pad_t ) ? $bottom_pad_t : (int) $bottom_pad_t . 'px' ) . ' !important;
			}					
		}';					 
	}	
	if(isset($left_pad_t) && $left_pad_t !== ''){
		echo '@media only screen and (max-width: '.(int) $screen_tablet.'px){
			.'.$split_slider_id.'{
				padding-left: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $left_pad_t ) ? $left_pad_t : (int) $left_pad_t . 'px' ) . ' !important;
			}					
		}';					
	}	
	if(isset($right_pad_t) && $right_pad_t !== ''){
		echo '@media only screen and (max-width: '.(int) $screen_tablet.'px){
			.'.$split_slider_id.'{
				padding-right: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $right_pad_t ) ? $right_pad_t : (int) $right_pad_t . 'px' ) . ' !important;
			}					
		}';					
	}	

	if(isset($top_pad_m) && $top_pad_m !== ''){
		echo '@media only screen and (max-width: '.(int) $screen_mobile.'px){
			.'.$split_slider_id.'{
				padding-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $top_pad_m ) ? $top_pad_m :  (int) $top_pad_m . 'px' ) . ' !important;
			}					
		}';					
	}	
	if(isset($bottom_pad_m) && $bottom_pad_m !== ''){
		echo '@media only screen and (max-width: '.(int) $screen_mobile.'px){
			.'.$split_slider_id.'{
				padding-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $bottom_pad_m ) ? $bottom_pad_m : (int) $bottom_pad_m . 'px' ) . ' !important;
			}					
		}';					 
	}	
	if(isset($left_pad_m) && $left_pad_m !== ''){
		echo '@media only screen and (max-width: '.(int) $screen_mobile.'px){
			.'.$split_slider_id.'{
				padding-left: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $left_pad_m ) ? $left_pad_m : (int) $left_pad_m . 'px' ) . ' !important;
			}					
		}';					
	}	
	if(isset($right_pad_m) && $right_pad_m !== ''){
		echo '@media only screen and (max-width: '.(int) $screen_mobile.'px){
			.'.$split_slider_id.'{
				padding-right: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $right_pad_m ) ? $right_pad_m : (int) $right_pad_m . 'px' ) . ' !important;
			}					
		}';					
	}
$styles = ob_get_clean();
Integrio_shortcode_css()->enqueue_integrio_css($styles);	


echo '<div class="integrio_split_slider-section'.(!empty($custom_css_class) ? " ".esc_attr($custom_css_class) : '').'"'.$style.'>';
	echo do_shortcode($content);
echo '</div>';
