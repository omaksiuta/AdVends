<?php
// Sidebar template
$babystreet_sidebar_choice = apply_filters('babystreet_has_sidebar', '');
?>

<?php if (function_exists('dynamic_sidebar') && $babystreet_sidebar_choice != 'none' && is_active_sidebar($babystreet_sidebar_choice) ) : ?>
	<div class="sidebar">
		<?php dynamic_sidebar($babystreet_sidebar_choice); ?>
	</div>
<?php endif;