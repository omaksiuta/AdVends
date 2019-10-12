<?php
$onepress_map_id    = get_theme_mod( 'onepress_map_id', 'map' );
$map_data                = array();
$map_data['lat']         = floatval( get_theme_mod( 'onepress_map_lat', '37.3317115' ) );
$map_data['long']        = floatval( get_theme_mod( 'onepress_map_long', '-122.0301835' ) );
$map_data['address']     = get_theme_mod( 'onepress_map_address', '<strong>1 Infinite Loop Cupertino <br/> CA 95014  United States</strong>' );
$map_data['html']        = get_theme_mod( 'onepress_map_html', do_shortcode( '<p>Your address description goes here.</p>' ) );
$map_data['color']       = get_theme_mod( 'onepress_map_color', '' );

$map_data['maker']       = get_theme_mod( 'onepress_map_maker', ONEPRESS_PLUS_URL.'assets/images/map-marker.png' );
$maker_id = attachment_url_to_postid( $map_data['maker'] );
if ( $maker_id ) {
    $meta_data =  wp_get_attachment_metadata( OnePress_PLus::get_media_id( $maker_id ), true );
    if ( $meta_data ) {
        $map_data['maker_w'] = $meta_data['width'];
        $map_data['maker_h'] = $meta_data['height'];
    }
}

$map_data['zoom']        = floatval( get_theme_mod( 'onepress_map_zoom', 10 ) );
$map_data['scrollwheel'] = intval( get_theme_mod( 'onepress_map_scrollwheel' ) ) == 1 ? true : false;
$map_data['items_address'] = array();
$address =  get_theme_mod( 'onepress_map_items_address' );
if ( is_string( $address ) ) {
    $map_data['items_address'] = json_decode( $address , true );
}
if( ! is_array( $address ) ) {
    $address = array();
}

foreach ( $address as $k => $a ) {
    $map_data['items_address'][ $k ][ 'maker' ] = OnePress_PLus::get_media_url( $a['maker'] );
    $map_data['items_address'][ $k ][ 'lat' ] = floatval ( $a['lat'] );
    $map_data['items_address'][ $k ][ 'long' ] = floatval( $a['long'] );
    $map_data['items_address'][ $k ][ 'address' ] = $a['address'];
    $map_data['items_address'][ $k ][ 'desc' ] = $a['desc'];

    $meta_data =  wp_get_attachment_metadata( OnePress_PLus::get_media_id( $a['maker'] ), true );
    if ( $meta_data ) {
        $map_data['items_address'][ $k ][ 'w' ] = $meta_data['width'];
        $map_data['items_address'][ $k ][ 'h' ] = $meta_data['height'];
    }

}

$height = get_theme_mod( 'onepress_map_height', 400 );
if ( absint( $height ) <= 0 ) {
    $height =  400;
}
?>
<section <?php if ( $onepress_map_id ) { ?>id="<?php echo esc_attr( $onepress_map_id ); ?>" <?php } ?> <?php do_action( 'onepress_section_atts', 'map' ); ?>  class="<?php echo esc_attr( apply_filters( 'onepress_section_class', 'section-map  onepage-section', 'map' ) ); ?>">
    <?php do_action( 'onepress_section_before_inner', 'map' ); ?>
        <div class="onepress-map" data-map="<?php echo esc_attr( json_encode( $map_data ) ); ?>" style="height: <?php echo absint( $height ); ?>px; display: block;"></div>
    <?php do_action( 'onepress_section_after_inner', 'map' ); ?>
</section>
