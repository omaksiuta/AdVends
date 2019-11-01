<?php
if(!class_exists('Integrio_Theme_Helper')){
    return;
}
/**
 * Class Team
 * @package PostType
 */
class Footer {
    /**
     * @var string
     *
     * Set post type params
     */
    private $type = 'footer';
    private $slug;
    private $name;
    private $plural_name;

    /**
     * Team constructor.
     *
     * When class is instantiated
     */
    public function __construct() {
        // Register the post type
        $this->name = __( 'Footer', 'integrio-core' );
        $this->slug = 'footer';
        $this->plural_name = __( 'Footers', 'integrio-core' );

        add_action('init', array($this, 'register'));
    }

    /**
     * Register post type
     */
    public function register() {
        $labels = array(
            'name'                  => $this->name,
            'singular_name'         => $this->name,
            'add_new'               => sprintf( __('Add New %s', 'integrio-core' ), $this->name ),
            'add_new_item'          => sprintf( __('Add New %s', 'integrio-core' ), $this->name ),
            'edit_item'             => sprintf( __('Edit %s', 'integrio-core'), $this->name ),
            'new_item'              => sprintf( __('New %s', 'integrio-core'), $this->name ),
            'all_items'             => sprintf( __('All %s', 'integrio-core'), $this->plural_name ),
            'view_item'             => sprintf( __('View %s', 'integrio-core'), $this->name ),
            'search_items'          => sprintf( __('Search %s', 'integrio-core'), $this->name ),
            'not_found'             => sprintf( __('No %s found' , 'integrio-core'), strtolower($this->name) ),
            'not_found_in_trash'    => sprintf( __('No %s found in Trash', 'integrio-core'), strtolower($this->name) ),
            'parent_item_colon'     => '',
            'menu_name'             => $this->name
        );
        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'rewrite'               => array( 'slug' => $this->slug ),
            'menu_position' =>  5,
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'menu_icon'  =>  'dashicons-admin-page',
        );
        register_post_type( $this->type, $args );
    }
}