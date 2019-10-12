<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'sweet_dessert_template_form_custom_theme_setup' ) ) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_template_form_custom_theme_setup', 1 );
	function sweet_dessert_template_form_custom_theme_setup() {
		sweet_dessert_add_template(array(
			'layout' => 'form_custom',
			'mode'   => 'forms',
			'title'  => esc_html__('Custom Form', 'sweet-dessert')
			));
	}
}

// Template output
if ( !function_exists( 'sweet_dessert_template_form_custom_output' ) ) {
	function sweet_dessert_template_form_custom_output($post_options, $post_data) {
		$form_style = sweet_dessert_get_theme_option('input_hover');
		?>
		<form <?php echo !empty($post_options['id']) ? ' id="'.esc_attr($post_options['id']).'_form"' : ''; ?>
			class="sc_input_hover_<?php echo esc_attr($form_style); ?>"
			data-formtype="<?php echo esc_attr($post_options['layout']); ?>" 
			method="post" 
			action="<?php echo esc_url($post_options['action'] ? $post_options['action'] : admin_url('admin-ajax.php')); ?>">
			<?php
            if(function_exists('sweet_dessert_sc_form_show_fields')) sweet_dessert_sc_form_show_fields($post_options['fields']);
			sweet_dessert_show_layout($post_options['content']);
			?>
			<div class="result sc_infobox"></div>
		</form>
		<?php
	}
}
?>