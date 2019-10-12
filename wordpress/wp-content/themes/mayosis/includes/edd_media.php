 <?php if ( has_post_format( 'audio' )) { ?>
 <?php $mayosis_audio = get_post_meta($post->ID, 'audio_url',true); ?>
 <div class="mayosis-main-media">
<?php echo do_shortcode('[audio src="'.$mayosis_audio.'"]'); ?>
</div>
<?php } ?>
<?php if ( has_post_format( 'video' )) { ?>
<?php $mayosis_video = get_post_meta($post->ID, 'video_url',true); ?>
<div class="mayosis-main-media">
<?php echo do_shortcode('[video src="'.$mayosis_video.'"]'); ?>
</div>
<?php } ?>