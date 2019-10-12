<?php

if (function_exists("register_field_group"))
	{
	register_field_group(array(
		'id' => 'acf_slider-options',
		'title' => 'Slider Options',
		'fields' => array(
			array(
				'key' => 'field_591b07efffe43',
				'label' => 'Slider Description',
				'name' => 'slider_description',
				'type' => 'wysiwyg',
				'default_value' => 'High End Graphic Templates & Resources such as Graphic Objects, Add Ons, PSD Templates, Photo Packs, Backgrounds, UI Kits and so on...
			Browse, Download & Use Our Resources To Design Faster & Get Your Payment Quicker!',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			) ,
			array(
				'key' => 'field_591b08f2342c5',
				'label' => 'Button A Text',
				'name' => 'button_a_text',
				'type' => 'text',
				'default_value' => 'Browse Freebie',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			) ,
			array(
				'key' => 'field_591b099ca0fe8',
				'label' => 'Button B Text',
				'name' => 'button_b_text',
				'type' => 'text',
				'default_value' => 'Premium Product',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			) ,
			array(
				'key' => 'field_591b09f0a4ef9',
				'label' => 'Button A Url',
				'name' => 'button_a_url',
				'type' => 'text',
				'default_value' => '#',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			) ,
			array(
				'key' => 'field_591b0a1afabee',
				'label' => 'Button B Url ',
				'name' => 'button_b_url',
				'type' => 'text',
				'default_value' => '#',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			) ,
			array(
				'key' => 'field_591b0ac9c976e',
				'label' => 'Enable/Disable or Separator',
				'name' => 'disable_or_section',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			) ,
		) ,
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'slider',
					'order_no' => 0,
					'group_no' => 0,
				) ,
			) ,
		) ,
		'options' => array(
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array() ,
		) ,
		'menu_order' => 0,
	));
	register_field_group(array(
		'id' => 'acf_testimonial-options',
		'title' => 'Testimonial Options',
		'fields' => array(
			array(
				'key' => 'field_591b353a56171',
				'label' => 'Pre Title',
				'name' => 'pre_title',
				'type' => 'text',
				'default_value' => 'We Have Been Called',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			) ,
			array(
				'key' => 'field_591b354e0f792',
				'label' => 'Testimonial Author Name',
				'name' => 'testimonial_author_name',
				'type' => 'text',
				'default_value' => 'Ronald J. Oswald',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			) ,
			array (
			'key' => 'field_594ba1640454d',
			'label' => 'Testimonial Author Job Title',
			'name' => 'testimonial_author_job_title',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Lorem Studio Inc',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
			array(
				'key' => 'field_59131ca01bbf3',
				'label' => 'Testimonial Small Description( For Grid Style Only)',
				'name' => 'testimonial_small_description(_for_grid_style_only)',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			) ,
		) ,
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'testimonial',
					'order_no' => 0,
					'group_no' => 0,
				) ,
			) ,
		) ,
		'options' => array(
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array() ,
		) ,
		'menu_order' => 0,
	));
	acf_add_local_field_group(array(
		'key' => 'group_59246033cb254',
		'title' => 'Contact Page Option',
		'fields' => array(
			array(
				'key' => 'field_59252cf2f09e1',
				'label' => 'Contact Form Text &	Shortcode',
				'name' => 'contact_form_shortcode',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				) ,
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 1,
			) ,
		) ,
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				) ,
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'contact.php',
				) ,
			) ,
		) ,
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
	));
	
	
	acf_add_local_field_group(array(
		'key' => 'group_593858f7d224e',
		'title' => 'License Block Options',
		'fields' => array(
			array(
				'key' => 'field_59460a57c5b1a',
				'label' => 'License Type',
				'name' => 'licence_type',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => 50,
					'class' => '',
					'id' => '',
				) ,
				'choices' => array(
					'youcan' => 'You Can',
					'youcannot' => 'You Can Not',
				) ,
				'default_value' => array(
					'youcan' => 'youcan',
				) ,
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			) ,
			array(
				'key' => 'field_59460a88c5b1b',
				'label' => 'License Table(You Can)',
				'name' => 'licence_table_(you_can)',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_59460a57c5b1a',
							'operator' => '==',
							'value' => 'youcan',
						) ,
					) ,
				) ,
				'wrapper' => array(
					'width' => 50,
					'class' => '',
					'id' => '',
				) ,
				'min' => '',
				'max' => '',
				'layout' => 'table',
				'button_label' => 'Add License Item',
				'sub_fields' => array(
					array(
						'key' => 'field_59460abfc5b1c',
						'label' => 'Details Text',
						'name' => 'details_text',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						) ,
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
					) ,
				) ,
			) ,
			array(
				'key' => 'field_59460ba0d4b0c',
				'label' => 'License Table(You Can Not)',
				'name' => 'licence_table_(you_can_not)',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_59460a57c5b1a',
							'operator' => '==',
							'value' => 'youcannot',
						) ,
					) ,
				) ,
				'wrapper' => array(
					'width' => 50,
					'class' => '',
					'id' => '',
				) ,
				'min' => '',
				'max' => '',
				'layout' => 'table',
				'button_label' => 'Add License Item',
				'sub_fields' => array(
					array(
						'key' => 'field_59460ba0d4b0d',
						'label' => 'Details Text',
						'name' => 'details_text',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						) ,
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
					) ,
				) ,
			) ,
		) ,
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'licence',
				) ,
			) ,
		) ,
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
	));
	}
	
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5abdc49e47321',
	'title' => 'Menu Icon',
	'fields' => array(
		array(
			'key' => 'field_5abdc4a5cea77',
			'label' => 'Menu Icon',
			'name' => 'menu_icon',
			'type' => 'text',
			'instructions' => 'Add icon Class Form Fontawesome(fontawesome.com/icons). i.e (fab fa-500px)',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'nav_menu_item',
				'operator' => '==',
				'value' => 'all',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;
?>