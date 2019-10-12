<?php
/**
 * generic content display
 */
  if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$category = get_the_category();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
 <!-- Begin Page Headings Layout -->
    <div class="archive_bredcrumb_header container-fluid">
        <div class="container">
            <h1 class="blog-page-title"><?php single_cat_title( __( '', 'mayosis' ) ); ?></h1>
            <?php if (function_exists('dm_breadcrumbs')) dm_breadcrumbs(); ?>

        </div>
    </div>
    <!-- End Page Headings Layout -->
    <!-- Begin Blog Main Post Layout -->
    <section class="container blog-main-content">
        <div class="row">
            <div class="main-post-body">
                <div class="col-md-8 col-sm-8 col-xs-12 main-post-block">
                    <div class="post-view-style">
                        <div class="col-md-5 col-xs-8 total-post-count">
                            <?php 
                            $count = $GLOBALS['wp_query']->found_posts;
                            $countall = $GLOBALS['wp_query']->post_count;
                            ?>
                            <p><?php esc_html_e('Showing','mayosis'); ?> <strong><?php echo esc_html($countall)?></strong>  <?php esc_html_e('of','mayosis'); ?> <strong><?php echo esc_html($count);?></strong> <?php _e('Blog Posts','mayosis'); ?></p>
                        </div>
                        <div class="col-md-7 col-xs-4  post-viewas">
							<ul  class="nav nav-pills">
			<li class="active">
        <a  href="#list" data-toggle="tab"><i class="fa fa-bars"></i></a>
			</li>
			<li><a href="#grid" data-toggle="tab"><i class="fa fa-th-large"></i></a>
			</li>
		</ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                   <div class="tab-content clearfix">
			 			 <div class="tab-pane active" id="list">
			 			  <?php get_template_part( 'content/content-archive-post-full' ); ?>
                    <?php mayosis_page_navs(); ?><!-- Blog Post-->
                    <!-- Blog Post-->
					   </div>
					   
					   
					    <div class="tab-pane" id="grid">
					    	 <?php get_template_part( 'content/content-archive-post-grid' ); ?>
					   <?php mayosis_page_navs(); ?>
                 </div>
            
					</div>
                    
                    

                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 blog-sidebar">
                <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				<?php endif; ?>
                
                <!--sidebar widget-->
            </div>
        </div>
    </section>
    <!-- End Blog Main Post Layout-->
    <div class="clearfix"></div>
	
</article>