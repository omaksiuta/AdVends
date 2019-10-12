<?php

$babystreet_search_params = array(
	'placeholder'  	=> esc_attr__('Search','babystreet'),
	'search_id'	   	=> 's',
	'form_action'	=> babystreet_wpml_get_home_url(),
	'ajax_disable'	=> false
);

?>

<form action="<?php echo esc_url($babystreet_search_params['form_action']); ?>" id="searchform" method="get">
	<div>
		<input type="submit" id="searchsubmit"  value="<?php esc_attr_e('Search', 'babystreet') ?>"/>
		<input type="text" id="s" name="<?php echo esc_attr($babystreet_search_params['search_id']); ?>" value="<?php if(!empty($_GET['s'])) echo esc_attr(get_search_query()); ?>" placeholder='<?php echo esc_attr($babystreet_search_params['placeholder']); ?>' />
        <small class="babystreet-search-hint-text"><?php echo esc_html__('Type and hit Enter to Search', 'babystreet') ?></small>
	</div>
</form>