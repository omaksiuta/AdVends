<?php
function mayosis_import_files() {
    return array(
        array(
            'import_file_name'             => 'Main Demo(WP Bakery)',
            'categories'                   => array( 'Visual Composer' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'admin/demo/mainone/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'admin/demo/mainone/widget.json',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'admin/demo/mainone/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2018/07/01mayo2.jpg',
            'preview_url'                  => 'https://teconce.com/preview/mayosis/maindemo',
            'import_notice'              => __
            ( 'Before Setup Demo Please Install All Plugin Requireds.Intall Visual Composer as Page Builder.For Import You Need to wait 3-5 Mintues.', 'mayosis' ),
        ),


        array(
            'import_file_name'             => 'Main Demo(Elementor)',
            'categories'                   => array( 'Elementor' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'admin/demo/mainone/main-elementor.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'admin/demo/mainone/widget.json',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'admin/demo/mainone/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2018/07/01mayo2.jpg',
            'preview_url'                  => 'https://teconce.com/preview/mayosis/maindemo',
            'import_notice'              => __
            ( 'Before Setup Demo Please Install All Plugin Requireds.Intall Elementor as Page Builder.For Import You Need to wait 3-5 Mintues.', 'mayosis' ),
        ),
        
         array(
            'import_file_name'             => 'Mayo Photos Demo(WP Bakery)',
            'categories'                   => array( 'Visual Composer' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'admin/demo/mayophotos/main-vc.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'admin/demo/mayophotos/widget.wie',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'admin/demo/mayophotos/customizer.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2018/07/01mayo-2.jpg',
            'preview_url'                  => 'https://teconce.com/preview/mayosis/mayophoto/',
            'import_notice'              => __
            ( 'Before Setup Demo Please Install All Plugin Requireds.Intall WPbakery as Page Builder.For Import You Need to wait 3-5 Mintues.', 'mayosis' ),
        ),
        
         array(
            'import_file_name'             => 'Mayo Photos Demo(Elementor)',
            'categories'                   => array( 'Elementor' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'admin/demo/mayophotos/main-elementor.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'admin/demo/mayophotos/widget.wie',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'admin/demo/mayophotos/customizer-elementor.dat',
            'import_preview_image_url'     => 'https://teconce.files.wordpress.com/2018/07/01mayo-2.jpg',
            'preview_url'                  => 'https://teconce.com/preview/mayosis/mayophoto/',
            'import_notice'              => __
            ( 'Before Setup Demo Please Install All Plugin Requireds.Intall Elementor as Page Builder.For Import You Need to wait 3-5 Mintues.', 'mayosis' ),
        ),

    );
}
add_filter( 'pt-ocdi/import_files', 'mayosis_import_files' );



function mayosis_dialog_options ( $options ) {
    return array_merge( $options, array(
        'width'       => 300,
        'dialogClass' => 'wp-dialog',
        'resizable'   => false,
        'height'      => 'auto',
        'modal'       => true,
    ) );
}
add_filter( 'pt-ocdi/confirmation_dialog_options', 'mayosis_dialog_options', 10, 1 );
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

function mayosis_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'main-menu' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'mayosis_after_import_setup' );

?>