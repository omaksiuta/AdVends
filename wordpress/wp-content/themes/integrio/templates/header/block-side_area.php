<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }


if (!class_exists('Integrio_header_side_area')) {
	class Integrio_header_side_area extends Integrio_get_header{

		public function __construct(){
			$this->header_vars();  
   		
	   		$pos = Integrio_Theme_Helper::options_compare('side_panel_position', 'mb_customize_side_panel', 'custom');
	   		$class = !empty($pos) ? ' side-panel_position_'.$pos : ' side-panel_position_right';

	   		wp_enqueue_script('perfect-scrollbar', get_template_directory_uri() . '/js/perfect-scrollbar.min.js', array(), false, false);
			echo '<div class="side-panel_overlay"></div>';
			
			echo '<section id="side-panel" class="side-panel_widgets'.esc_attr($class).'"'.$this->side_panel_style().'>';
				echo '<a href="#" class="side-panel_close"></a>';		
				echo '<div class="side-panel_sidebar">';
					dynamic_sidebar('side_panel');
				echo '</div>';
			echo '</section>';	
		}

		public function side_panel_style(){			
			$name_preset = $this->name_preset;
	   		$def_preset = $this->def_preset;

			$bg = Integrio_Theme_Helper::get_option('side_panel_bg');
			$bg = !empty($bg['rgba']) ? $bg['rgba'] : '';

			$color = Integrio_Theme_Helper::get_option('side_panel_text_color');
			$color = !empty($color['rgba']) ? $color['rgba'] : '';

			$width = Integrio_Theme_Helper::get_option('side_panel_width');
			$width = !empty($width['width']) ? $width['width'] : '';

			$align = Integrio_Theme_Helper::options_compare('side_panel_text_alignment', 'mb_customize_side_panel', 'custom');	
			$style = '';

			if (class_exists( 'RWMB_Loader' ) && $this->id !== 0) {
				$side_panel_switch = rwmb_meta('mb_customize_side_panel');
				if($side_panel_switch === 'custom'){
					$bg = rwmb_meta("mb_side_panel_bg");
					$color = rwmb_meta("mb_side_panel_text_color");
					$width = rwmb_meta("mb_side_panel_width");
				}
			}

			if (!empty($bg)) {
	            $style .= !empty($bg) ? 'background-color: '.esc_attr($bg).';' : '';
	        }

			if (!empty($color)) {
	            $style .= !empty($color) ? 'color: '.esc_attr($color).';' : '';
	        }

	        if (!empty($width)) {
	            $style .= 'width: '.esc_attr((int) $width ).'px;';
	        }
	       
	        $style .= !empty($align) ? 'text-align: '.esc_attr($align).';' : 'text-align:center;';

			$style = !empty($style) ? ' style="'.$style.'"' : '';
			return $style;
		}
	}

    new Integrio_header_side_area();
}
