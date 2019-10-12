<?php
// Off Canvas Sidebar template
$babystreet_sidebar_choice = apply_filters('babystreet_has_offcanvas_sidebar', '');
?>

<?php if (function_exists('dynamic_sidebar') && $babystreet_sidebar_choice != 'none' && is_active_sidebar($babystreet_sidebar_choice)) : ?>
	<div class="sidebar off-canvas-sidebar">
		<a class="close-off-canvas" href="#"></a>
		<div class="off-canvas-wrapper">
			<?php dynamic_sidebar($babystreet_sidebar_choice); ?>
		</div>
	</div>
<?php endif; ?>