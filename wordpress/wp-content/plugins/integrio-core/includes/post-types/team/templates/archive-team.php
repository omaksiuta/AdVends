<?php 

$defaults = array(
    'title' => '',
    'posts_per_line' => '3',
    'bg_color_type' => 'def',
    'grid_gap' => '30',
    'info_align' => 'left',
    'hide_content' => true,
    'single_link_wrapper' => true,
    // Query
    'number_of_posts' => 'all',
    'order_by' => 'date',
    'order' => 'ASC',
    'post_type' => 'team',
);
extract($defaults);

$style_gap = ($grid_gap != '0') ? ' style="margin-right:-'.esc_attr($grid_gap/2).'px; margin-left:-'.esc_attr($grid_gap/2).'px;"' : '';

$team_classes = 'team-col_'.$posts_per_line;
$team_classes .= ' a'.$info_align;

ob_start();
    render_wgl_team($defaults);
$team_items = ob_get_clean();


$output = '<div class="wgl-container">';
    $output .= '<div id="main-content">';
        $output .= '<div class="wgl_module_team '.esc_attr($team_classes).'">';
            $output .= '<div class="team-items_wrap"'.$style_gap.'>';
               $output .= $team_items;
            $output .= '</div>';
        $output .= '</div>';
    $output .= '</div>';
$output .= '</div>';


// Render
get_header();

echo Integrio_Theme_Helper::render_html($output);

get_footer();

?>