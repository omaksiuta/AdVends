<?php
/*
 * Partial for showing social site profiles
 */

/* Array holding the available social profiles: name => array( title => fa class name) */
$babystreet_social_profiles = array(
		'facebook' => array('title' => esc_html__('Follow on Facebook', 'babystreet'), 'class' => 'fa fa-facebook'),
		'twitter' => array('title' => esc_html__('Follow on Twitter', 'babystreet'), 'class' => 'fa fa-twitter'),
		'google' => array('title' => esc_html__('Follow on Google+', 'babystreet'), 'class' => 'fa fa-google-plus'),
		'youtube' => array('title' => esc_html__('Follow on YouTube', 'babystreet'), 'class' => 'fa fa-youtube-play'),
		'vimeo' => array('title' => esc_html__('Follow on Vimeo', 'babystreet'), 'class' => 'fa fa-vimeo-square'),
		'dribbble' => array('title' => esc_html__('Follow on Dribbble', 'babystreet'), 'class' => 'fa fa-dribbble'),
		'linkedin' => array('title' => esc_html__('Follow on LinkedIn', 'babystreet'), 'class' => 'fa fa-linkedin'),
		'stumbleupon' => array('title' => esc_html__('Follow on StumbleUpon', 'babystreet'), 'class' => 'fa fa-stumbleupon'),
		'flicker' => array('title' => esc_html__('Follow on Flickr', 'babystreet'), 'class' => 'fa fa-flickr'),
		'instegram' => array('title' => esc_html__('Follow on Instagram', 'babystreet'), 'class' => 'fa fa-instagram'),
		'pinterest' => array('title' => esc_html__('Follow on Pinterest', 'babystreet'), 'class' => 'fa fa-pinterest'),
		'vkontakte' => array('title' => esc_html__('Follow on VKontakte', 'babystreet'), 'class' => 'fa fa-vk'),
		'behance' => array('title' => esc_html__('Follow on Behance', 'babystreet'), 'class' => 'fa fa-behance')
);
?>
<div class="babystreet-social">
	<ul>
		<?php foreach ($babystreet_social_profiles as $babystreet_social_name => $babystreet_details): ?>
			<?php if (babystreet_get_option($babystreet_social_name . '_profile')): ?>
				<li><a title="<?php echo esc_attr($babystreet_details['title']) ?>" class="<?php echo esc_attr($babystreet_social_name) ?>" target="_blank"  href="<?php echo esc_url(babystreet_get_option($babystreet_social_name . '_profile')) ?>"><i class="<?php echo esc_attr($babystreet_details['class']) ?>"></i></a></li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</div>