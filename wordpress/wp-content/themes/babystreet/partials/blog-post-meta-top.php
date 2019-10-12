<?php
/**
 * Created by PhpStorm.
 * User: aatanasov
 * Date: 4/28/2017
 * Time: 4:06 PM
 */
?>
<div class="blog-post-meta post-meta-top">
	<?php if ( $babystreet_categories = get_the_category() ): ?>
        <span class="posted_in"><i class="fa fa-folder-open"></i>
			<?php $babystreet_lastElmnt = end( $babystreet_categories ); ?>
			<?php foreach ( $babystreet_categories as $babystreet_category ): ?>
                <a href="<?php echo esc_url( get_category_link( $babystreet_category->term_id ) ) ?>"
                   title="<?php echo sprintf( esc_attr__( "View all posts in %s", 'babystreet' ), esc_attr( $babystreet_category->name ) ) ?>"><?php echo esc_html( $babystreet_category->name ) ?></a><?php if ( $babystreet_category != $babystreet_lastElmnt ): ?>,<?php endif; ?>
			<?php endforeach; ?>
				</span>
	<?php endif; ?>
	<?php if ( ! isset( $babystreet_is_latest_posts ) ): ?>
		<?php the_tags( '<i class="fa fa-tags"></i> ' ); ?>
        <span class="count_comments"><i class="fa fa-comments"></i> <a
                    href="<?php echo esc_url( get_comments_link() ) ?>"
                    title="<?php esc_attr_e("View comments", "babystreet")?>"><?php echo get_comments_number() ?></a></span>
	<?php endif; ?>
</div>