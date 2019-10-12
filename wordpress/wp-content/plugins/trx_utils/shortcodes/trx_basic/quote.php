<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('sweet_dessert_sc_quote_theme_setup')) {
    add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_sc_quote_theme_setup' );
    function sweet_dessert_sc_quote_theme_setup() {
        add_action('sweet_dessert_action_shortcodes_list', 		'sweet_dessert_sc_quote_reg_shortcodes');
        if (function_exists('sweet_dessert_exists_visual_composer') && sweet_dessert_exists_visual_composer())
            add_action('sweet_dessert_action_shortcodes_list_vc','sweet_dessert_sc_quote_reg_shortcodes_vc');
    }
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_quote id="unique_id" cite="url" title=""]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/quote]
*/

if (!function_exists('sweet_dessert_sc_quote')) {
    function sweet_dessert_sc_quote($atts, $content=null){
        if (sweet_dessert_in_shortcode_blogger()) return '';
        extract(sweet_dessert_html_decode(shortcode_atts(array(
            // Individual params
            "title" => "",
            "cite" => "",
            "bg_image" => "",
            // Common params
            "id" => "",
            "class" => "",
            "animation" => "",
            "css" => "",
            "width" => "",
            "top" => "",
            "bottom" => "",
            "left" => "",
            "right" => ""
        ), $atts)));

        if ($bg_image > 0) {
            $attach = wp_get_attachment_image_src( $bg_image, 'full' );
            if (isset($attach[0]) && $attach[0]!='')
                $bg_image = $attach[0];
        }

        $class .= ($class ? ' ' : '') . sweet_dessert_get_css_position_as_classes($top, $right, $bottom, $left);
        $css .= sweet_dessert_get_css_dimensions_from_values($width);
        $css .= ($bg_image !== '' ? 'background-image:url(' . esc_url($bg_image) . ');' : '');
        $cite_param = $cite != '' ? ' cite="'.esc_attr($cite).'"' : '';
        $title = $title=='' ? $cite : $title;
        $content = do_shortcode($content);
        if (sweet_dessert_substr($content, 0, 2)!='<p') $content = '<p>' . ($content) . '</p>';
        $output = '<blockquote'
            . ($id ? ' id="'.esc_attr($id).'"' : '') . ($cite_param)
            . ' class="sc_quote'. (!empty($class) ? ' '.esc_attr($class) : '').'"'
            . (!sweet_dessert_param_is_off($animation) ? ' data-animation="'.esc_attr(sweet_dessert_get_animation_classes($animation)).'"' : '')
            . ($css!='' ? ' style="'.esc_attr($css).'"' : '')
            . '>'
            . ($content)
            . ($title == '' ? '' : ('<p class="sc_quote_title">' . ($cite!='' ? '<a href="'.esc_url($cite).'">' : '') . ($title) . ($cite!='' ? '</a>' : '') . '</p>'))
            .'</blockquote>';
        return apply_filters('sweet_dessert_shortcode_output', $output, 'trx_quote', $atts, $content);
    }
    sweet_dessert_require_shortcode('trx_quote', 'sweet_dessert_sc_quote');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'sweet_dessert_sc_quote_reg_shortcodes' ) ) {
    function sweet_dessert_sc_quote_reg_shortcodes() {

        sweet_dessert_sc_map("trx_quote", array(
            "title" => esc_html__("Quote", 'trx_utils'),
            "desc" => wp_kses_data( __("Quote text", 'trx_utils') ),
            "decorate" => false,
            "container" => true,
            "params" => array(
                "cite" => array(
                    "title" => esc_html__("Quote cite", 'trx_utils'),
                    "desc" => wp_kses_data( __("URL for quote cite", 'trx_utils') ),
                    "value" => "",
                    "type" => "text"
                ),
                "title" => array(
                    "title" => esc_html__("Title (author)", 'trx_utils'),
                    "desc" => wp_kses_data( __("Quote title (author name)", 'trx_utils') ),
                    "value" => "",
                    "type" => "text"
                ),
                "_content_" => array(
                    "title" => esc_html__("Quote content", 'trx_utils'),
                    "desc" => wp_kses_data( __("Quote content", 'trx_utils') ),
                    "rows" => 4,
                    "value" => "",
                    "type" => "textarea"
                ),
                "width" => sweet_dessert_shortcodes_width(),
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
if ( !function_exists( 'sweet_dessert_sc_quote_reg_shortcodes_vc' ) ) {
    function sweet_dessert_sc_quote_reg_shortcodes_vc() {

        vc_map( array(
            "base" => "trx_quote",
            "name" => esc_html__("Quote", 'trx_utils'),
            "description" => wp_kses_data( __("Quote text", 'trx_utils') ),
            "category" => esc_html__('Content', 'trx_utils'),
            'icon' => 'icon_trx_quote',
            "class" => "trx_sc_single trx_sc_quote",
            "content_element" => true,
            "is_container" => false,
            "show_settings_on_create" => true,
            "params" => array(
                array(
                    "param_name" => "cite",
                    "heading" => esc_html__("Quote cite", 'trx_utils'),
                    "description" => wp_kses_data( __("URL for the quote cite link", 'trx_utils') ),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "title",
                    "heading" => esc_html__("Title (author)", 'trx_utils'),
                    "description" => wp_kses_data( __("Quote title (author name)", 'trx_utils') ),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "bg_image",
                    "heading" => esc_html__("Background image URL", 'trx_utils'),
                    "description" => wp_kses_data( __("Select background image from library for this section", 'trx_utils') ),
                    "class" => "",
                    "value" => "",
                    "type" => "attach_image"
                ),
                array(
                    "param_name" => "content",
                    "heading" => esc_html__("Quote content", 'trx_utils'),
                    "description" => wp_kses_data( __("Quote content", 'trx_utils') ),
                    "class" => "",
                    "value" => "",
                    "type" => "textarea_html"
                ),
                sweet_dessert_get_vc_param('id'),
                sweet_dessert_get_vc_param('class'),
                sweet_dessert_get_vc_param('animation'),
                sweet_dessert_get_vc_param('css'),
                sweet_dessert_vc_width(),
                sweet_dessert_get_vc_param('margin_top'),
                sweet_dessert_get_vc_param('margin_bottom'),
                sweet_dessert_get_vc_param('margin_left'),
                sweet_dessert_get_vc_param('margin_right')
            ),
            'js_view' => 'VcTrxTextView'
        ) );

        class WPBakeryShortCode_Trx_Quote extends sweet_dessert_VC_ShortCodeSingle {}
    }
}
?>