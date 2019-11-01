<?php

    $theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));

    $defaults = array(
        'values' => '',
        'icons_pos' => 'left',
        'display_inline' => false,
        'icon_gap' => '',
        'icon_size' => '',
        'bg_size' => '',
        'border_radius' => '',
        'add_box_shadow_element' => false,
        'extra_class' => '',
        // Colors
        'all_custom_colors' => false,
        'add_bg' => false,
        'all_icon_color' => '#ffffff',
        'all_icon_hover_color' => $theme_color,
        'all_bg_color' => $theme_color,
        'all_bg_hover_color' => '#ffffff',
        'all_border_color' => '#ffffff',
        'all_border_hover_color' => $theme_color,
        // Offsets
        'left_margin' => '',
        'right_margin' => '',
        'left_padding' => '',
        'right_padding' => '',
    );

    $atts = vc_shortcode_attribute_parse($defaults, $atts);
    extract($atts);

    $output = $content = $social_wrap_classes = $animation_class = $icon_colors = $soc_icon_wrap_id_attr = '';
    $id_i = 0; // extra identificator uniqueness

    // Adding unique id for social icon module
    if ((bool)$all_custom_colors || (bool)$add_bg || (bool)$display_inline) {
        $soc_icon_wrap_id = uniqid( "integrio_soc_icon_wrap_" );
        $soc_icon_wrap_id_attr = ' id='.$soc_icon_wrap_id;
    }

    // Custom module styles
    ob_start();
        if ((bool)$add_bg) {
            echo "#$soc_icon_wrap_id a{
                      background: ".(!empty($all_bg_color) ? esc_attr($all_bg_color) : 'transparent').";
                      border-color: ".(!empty($all_border_color) ? esc_attr($all_border_color) : 'transparent').";
                  }";
            echo "#$soc_icon_wrap_id a:hover{
                      background: ".(!empty($all_bg_hover_color) ? esc_attr($all_bg_hover_color) : 'transparent').";
                      border-color: ".(!empty($all_border_hover_color) ? esc_attr($all_border_hover_color) : $theme_color).";
                  }";
        }
        if ((bool)$all_custom_colors) {
            echo "#$soc_icon_wrap_id a{
                      color: ".(!empty($all_icon_color) ? esc_attr($all_icon_color) : '#ffffff').";
                  }";
            echo "#$soc_icon_wrap_id a:hover{
                      color: ".(!empty($all_icon_hover_color) ? esc_attr($all_icon_hover_color) : $theme_color).";
                  }";
        }
        if ((bool)$display_inline) {
            echo "#$soc_icon_wrap_id{
                      display: inline-block;
                  }";
        }
    $styles = ob_get_clean();
    Integrio_shortcode_css()->enqueue_integrio_css($styles);

    // Animation
    if (!empty($atts['css_animation'])) {
        $animation_class = $this->getCSSAnimation( $atts['css_animation'] );
    }

    // Social wrapper classes
	$social_wrap_classes .= ' a'.$icons_pos;
	$social_wrap_classes .= (bool)$add_bg ? ' with_bg' : '';
	$social_wrap_classes .= (bool)$add_box_shadow_element ? ' add_box_shadow' : '';
	$social_wrap_classes .= !empty($animation_class) ? ' '.$animation_class : '';
	$social_wrap_classes .= !empty($extra_class) ? ' '.$extra_class : '';

	$social_wrap_styles = (!empty($icon_gap) && !(bool)$display_inline) ? 'margin-left:-'.($icon_gap/2).'px; margin-right:-'.($icon_gap/2).'px;' : '';
	if ((bool)$display_inline) {
		$social_wrap_styles .= ($left_margin != '') ? ' margin-left:'.(int)$left_margin.'px;' : '';
		$social_wrap_styles .= ($right_margin != '') ? ' margin-right:'.(int)$right_margin.'px;' : '';
		$social_wrap_styles .= ($left_padding != '') ? ' padding-left:'.(int)$left_padding.'px;' : '';
		$social_wrap_styles .= ($right_padding != '') ? ' padding-right:'.(int)$right_padding.'px;' : '';
	}
	$social_wrap_styles = !empty($social_wrap_styles) ? 'style="'.esc_attr($social_wrap_styles).'"' : '';


    $values = (array) vc_param_group_parse_atts( $values );
    $item_data = array();
    foreach ( $values as $data ) {
        $new_data = $data;
        $new_data['icon'] = isset( $data['icon'] ) ? $data['icon'] : '';
        $new_data['link'] = isset( $data['link'] ) ? $data['link'] : '#';
        $new_data['title'] = isset( $data['title'] ) ? $data['title'] : '';
        $new_data['new_tab'] = isset( $data['new_tab'] ) ? $data['new_tab'] : true;
        $new_data['custom_colors'] = isset( $data['custom_colors'] ) ? $data['custom_colors'] : false;
        $new_data['icon_color'] = isset( $data['icon_color'] ) ? $data['icon_color'] : '#ffffff';
        $new_data['icon_hover_color'] = isset( $data['icon_hover_color'] ) ? $data['icon_hover_color'] : $theme_color;
        $new_data['bg_color'] = isset( $data['bg_color'] ) ? $data['bg_color'] : $theme_color;
        $new_data['bg_hover_color'] = isset( $data['bg_hover_color'] ) ? $data['bg_hover_color'] : '#ffffff';

        $item_data[] = $new_data;
    }

	$icon_size_style = !empty($icon_size) ? 'font-size:'.esc_attr((int)$icon_size).'px; ' : '';
	$bg_size_style = !empty($bg_size) ? 'width:'.esc_attr((int)$bg_size).'px; height:'.esc_attr((int)$bg_size).'px; line-height:'.esc_attr((int)$bg_size).'px; ' : '';
	$border_radius_style = ( ($border_radius != '') && (bool)$add_bg ) ? 'border-radius:'.esc_attr((int)$border_radius).'px; ' : '';
	$icon_gap_style = ($icon_gap != '') ? 'margin-left:'.esc_attr((int)$icon_gap/2).'px; margin-right:'.esc_attr((int)$icon_gap/2).'px; margin-bottom:'.esc_attr((int)$icon_gap/2).'px; ' : '';

	$icon_style = $icon_size_style.$bg_size_style.$border_radius_style.$icon_gap_style;
	$icon_style = !empty($icon_style) ? 'style="'.$icon_style.'"' : '';

    foreach ( $item_data as $item_d ) {
        $icon = $item_d['icon'];
        $title_tag = !empty( $item_d['title'] ) ? " title='".esc_attr($item_d['title'])."'" : "";
        $new_tab = !empty( $item_d['link'] ) && (bool)$item_d['new_tab'] ? "target='_blank'" : "";

        $social_attr = '';
        if ((bool)$item_d['custom_colors']) {
            $social_id = uniqid( "soc_icon_" ).++$id_i;
            $social_attr = ' id='.$social_id;
        }

        // Custom styles for each icon
        ob_start();
            if ((bool)$item_d['custom_colors']) {
                echo ".integrio_module_social #$social_id{
                          color: ".$item_d['icon_color'].";
                      }";
                echo ".integrio_module_social #$social_id:hover{
                          color: ".$item_d['icon_hover_color'].";
                      }";
                if ((bool)$add_bg ) {
                    echo ".integrio_module_social #$social_id{
                              background: ".$item_d['bg_color'].";
                          }";
                    echo ".integrio_module_social #$social_id:hover{
                              background: ".$item_d['bg_hover_color'].";
                          }";
                }
            }
        $styles = ob_get_clean();
        Integrio_shortcode_css()->enqueue_integrio_css($styles);

        $content .= '<a'.$social_attr.' href="'.esc_url($item_d['link']).'" class="soc_icon '.$item_d['icon'].'" '.$icon_style.' '.$new_tab.' '.$title_tag.'></a>';

    }

    

    $output .= '<div '.esc_attr($soc_icon_wrap_id_attr).' class="integrio_module_social'.esc_attr($social_wrap_classes).'" '.$social_wrap_styles.'>';
        $output .= $content;
    $output .= '</div>';

    echo Integrio_Theme_Helper::render_html($output);

?>