<?php
$onepress_cta_id       = get_theme_mod( 'onepress_cta_id', 'section-cta' );
$onepress_cta_title    = get_theme_mod( 'onepress_cta_title', __('Use these ribbons to display calls to action mid-page.', 'onepress-plus' ));
$button_label = get_theme_mod( 'onepress_cta_btn_label', __('Button text', 'onepress-plus' ));
$button_link = get_theme_mod( 'onepress_cta_btn_link', '#' );
?>
<?php if ( ! onepress_is_selective_refresh() ){ ?>
<section <?php if ( $onepress_cta_id ) { ?>id="<?php echo esc_attr( $onepress_cta_id ); ?>" <?php } ?> class="<?php echo esc_attr( apply_filters( 'onepress_section_class', 'section-cta section-padding section-inverse onepage-section', 'cta' ) ); ?>">
<?php } ?>
    <?php do_action( 'onepress_section_before_inner', 'cta' ); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-9 cta-heading">
                <h2><?php echo wp_kses_post( $onepress_cta_title ); ?></h2>
            </div>
            <div class="col-md-12 col-lg-3 cta-button-area">
                <?php if ( $button_label ) { ?>
                    <a href="<?php echo esc_url( $button_link ); ?>" class="btn btn-theme-primary-outline"><?php echo esc_html( $button_label ); ?></a>
                <?php } ?>

            </div>
        </div>
    </div>

    <?php do_action( 'onepress_section_after_inner', 'cta' ); ?>
<?php if ( ! onepress_is_selective_refresh() ){ ?>
</section>
<?php } ?>
