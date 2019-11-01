<?php 


if (!class_exists( 'RWMB_Loader' )) {
	return;
}
class Integrio_Metaboxes{
	public function __construct(){
		// Team Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'team_meta_boxes' ) );

		// Portfolio Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'portfolio_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'portfolio_post_settings_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'portfolio_related_meta_boxes' ) );

		// Blog Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'blog_settings_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'blog_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'blog_related_meta_boxes' ));
		
		// Page Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_layout_meta_boxes' ) );
		// Colors Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_color_meta_boxes' ) );		
		// Logo Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_logo_meta_boxes' ) );		
		// Header Builder Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_header_meta_boxes' ) );
		// Title Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_title_meta_boxes' ) );
		// Side Panel Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_side_panel_meta_boxes' ) );		

		// Social Shares Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_soc_icons_meta_boxes' ) );	
		// Footer Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_footer_meta_boxes' ) );				
		// Copyright Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_copyright_meta_boxes' ) );		

		// Shop Single Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'shop_catalog_meta_boxes' ) );		
		add_filter( 'rwmb_meta_boxes', array( $this, 'shop_single_meta_boxes' ) );		
	}

	public function team_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Team Options', 'integrio' ),
	        'post_types' => array( 'team' ),
	        'context'    => 'advanced',
	        'fields'     => array(
	        	array(
		            'name' => esc_html__( 'Info Name Department', 'integrio' ),
		            'id'   => 'department_name',
		            'type' => 'text',
		            'class' => 'name-field'
		        ),       
	        	array(
		            'name' => esc_html__( 'Member Department', 'integrio' ),
		            'id'   => 'department',
		            'type' => 'text',
		            'class' => 'field-inputs'
				),
				array(
					'name' => esc_html__( 'Member Info', 'integrio' ),
		            'id'   => 'info_items',
		            'type' => 'social',
		            'clone' => true,
		            'sort_clone'     => true,
		            'options' => array(
						'name'    => array(
							'name' => esc_html__( 'Name', 'integrio' ),
							'type_input' => 'text'
						),
						'description' => array(
							'name' => esc_html__( 'Description', 'integrio' ),
							'type_input' => 'text'
						),
						'link' => array(
							'name' => esc_html__( 'Link', 'integrio' ),
							'type_input' => 'text'
						),
					),
		        ),		
		        array(
					'name'     => esc_html__( 'Social Icons', 'integrio' ),
					'id'          => "soc_icon",
					'type'        => 'select_icon',
					'options'     => WglAdminIcon()->get_icons_name(),
					'clone' => true,
					'sort_clone'     => true,
					'placeholder' => esc_html__( 'Select an icon', 'integrio' ),
					'multiple'    => false,
					'std'         => 'default',
				),
		        array(
					'name'             => esc_html__( 'Info Background Image', 'integrio' ),
					'id'               => "mb_info_bg",
					'type'             => 'file_advanced',
					'max_file_uploads' => 1,
					'mime_type'        => 'image',
				), 
	        ),
	    );
	    return $meta_boxes;
	}
	
	public function portfolio_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Portfolio Options', 'integrio' ),
	        'post_types' => array( 'portfolio' ),
	        'context'    => 'advanced',
	        'fields'     => array(
	        	array(
					'id'   => 'mb_portfolio_featured_img',
					'name' => esc_html__( 'Show Featured image on single', 'integrio' ),
					'type' => 'switch',
					'std'  => 'true',
				),        	
				array(
					'id'   => 'mb_portfolio_title',
					'name' => esc_html__( 'Show Title on single', 'integrio' ),
					'type' => 'switch',
					'std'  => 'true',
				),	
				array(
					'id'   => 'mb_portfolio_link',
					'name' => esc_html__( 'Add Custom Link for Portfolio Grid', 'integrio' ),
					'type' => 'switch',
				),
				array(
                    'name' => esc_html__( 'Custom Url for Portfolio Grid', 'integrio' ),
                    'id'   => 'portfolio_custom_url',
                    'type' => 'text',
					'class' => 'field-inputs',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_portfolio_link','=','1')
						), ),
					),
                ),
                array(
                    'id'   => 'portfolio_custom_url_target',
                    'name' => esc_html__( 'Open Custom Url in New Window', 'integrio' ),
                    'type' => 'switch',
                    'std' => 'true',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_portfolio_link','=','1')
						), ),
					),
                ),
				array(
					'name' => esc_html__( 'Info', 'integrio' ),
					'id'   => 'mb_portfolio_info_items',
					'type' => 'social',
					'clone' => true,
					'sort_clone' => true,
					'desc' => esc_html__( 'Description', 'integrio' ),
					'options' => array(
						'name'    => array(
							'name' => esc_html__( 'Name', 'integrio' ),
							'type_input' => 'text'
							),
						'description' => array(
							'name' => esc_html__( 'Description', 'integrio' ),
							'type_input' => 'text'
							),
						'link' => array(
							'name' => esc_html__( 'Url', 'integrio' ),
							'type_input' => 'text'
							),
					),
		        ),		
		        array(
					'name'     => esc_html__( 'Info Description', 'integrio' ),
					'id'       => "mb_portfolio_editor",
					'type'     => 'wysiwyg',
					'multiple' => false,
					'desc' => esc_html__( 'Info description is shown in one row with a main info', 'integrio' ),
				),			
		        array(
					'name'     => esc_html__( 'Categories On/Off', 'integrio' ),
					'id'       => "mb_portfolio_single_meta_categories",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'yes'     => esc_html__( 'On', 'integrio' ),
						'no'      => esc_html__( 'Off', 'integrio' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),			
		        array(
					'name'     => esc_html__( 'Date On/Off', 'integrio' ),
					'id'       => "mb_portfolio_single_meta_date",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'yes'     => esc_html__( 'On', 'integrio' ),
						'no'      => esc_html__( 'Off', 'integrio' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),			
		        array(
					'name'     => esc_html__( 'Tags On/Off', 'integrio' ),
					'id'       => "mb_portfolio_above_content_cats",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'yes'     => esc_html__( 'On', 'integrio' ),
						'no'      => esc_html__( 'Off', 'integrio' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),		
		        array(
					'name'     => esc_html__( 'Share Links On/Off', 'integrio' ),
					'id'       => "mb_portfolio_above_content_share",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'yes'     => esc_html__( 'On', 'integrio' ),
						'no'      => esc_html__( 'Off', 'integrio' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),	
	        ),
	    );
	    return $meta_boxes;
	}

	public function portfolio_post_settings_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Portfolio Post Settings', 'integrio' ),
	        'post_types' => array( 'portfolio' ),
	        'context'    => 'advanced',
	        'fields'     => array(
				array(
					'name'     => esc_html__( 'Post Layout', 'integrio' ),
					'id'       => "mb_portfolio_post_conditional",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'custom'  => esc_html__( 'Custom', 'integrio' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),        
				array(
					'name'     => esc_html__( 'Post Layout Settings', 'integrio' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_post_conditional','=','custom')
						)),
					),
				),
				array(
					'name'    => esc_html__( 'Post Content Layout', 'integrio' ),
					'id'      => "mb_portfolio_single_type_layout",
					'type'    => 'button_group',
					'options' => array(
						'1' => esc_html__( 'Title First', 'integrio' ),
						'2' => esc_html__( 'Image First', 'integrio' ),
						'3' => esc_html__( 'Overlay Image', 'integrio' ),
						'4' => esc_html__( 'Overlay Image with Info', 'integrio' ),
					),
					'multiple'   => false,
					'std'        => '1',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_portfolio_post_conditional','=','custom')
						), ),
					),
				), 
				array(
					'name'     => esc_html__( 'Alignment', 'integrio' ),
					'id'       => "mb_portfolio_single_align",
					'type'     => 'button_group',
					'options'  => array(
						'left' => esc_html__( 'Left', 'integrio' ),
						'center' => esc_html__( 'Center', 'integrio' ),
						'right' => esc_html__( 'Right', 'integrio' ),
					),
					'multiple'   => false,
					'std'        => 'center',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_portfolio_post_conditional','=','custom')
						), ),
					),
				), 
				array(
					'name' => esc_html__( 'Spacing', 'integrio' ),
					'id'   => 'mb_portfolio_single_padding',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_post_conditional','=','custom'),
							array('mb_portfolio_single_type_layout','!=','1'),
							array('mb_portfolio_single_type_layout','!=','2'),
						)),
					),
					'std' => array(
						'padding-top' => '165',
						'padding-bottom' => '165'
					)
				),
				array(
					'id'   => 'mb_portfolio_parallax',
					'name' => esc_html__( 'Add Portfolio Parallax', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_post_conditional','=','custom'),
							array('mb_portfolio_single_type_layout','!=','1'),
							array('mb_portfolio_single_type_layout','!=','2'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Prallax Speed', 'integrio' ),
					'id'   => "mb_portfolio_parallax_speed",
					'type' => 'number',
					'std'  => 0.3,
					'step' => 0.1,
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_post_conditional','=','custom'),
							array('mb_portfolio_single_type_layout','!=','1'),
							array('mb_portfolio_single_type_layout','!=','2'),
							array('mb_portfolio_parallax','=',true),
						)),
					),
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function portfolio_related_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Related Portfolio', 'integrio' ),
	        'post_types' => array( 'portfolio' ),
	        'context'    => 'advanced',
	        'fields'     => array(
				array(
					'id'      => 'mb_portfolio_related_switch',
					'name'    => esc_html__( 'Portfolio Related', 'integrio' ),
					'type'    => 'button_group',
					'options' => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'on' => esc_html__( 'On', 'integrio' ),
						'off' => esc_html__( 'Off', 'integrio' ),
					),
					'inline'   => true,
					'multiple' => false,
					'std'      => 'default'
				),
				array(
					'name'     => esc_html__( 'Portfolio Related Settings', 'integrio' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),
	        	array(
					'id'   => 'mb_pf_carousel_r',
					'name' => esc_html__( 'Display items carousel for this portfolio post', 'integrio' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Title', 'integrio' ),
					'id'   => "mb_pf_title_r",
					'type' => 'text',
					'std'  => esc_html__( 'Related Portfolio', 'integrio' ),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				), 			
				array(
					'name' => esc_html__( 'Categories', 'integrio' ),
					'id'   => "mb_pf_cat_r",
					'multiple'    => true,
					'type' => 'taxonomy_advanced',
					'taxonomy' => 'portfolio-category',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),     
				array(
					'name'    => esc_html__( 'Columns', 'integrio' ),
					'id'      => "mb_pf_column_r",
					'type'    => 'button_group',
					'options' => array(
						'2' => esc_html__( '2', 'integrio' ),
						'3' => esc_html__( '3', 'integrio' ),
						'4' => esc_html__( '4', 'integrio' ),
					),
					'multiple'   => false,
					'std'        => '3',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),  
				array(
					'name' => esc_html__( 'Number of Related Items', 'integrio' ),
					'id'   => "mb_pf_number_r",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 3,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function blog_settings_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Post Settings', 'integrio' ),
	        'post_types' => array( 'post' ),
	        'context'    => 'advanced',
	        'fields'     => array(       
				array(
					'name'     => esc_html__( 'Post Layout Settings', 'integrio' ),
					'type'     => 'wgl_heading',
				),
				array(
					'name'    => esc_html__( 'Post Layout', 'integrio' ),
					'id'      => "mb_post_layout_conditional",
					'type'    => 'button_group',
					'options' => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'custom'  => esc_html__( 'Custom', 'integrio' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),   	    
				array(
					'name'    => esc_html__( 'Post Layout Type', 'integrio' ),
					'id'      => "mb_single_type_layout",
					'type'    => 'button_group',
					'options' => array(
						'1' => esc_html__( 'Title First', 'integrio' ),
						'2' => esc_html__( 'Image First', 'integrio' ),
						'3' => esc_html__( 'Overlay Image', 'integrio' ),
					),
					'multiple' => false,
					'std'      => '1',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_post_layout_conditional','=','custom')
							),
						),
					),
				), 
				array(
					'name' => esc_html__( 'Spacing', 'integrio' ),
					'id'   => 'mb_single_padding_layout_3',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_post_layout_conditional','=','custom'),
							array('mb_single_type_layout','=','3'),
						)),
					),
					'std' => array(
						'padding-top' => '105',
						'padding-bottom' => '205'
					)
				),
				array(
					'id'   => 'mb_single_apply_animation',
					'name' => esc_html__( 'Apply Animation', 'integrio' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_post_layout_conditional','=','custom'),
							array('mb_single_type_layout','=','3'),
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Featured Image Settings', 'integrio' ),
					'type'     => 'wgl_heading',
				),  
				array(
					'name'    => esc_html__( 'Featured Image', 'integrio' ),
					'id'      => "mb_featured_image_conditional",
					'type'    => 'button_group',
					'options' => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'custom'  => esc_html__( 'Custom', 'integrio' ),
					),
					'multiple' => false,
					'std'      => 'default',
				), 
				array(
					'name'    => esc_html__( 'Featured Image Settings', 'integrio' ),
					'id'      => "mb_featured_image_type",
					'type'    => 'button_group',
					'options' => array(
						'off'  => esc_html__( 'Off', 'integrio' ),
						'replace'  => esc_html__( 'Replace', 'integrio' ),
					),
					'multiple' => false,
					'std'      => 'off',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_featured_image_conditional','=','custom')
							),
						),
					),
				),
				array(
					'name' => esc_html__( 'Featured Image Replace', 'integrio' ),
					'id'   => "mb_featured_image_replace",
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array('mb_featured_image_conditional','=','custom'),
							array( 'mb_featured_image_type', '=', 'replace' ),
						)),
					),
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function blog_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Post Format Layout', 'integrio' ),
			'post_types' => array( 'post' ),
			'context'    => 'advanced',
			'fields'     => array(
				// Standard Post Format
				array(
					'name'  => esc_html__( 'Standard Post( Enabled only Featured Image for this post format)', 'integrio' ),
					'id'    => "post_format_standard",
					'type'  => 'static-text',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('formatdiv','=','0')
						), ),
					),
				),
				// Gallery Post Format  
				array(
					'name'  => esc_html__( 'Gallery Settings', 'integrio' ),
					'type'  => 'wgl_heading',
				),  
				array(
					'name'  => esc_html__( 'Add Images', 'integrio' ),
					'id'    => "post_format_gallery",
					'type'  => 'image_advanced',
					'max_file_uploads' => '',
				),
				// Video Post Format
				array(
					'name' => esc_html__( 'Video Settings', 'integrio' ),
					'type' => 'wgl_heading',
				), 
				array(
					'name' => esc_html__( 'Video Style', 'integrio' ),
					'id'   => "post_format_video_style",
					'type' => 'select',
					'options' => array(
						'bg_video' => esc_html__( 'Background Video', 'integrio' ),
						'popup' => esc_html__( 'Popup', 'integrio' ),
					),
					'multiple' => false,
					'std'      => 'bg_video',
				),	
				array(
					'name' => esc_html__( 'Start Video', 'integrio' ),
					'id'   => "start_video",
					'type' => 'number',
					'std'  => '0',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('post_format_video_style','=','bg_video'),
						), ),
					),
				),				
				array(
					'name' => esc_html__( 'End Video', 'integrio' ),
					'id'   => "end_video",
					'type' => 'number',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('post_format_video_style','=','bg_video'),
						), ),
					),
				),	
				array(
					'name' => esc_html__( 'oEmbed URL', 'integrio' ),
					'id'   => "post_format_video_url",
					'type' => 'oembed',
				),
				// Quote Post Format
				array(
					'name' => esc_html__( 'Quote Settings', 'integrio' ),
					'type' => 'wgl_heading',
				), 
				array(
					'name' => esc_html__( 'Quote Text', 'integrio' ),
					'id'   => "post_format_qoute_text",
					'type' => 'textarea',
				),
				array(
					'name' => esc_html__( 'Author Name', 'integrio' ),
					'id'   => "post_format_qoute_name",
					'type' => 'text',
				),			
				array(
					'name' => esc_html__( 'Author Position', 'integrio' ),
					'id'   => "post_format_qoute_position",
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Author Avatar', 'integrio' ),
					'id'   => "post_format_qoute_avatar",
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
				),
				// Audio Post Format
				array(
					'name' => esc_html__( 'Audio Settings', 'integrio' ),
					'type' => 'wgl_heading',
				), 
				array(
					'name' => esc_html__( 'oEmbed URL', 'integrio' ),
					'id'   => "post_format_audio_url",
					'type' => 'oembed',
				),
				// Link Post Format
				array(
					'name' => esc_html__( 'Link Settings', 'integrio' ),
					'type' => 'wgl_heading',
				), 
				array(
					'name' => esc_html__( 'URL', 'integrio' ),
					'id'   => "post_format_link_url",
					'type' => 'url',
				),
				array(
					'name' => esc_html__( 'Text', 'integrio' ),
					'id'   => "post_format_link_text",
					'type' => 'text',
				),
			)
		);
		return $meta_boxes;
	}

	public function blog_related_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Related Blog Post', 'integrio' ),
	        'post_types' => array( 'post' ),
	        'context'    => 'advanced',
	        'fields'     => array(        	
				array(
					'id'   => 'mb_blog_show_r',
					'name' => esc_html__( 'Related On/Off', 'integrio' ),
					'type' => 'switch',
					'std'  => 1,
				),
				array(
					'name' => esc_html__( 'Related Settings', 'integrio' ),
					'type' => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_blog_show_r','=','1')
						)),
					),
				), 
				array(
					'name' => esc_html__( 'Title', 'integrio' ),
					'id'   => "mb_blog_title_r",
					'type' => 'text',
					'std'  => 'Related Posts',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_blog_show_r','=','1')
						), ),
					),
				), 			
				array(
					'name' => esc_html__( 'Categories', 'integrio' ),
					'id'   => "mb_blog_cat_r",
					'multiple'    => true,
					'type' => 'taxonomy_advanced',
					'taxonomy' => 'category',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_blog_show_r','=','1')
						), ),
					),
				),     
				array(
					'name' => esc_html__( 'Columns', 'integrio' ),
					'id'   => "mb_blog_column_r",
					'type' => 'button_group',
					'options' => array(
						'12' => esc_html__( '1', 'integrio' ),
						'6'  => esc_html__( '2', 'integrio' ),
						'4'  => esc_html__( '3', 'integrio' ),
						'3'  => esc_html__( '4', 'integrio' ),
					),
					'multiple'   => false,
					'std'        => '6',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_blog_show_r','=','1')
						), ),
					),
				),  
				array(
					'name' => esc_html__( 'Number of Related Items', 'integrio' ),
					'id'   => "mb_blog_number_r",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 2,
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_blog_show_r','=','1')
							),
						),
					),
				),
	        	array(
					'id'   => 'mb_blog_carousel_r',
					'name' => esc_html__( 'Display items carousel for this blog post', 'integrio' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_blog_show_r','=','1')
							),
						),
					),
				),  
	        ),
	    );
	    return $meta_boxes;
	}

	public function page_layout_meta_boxes( $meta_boxes ) {

	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Page Layout', 'integrio' ),
	        'post_types' => array( 'page' , 'post', 'team', 'practice','portfolio', 'product' ),
	        'context'    => 'advanced',
	        'fields'     => array(
				array(
					'name'    => esc_html__( 'Page Sidebar Layout', 'integrio' ),
					'id'      => "mb_page_sidebar_layout",
					'type'    => 'wgl_image_select',
					'options' => array(
						'default' => get_template_directory_uri() . '/core/admin/img/options/1c.png',
						'none'    => get_template_directory_uri() . '/core/admin/img/options/none.png',
						'left'    => get_template_directory_uri() . '/core/admin/img/options/2cl.png',
						'right'   => get_template_directory_uri() . '/core/admin/img/options/2cr.png',
					),
					'std'     => 'default',
				),
				array(
					'name'     => esc_html__( 'Sidebar Settings', 'integrio' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_sidebar_layout','!=','default'),
							array('mb_page_sidebar_layout','!=','none'),
						)),
					),
				),
				array(
					'name'        => esc_html__( 'Page Sidebar', 'integrio' ),
					'id'          => "mb_page_sidebar_def",
					'type'        => 'select',
					'placeholder' => 'Select a Sidebar',
					'options'     => integrio_get_all_sidebar(),
					'multiple'    => false,
					'attributes'  => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_sidebar_layout','!=','default'),
							array('mb_page_sidebar_layout','!=','none'),
						)),
					),
				),			
				array(
					'name'    => esc_html__( 'Page Sidebar Width', 'integrio' ),
					'id'      => "mb_page_sidebar_def_width",
					'type'    => 'button_group',
					'options' => array(	
						'9' => esc_html( '25%' ),
						'8' => esc_html( '33%' ),
					),
					'std'  => '9',
					'multiple'   => false,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_sidebar_layout','!=','default'),
							array('mb_page_sidebar_layout','!=','none'),
						)),
					),
				),
				array(
					'id'   => 'mb_sticky_sidebar',
					'name' => esc_html__( 'Sticky Sidebar On?', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_sidebar_layout','!=','default'),
							array('mb_page_sidebar_layout','!=','none'),
						)),
					),
				),
				array(
					'name'  => esc_html__( 'Sidebar Side Gap', 'integrio' ),
					'id'    => "mb_sidebar_gap",
					'type'  => 'select',
					'options' => array(	
						'def' => 'Default',
	                    '0'  => '0',     
	                    '15' => '15',     
	                    '20' => '20',     
	                    '25' => '25',     
	                    '30' => '30',     
	                    '35' => '35',     
	                    '40' => '40',     
	                    '45' => '45',     
	                    '50' => '50', 
					),
					'std'        => 'def',
					'multiple'   => false,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_sidebar_layout','!=','default'),
							array('mb_page_sidebar_layout','!=','none'),
						)),
					),
				),
	        )
	    );
	    return $meta_boxes;
	}

	public function page_color_meta_boxes( $meta_boxes ) {

	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Page Colors', 'integrio' ),
	        'post_types' => array( 'page' , 'post', 'team', 'practice','portfolio' ),
	        'context'    => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Page Colors', 'integrio' ),
					'id'       => "mb_page_colors_switch",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'custom'  => esc_html__( 'Custom', 'integrio' ),
					),
					'inline'   => true,
					'multiple' => false,
					'std'      => 'default',
				),
				array(
					'name' => esc_html__( 'Colors Settings', 'integrio' ),
					'type' => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch', '=', 'custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'General Theme Color', 'integrio' ),
	                'id'   => 'mb_page_theme_color',
	                'type' => 'color',
	                'std'  => '#0c5adb',
					'js_options' => array( 'defaultColor' => '#0c5adb' ),
	                'validate' => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch', '=', 'custom'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Body Background Color', 'integrio' ),
	                'id'   => 'mb_body_background_color',
	                'type' => 'color',
	                'std'  => '#ffffff',
					'js_options' => array( 'defaultColor' => '#ffffff' ),
	                'validate'  => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch', '=', 'custom'),
						)),
					),
	            ),
				array(
					'name'     => esc_html__( 'Gradient Settings', 'integrio' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch','=','custom')
						)),
					),
				),
				array(
					'id'   => 'mb_use-gradient',
					'name' => esc_html__( 'Use Theme Gradient?', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch','=','custom')
						)),
					),
				),
				array(
					'name'     	=> esc_html__( 'Theme Gradient From', 'integrio' ),
	                'id'        => 'mb_theme-gradient-from',
	                'type'      => 'color',
	                'std'         => '#0c1bae',
					'js_options' => array(
						'defaultColor' => '#0c1bae',
					),
	                'validate'  => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_use-gradient','=','1'),
						)),
					),
				),
				array(
					'name'     	=> esc_html__( 'Theme Gradient To', 'integrio' ),
	                'id'        => 'mb_theme-gradient-to',
	                'type'      => 'color',
	                'std'         => '#3486fe',
					'js_options' => array(
						'defaultColor' => '#3486fe',
					),
	                'validate'  => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_use-gradient','=','1'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Scroll Up Settings', 'integrio' ),
					'type' => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch', '=', 'custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Button Background Color', 'integrio' ),
	                'id'   => 'mb_scroll_up_bg_color',
	                'type' => 'color',
	                'std'  => '#fc7268',
					'js_options' => array( 'defaultColor' => '#fc7268' ),
	                'validate'  => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch', '=', 'custom'),
						)),
					),
	            ),				
	            array(
					'name' => esc_html__( 'Button Arrow Color', 'integrio' ),
	                'id'   => 'mb_scroll_up_arrow_color',
	                'type' => 'color',
	                'std'  => '#ffffff',
					'js_options' => array( 'defaultColor' => '#ffffff' ),
	                'validate'  => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch', '=', 'custom'),
						)),
					),
	            ),
	        )
	    );
	    return $meta_boxes;
	}

	public function page_logo_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Logo', 'integrio' ),
	        'post_types' => array( 'page', 'post' ),
	        'context'    => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Logo', 'integrio' ),
					'id'       => "mb_customize_logo",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'custom'  => esc_html__( 'Custom', 'integrio' ),
					),
					'multiple' => false,
					'inline'   => true,
					'std'      => 'default',
				),
				array(
					'name' => esc_html__( 'Logo Settings', 'integrio' ),
					'type' => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Header Logo', 'integrio' ),
					'id'   => "mb_header_logo",
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'id'   => 'mb_logo_height_custom',
					'name' => esc_html__( 'Enable Logo Height', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic' => array( array(
					    	array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Set Logo Height', 'integrio' ),
					'id'   => "mb_logo_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 50,
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array('mb_customize_logo','=','custom'),
							array('mb_logo_height_custom','=',true)
						)),
					),
				),
				array(
					'name' => esc_html__( 'Sticky Logo', 'integrio' ),
					'id'   => "mb_logo_sticky",
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'id'   => 'mb_sticky_logo_height_custom',
					'name' => esc_html__( 'Enable Sticky Logo Height', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
					    	array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Set Sticky Logo Height', 'integrio' ),
					'id'   => "mb_sticky_logo_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom'),
							array('mb_sticky_logo_height_custom','=',true),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Mobile Logo', 'integrio' ),
					'id'   => "mb_logo_mobile",
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'id'   => 'mb_mobile_logo_height_custom',
					'name' => esc_html__( 'Enable Mobile Logo Height', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
					    	array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Set Mobile Logo Height', 'integrio' ),
					'id'   => "mb_mobile_logo_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom'),
							array('mb_mobile_logo_height_custom','=',true),
						)),
					),
				),
	        )
	    );
	    return $meta_boxes;
	}	

	public function page_header_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Header', 'integrio' ),
	        'post_types' => array( 'page', 'post', 'portfolio', 'product' ),
	        'context' => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Header Settings', 'integrio' ),
					'id'          => "mb_customize_header_layout",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'default', 'integrio' ),
						'custom' => esc_html__( 'custom', 'integrio' ),
						'hide' => esc_html__( 'hide', 'integrio' ),
					),
					'multiple'    => false,
					'std'         => 'default',
				),
	        	array(
					'name'     => esc_html__( 'Header Builder', 'integrio' ),
					'id'          => "mb_customize_header",
					'type'        => 'select',
					'options'     => integrio_get_custom_preset(),
					'multiple'    => false,
					'std'         => 'default',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_header_layout','!=','hide')
						)),
					),
				),			
				// It is works 
				array(
					'id'   => 'mb_menu_header',
					'name' => esc_html__( 'Menu ', 'integrio' ),
					'type' => 'select',
					'options'     => integrio_get_custom_menu(),
					'multiple'    => false,
					'std'         => 'default',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_header_layout','=','custom')
						)),
					),
				),				
				// It is works 
				array(
					'id'   => 'mb_mobile_menu_header',
					'name' => esc_html__( 'Mobile Menu ', 'integrio' ),
					'type' => 'select',
					'options'     => integrio_get_custom_menu(),
					'multiple'    => false,
					'std'         => 'default',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_header_layout','=','custom')
						)),
					),
				),
				array(
					'id'   => 'mb_header_sticky',
					'name' => esc_html__( 'Sticky Header', 'integrio' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_header_layout','=','custom')
						)),
					),
				),
	        )
	    );
	    return $meta_boxes;
	}

	public function page_title_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Page Title', 'integrio' ),
			'post_types' => array( 'page', 'post', 'team', 'practice', 'portfolio', 'product' ),
			'context'    => 'advanced',
			'fields'     => array(
				array(
					'id'      => 'mb_page_title_switch',
					'name'    => esc_html__( 'Page Title', 'integrio' ),
					'type'    => 'button_group',
					'options' => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'on'      => esc_html__( 'On', 'integrio' ),
						'off'     => esc_html__( 'Off', 'integrio' ),
					),
					'std'      => 'default',
					'inline'   => true,
					'multiple' => false
				),
				array(
					'name' => esc_html__( 'Page Title Settings', 'integrio' ),
					'type' => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array( 
					'id'   => 'mb_page_title_bg_switch',
					'name' => esc_html__( 'Use Background?', 'integrio' ),
					'type' => 'switch',
					'std'  => true,
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=' ,'on' )
						)),
					),
				),
				array(
					'id'         => 'mb_page_title_bg',
					'name'       => esc_html__( 'Background', 'integrio' ),
					'type'       => 'wgl_background',
				    'image'      => '',
				    'position'   => 'center bottom',
				    'attachment' => 'scroll',
				    'size'       => 'cover',
				    'repeat'     => 'no-repeat',
					'color'      => '#2d2d2d',
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=', 'on' ),
							array( 'mb_page_title_bg_switch', '=', true ),
						)),
					),
				),			
				array( 
					'name' => esc_html__( 'Height', 'integrio' ),
					'id'   => 'mb_page_title_height',
					'type' => 'number',
					'std'  => 440,
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=', 'on' ),
							array( 'mb_page_title_bg_switch', '=', true ),
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Title Alignment', 'integrio' ),
					'id'       => 'mb_page_title_align',
					'type'     => 'button_group',
					'options'  => array(
						'left'   => esc_html__( 'left', 'integrio' ),
						'center' => esc_html__( 'center', 'integrio' ),
						'right'  => esc_html__( 'right', 'integrio' ),
					),
					'std'      => 'left',
					'multiple' => false,
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=' ,'on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Paddings Top/Bottom', 'integrio' ),
					'id'   => 'mb_page_title_padding',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => array(
						'padding-top'    => '97',
						'padding-bottom' => '100',
					),
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=' ,'on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Margin Bottom', 'integrio' ),
					'id'   => "mb_page_title_margin",
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'margin',
						'top'    => false,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => array( 'margin-bottom' => '40' ),
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array(
					'id'   => 'mb_page_title_border_switch',
					'name' => esc_html__( 'Border Top Switch', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Border Top Color', 'integrio' ),
					'id'   => 'mb_page_title_border_color',
					'type' => 'color',
					'std'  => '#e5e5e5',
					'js_options' => array(
						'defaultColor' => '#e5e5e5',
					),
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(						
							array('mb_page_title_border_switch','=',true)
						)),
					),
				),
				array(
					'id'   => 'mb_page_title_parallax',
					'name' => esc_html__( 'Parallax Switch', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Prallax Speed', 'integrio' ),
					'id'   => 'mb_page_title_parallax_speed',
					'type' => 'number',
					'std'  => 0.3,
					'step' => 0.1,
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array( 'mb_page_title_parallax','=',true ),
							array( 'mb_page_title_switch', '=', 'on' ),
						)),
					),
				),
				array(
					'id'   => 'mb_page_change_tile_switch',
					'name' => esc_html__( 'Custom Page Title', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title', 'integrio' ),
					'id'   => 'mb_page_change_tile',
					'type' => 'text',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array( 'mb_page_change_tile_switch','=','1' ),
							array( 'mb_page_title_switch', '=', 'on' ),
						)),
					),
				),
				array(
					'id'   => 'mb_page_title_breadcrumbs_switch',
					'name' => esc_html__( 'Show Breadcrumbs', 'integrio' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Breadcrumbs Alignment', 'integrio' ),
					'id'       => 'mb_page_title_breadcrumbs_align',
					'type'     => 'button_group',
					'options'  => array(
						'left' => esc_html__( 'left', 'integrio' ),
						'center' => esc_html__( 'center', 'integrio' ),
						'right' => esc_html__( 'right', 'integrio' ),
					),
					'std'      => 'left',
					'multiple' => false,
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch','=','on' ),
							array( 'mb_page_title_breadcrumbs_switch', '=', '1' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title Typography', 'integrio' ),
					'type' => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title Font', 'integrio' ),
					'id'   => 'mb_page_title_font',
					'type' => 'wgl_font',
					'options' => array(
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					),
					'std' => array(
						'font-size' => '48',
						'line-height' => '72',
						'color' => '#292929',
					),
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch', '=', 'on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title Breadcrumbs Font', 'integrio' ),
					'id'   => 'mb_page_title_breadcrumbs_font',
					'type' => 'wgl_font',
					'options' => array(
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					),
					'std' => array(
						'font-size' => '14',
						'line-height' => '24',
						'color' => '#9a9a9a',
					),
					'attributes' => array(
					    'data-conditional-logic' => array( array(
							array( 'mb_page_title_switch','=','on' )
						)),
					),
				),
				array(
					'name' => esc_html__( 'Responsive Layout', 'integrio' ),
					'type' => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),
				array(
					'id'   => 'mb_page_title_resp_switch',
					'name' => esc_html__( 'Responsive Layout On/Off', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Screen breakpoint', 'integrio' ),
					'id'   => 'mb_page_title_resp_resolution',
					'type' => 'number',
					'std'  => 768,
					'min'  => 1,
					'step' => 1,
				    'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Height', 'integrio' ),
					'id'   => 'mb_page_title_resp_height',
					'type' => 'number',
					'std'  => 230,
					'min'  => 0,
					'step' => 1,
				    'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Padding Top/Bottom', 'integrio' ),
					'id'   => 'mb_page_title_resp_padding',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => array(
						'padding-top'    => '15',
						'padding-bottom' => '40',
					),
				    'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title Font', 'integrio' ),
					'id'   => 'mb_page_title_resp_font',
					'type' => 'wgl_font',
					'options' => array(
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					),
					'std' => array(
						'font-size' => '42',
						'line-height' => '72',
						'color' => '#292929',
					),
				    'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
						)),
					),
				),
				array(
					'id'   => 'mb_page_title_resp_breadcrumbs_switch',
					'name' => esc_html__( 'Show Breadcrumbs', 'integrio' ),
					'type' => 'switch',
					'std'  => 1,
				    'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title Breadcrumbs Font', 'integrio' ),
					'id'   => 'mb_page_title_resp_breadcrumbs_font',
					'type' => 'wgl_font',
					'options' => array(
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					),
					'std' => array(
						'font-size' => '14',
						'line-height' => '24',
						'color' => '#9a9a9a',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
							array('mb_page_title_resp_breadcrumbs_switch','=','1'),
						)),
					),
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function page_side_panel_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Side Panel', 'integrio' ),
	        'post_types' => array( 'page' ),
	        'context' => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Side Panel', 'integrio' ),
					'id'       => "mb_customize_side_panel",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'custom' => esc_html__( 'Custom', 'integrio' ),
					),
					'multiple' => false,
					'inline'   => true,
					'std'      => 'default',
				),
				array(
					'name'     => esc_html__( 'Side Panel Settings', 'integrio' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_side_panel','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Text Color', 'integrio' ),
					'id'   => "mb_side_panel_text_color",
					'type' => 'color',
					'std'  => '#313538',
					'js_options' => array(
						'defaultColor' => '#313538',
					),
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(						
							array('mb_customize_side_panel','=','custom')
						)),
					),
				),				
				array(
					'name' => esc_html__( 'Background Color', 'integrio' ),
					'id'   => "mb_side_panel_bg",
					'type' => 'color',
					'std'  => '#ffffff',
					'alpha_channel' => true,
					'js_options' => array(
						'defaultColor' => '#ffffff',
					),
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(						
							array('mb_customize_side_panel','=','custom')
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Text Align', 'integrio' ),
					'id'       => "mb_side_panel_text_alignment",
					'type'     => 'button_group',
					'options'  => array(
						'left' => esc_html__( 'Left', 'integrio' ),
						'center' => esc_html__( 'Center', 'integrio' ),
						'right' => esc_html__( 'Right', 'integrio' ),
					),
					'multiple'   => false,
					'std'        => 'center',
					'attributes' => array(
						'data-conditional-logic' => array( array(
							array('mb_customize_side_panel','=','custom')
						), ),
					),
				),
				array(
					'name' => esc_html__( 'Width', 'integrio' ),
					'id'   => "mb_side_panel_width",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 480,
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(						
							array('mb_customize_side_panel','=','custom')
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Position', 'integrio' ),
					'id'          => "mb_side_panel_position",
					'type'        => 'button_group',
					'options'     => array(
						'left' => esc_html__( 'Left', 'integrio' ),
						'right' => esc_html__( 'Right', 'integrio' ),
					),
					'multiple'    => false,
					'std'         => 'right',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_customize_side_panel','=','custom')
							),
						),
					),
				),
	        )
	    );
	    return $meta_boxes;
	}	

	public function page_soc_icons_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Social Shares', 'integrio' ),
	        'post_types' => array( 'page' ),
	        'context' => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Social Shares', 'integrio' ),
					'id'          => "mb_customize_soc_shares",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'on' => esc_html__( 'On', 'integrio' ),
						'off' => esc_html__( 'Off', 'integrio' ),
					),
					'multiple'    => false,
					'inline'    => true,
					'std'         => 'default',
				),
				array(
					'name'     => esc_html__( 'Choose your share style.', 'integrio' ),
					'id'          => "mb_soc_icon_style",
					'type'        => 'button_group',
					'options'     => array(
						'standard' => esc_html__( 'Standard', 'integrio' ),
						'hovered' => esc_html__( 'Hovered', 'integrio' ),
					),
					'multiple'    => false,
					'std'         => 'standard',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),				
				array(
					'id'   => 'mb_soc_icon_position',
					'name' => esc_html__( 'Fixed Position On/Off', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),
				array( 
					'name' => esc_html__( 'Offset Top(in percentage)', 'integrio' ),
					'id'   => 'mb_soc_icon_offset',
					'type' => 'number',
					'std'  => 50,
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
					'desc' => esc_html__( 'Measurement units defined as "percents" while position fixed is enabled, and as "pixels" while position is off.', 'integrio' ),
				),
				array(
					'id'   => 'mb_soc_icon_facebook',
					'name' => esc_html__( 'Facebook Share On/Off', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),				
				array(
					'id'   => 'mb_soc_icon_twitter',
					'name' => esc_html__( 'Twitter Share On/Off', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),				
				array(
					'id'   => 'mb_soc_icon_linkedin',
					'name' => esc_html__( 'Linkedin Share On/Off', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),						
				array(
					'id'   => 'mb_soc_icon_pinterest',
					'name' => esc_html__( 'Pinterest Share On/Off', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),				
				array(
					'id'   => 'mb_soc_icon_tumblr',
					'name' => esc_html__( 'Tumblr Share On/Off', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),
				
	        )
	    );
	    return $meta_boxes;
	}

	public function page_footer_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Footer', 'integrio' ),
	        'post_types' => array( 'page' ),
	        'context'    => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Footer', 'integrio' ),
					'id'       => "mb_footer_switch",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'on'      => esc_html__( 'On', 'integrio' ),
						'off'     => esc_html__( 'Off', 'integrio' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
				array(
					'name'     => esc_html__( 'Footer Settings', 'integrio' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				), 
				array(
					'id'   => 'mb_footer_add_wave',
					'name' => esc_html__( 'Add Wave', 'integrio' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Set Wave Height', 'integrio' ),
					'id'   => "mb_footer_wave_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 158,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
					    	array('mb_footer_switch','=','on'),
							array('mb_footer_add_wave','=','1')
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Content Type', 'integrio' ),
					'id'       => 'mb_footer_content_type',
					'type'     => 'button_group',
					'options'  => array(
						'widgets' => esc_html__( 'Default', 'integrio' ),
						'pages'   => esc_html__( 'Page', 'integrio' )		
					),
					'multiple' => false,
					'std'      => 'widgets',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				),
				array(
	        		'name'        => 'Select a page',
					'id'          => 'mb_footer_page_select',
					'type'        => 'post',
					'post_type'   => 'footer',
					'field_type'  => 'select_advanced',
					'placeholder' => 'Select a page',
					'query_args'  => array(
					    'post_status'    => 'publish',
					    'posts_per_page' => - 1,
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on'),
							array('mb_footer_content_type','=','pages')
						)),
					),
	        	),
				array(
					'name' => esc_html__( 'Paddings', 'integrio' ),
					'id'   => 'mb_footer_spacing',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => true,
						'bottom' => true,
						'left'   => true,
					),
					'std' => array(
						'padding-top'    => '90',
						'padding-right'  => '0',
						'padding-bottom' => '10',
						'padding-left'   => '0'
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				),	
				array(
					'name'       => esc_html__( 'Background', 'integrio' ),
					'id'         => "mb_footer_bg",
					'type'       => 'wgl_background',
				    'image'      => '',
				    'position'   => 'center center',
				    'attachment' => 'scroll',
				    'size'       => 'cover',
				    'repeat'     => 'no-repeat',			
					'color'      => '#2e323e',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				),				
	        ),
	     );
	    return $meta_boxes;
	}	

	public function page_copyright_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Copyright', 'integrio' ),
	        'post_types' => array( 'page' ),
	        'context' => 'advanced',
	        'fields'     => array(
				array(
					'name'     => esc_html__( 'Copyright', 'integrio' ),
					'id'          => "mb_copyright_switch",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'on' => esc_html__( 'On', 'integrio' ),
						'off' => esc_html__( 'Off', 'integrio' ),
					),
					'multiple'    => false,
					'std'         => 'default',
				),
				array(
					'name'     => esc_html__( 'Copyright Settings', 'integrio' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_copyright_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Editor', 'integrio' ),
					'id'   => "mb_copyright_editor",
					'type' => 'textarea',
					'cols' => 20,
					'rows' => 3,
					'std'  => 'Copyright © 2019 Integrio by WebGeniusLab. All Rights Reserved',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(						
							array('mb_copyright_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Text Color', 'integrio' ),
					'id'   => "mb_copyright_text_color",
					'type' => 'color',
					'std'  => '#838383',
					'js_options' => array(
						'defaultColor' => '#838383',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(						
							array('mb_copyright_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Background Color', 'integrio' ),
					'id'   => "mb_copyright_bg_color",
					'type' => 'color',
					'std'  => '#171a1e',
					'js_options' => array(
						'defaultColor' => '#171a1e',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(						
							array('mb_copyright_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Paddings', 'integrio' ),
					'id'   => 'mb_copyright_spacing',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => array(
						'padding-top'    => '10',
						'padding-bottom' => '10',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_copyright_switch','=','on')
						)),
					),
				),
	        ),
	     );
	    return $meta_boxes;

	}

	public function shop_catalog_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Catalog Options', 'integrio' ),
	        'post_types' => array( 'product' ),
	        'context'    => 'advanced',
	        'fields'     => array(
	        	array(
					'id'   => 'mb_product_carousel',
					'name' => esc_html__( 'Product Carousel', 'integrio' ),
					'type' => 'switch',
					'std'  => '',
				),       
	        ),
	    );
	    return $meta_boxes;
	}

	public function shop_single_meta_boxes( $meta_boxes ) {

	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Post Settings', 'integrio' ),
	        'post_types' => array( 'product' ),
	        'context' => 'advanced',
	        'fields'     => array(
				array(
					'name'     => esc_html__( 'Post Layout', 'integrio' ),
					'id'          => "mb_product_layout",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'integrio' ),
						'custom' => esc_html__( 'Custom', 'integrio' ),
					),
					'multiple'    => false,
					'std'         => 'default',
				),
				array(
					'name'     => esc_html__( 'Product Layout Settings', 'integrio' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_product_layout','=','custom')
						)),
					),
				),  
				
				array(		
					'name'     => esc_html__( 'Single Image Layout', 'integrio' ),
					'id'          => "mb_shop_single_image_layout",
					'type'        => 'wgl_image_select',
					'placeholder' => 'Select a Single Layout',
					'options'     => array(
						'default' => get_template_directory_uri() . '/core/admin/img/options/1c.png',
						'sticky_layout'    => get_template_directory_uri() . '/core/admin/img/options/none.png',
						'image_gallery'    => get_template_directory_uri() . '/core/admin/img/options/2cl.png',
						'full_width_image_gallery' => get_template_directory_uri() . '/core/admin/img/options/2cr.png',
						'with_background'   => get_template_directory_uri() . '/core/admin/img/options/2cr.png',
					),
					'std'         => 'default',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_product_layout','=','custom')
						)),
					),				
				),       
				array(
					'id'   => 'mb_shop_layout_with_background',
					'name' => esc_html__( 'Background', 'integrio' ),
					'type' => 'color',
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array('mb_product_layout','=','custom'),
							array('mb_shop_single_image_layout','=','with_background'),
						)),
					),
					'js_options' => array(
						'defaultColor' => '#f3f3f3',
					),
					'std'         => '#f3f3f3',
					'validate'  => 'color',
				),
	        ),
	    );
	    return $meta_boxes;
	}

}
new Integrio_Metaboxes();

?>