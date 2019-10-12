<?php $mayosis_video = get_post_meta($post->ID, 'video_url',true); ?>
<a href="<?php echo esc_attr($mayosis_video); ?>" class="mayosis-play--button-video" data-lity>
           <i class="fas fa-play"></i>
        </a>
      