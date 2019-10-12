<?php
/**
 * Register Sidebar
 */
function mayosis_register_sidebars() {
	/* Register Archive sidebar. */
	
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'mayosis' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'mayosis' ),
		'before_widget' => '<div id="%1$s" class="theme--sidebar--widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
  
	
	register_sidebar(
        array(
            'id' => 'page-sidebar',
            'name' => __( 'Page Sidebar', 'mayosis' ),
            'description' => __( 'Main Pages Sidebar.', 'mayosis' ),
            'before_widget' => '<div class="theme--sidebar--widget">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>'
        )
    );
	
	/* Register Single Post sidebar. */
    register_sidebar(
        array(
            'id' => 'single-post',
            'name' => __( 'Single Post Sidebar', 'mayosis' ),
            'description' => __( 'This is For Single Post Sidebar', 'mayosis' ),
            'before_widget' => '<div class="theme--sidebar--widget">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>'
        )
    );
	
    
    	/* Register Single Product Free sidebar. */
    register_sidebar(
        array(
            'id' => 'single-product',
            'name' => __( 'Single Product Sidebar', 'mayosis' ),
            'description' => __( 'This is For Single Product Sidebar', 'mayosis' ),
            'before_widget' => '<div class="theme--sidebar--widget">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>'
        )
    );
 
	 register_sidebar(
        array(
            'id' => 'hamburger',
            'name' => __( 'Hamburger', 'mayosis' ),
            'description' => __( 'This is For Hamburger Sidebar', 'mayosis' ),
            'before_widget' => '<div class="hamburger-sidebar">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>'
        )
    );
 
}
add_action( 'widgets_init', 'mayosis_register_sidebars' );
?>