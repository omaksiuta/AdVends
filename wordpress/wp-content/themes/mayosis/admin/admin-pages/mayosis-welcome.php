<?php
function mayosis_let_to_num( $size ) {
  $l   = substr( $size, -1 );
  $ret = substr( $size, 0, -1 );
  switch ( strtoupper( $l ) ) {
    case 'P':
      $ret *= 1024;
    case 'T':
      $ret *= 1024;
    case 'G':
      $ret *= 1024;
    case 'M':
      $ret *= 1024;
    case 'K':
      $ret *= 1024;
  }
  return $ret;
}

?>

<div class="wrap about-wrap mayosis-wrap">
    <h1><?php _e( 'Welcome to Mayosis Dashboard!', 'mayosis' ); ?></h1>

    <div class="about-text"><?php echo esc_html__( 'mayosis theme is now installed and ready to use!', 'mayosis' ); ?></div>

    <h2 class="nav-tab-wrapper">
        <?php
        printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', __( 'Welcome', 'mayosis' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'customize.php' ), __( 'Theme Options', 'mayosis' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'themes.php?page=pt-one-click-demo-import' ), __( 'Demo Import', 'mayosis' ) );
        ?>
    </h2>
    
   
    <div class="mayosis-section nav-tab-active">
        <p class="about-description">
            <?php printf( __( 'Before you get started, please be sure to always check out documentation Which Included In the theme folder or from <a href="https://teconce.com/help/docs/mayosis/" target="_blank">Website</a>. We outline all kinds of good information and provide you with all the details you need to use mayosis.', 'mayosis')); ?>
        </p>
        <p class="about-description">
            <?php printf( __( 'If you are unable to find your answer in our documentation, please contact us via  <a href="https://teconce.com/help/submit-a-ticket/" target="_blank">submit a ticket</a> with your purchase code, site CPanel, and admin login info.', 'mayosis'), 'mailto:hello@teconce.com'); ?>
        </p>
        <p class="about-description">
            <?php printf( __( 'We are very happy to help you and you will get the reply from us  faster than you expected.', 'mayosis'), 'https://teconce.com/mayosis-documentation/'); ?>
        </p>
        
        <p class="about-description">
            <?php printf( __( 'Note: Please Install All Required Plugins Before Install Demo !', 'mayosis'), 'https://teconce.com/mayosis-documentation/'); ?>
        </p>
    </div>
    <div class="mayosis-thanks">
        <p class="description">Thank you for using <strong>mayosis</strong> theme! Powered by <a href="https://teconce.com" target="_blank">Teconce</a></p>
    </div>
    <div class="mayosis-system-stats">
        <h3>System Status</h3>

    <table class="system-status-table">
        <tbody>
       <tr>
							<td><?php esc_html_e( 'WP Version', 'mayosis' ); ?></td>
							<td><?php bloginfo('version'); ?></td>
						</tr>
						
						<tr>
							<td><?php esc_html_e( 'Language', 'mayosis' ); ?></td>
							<td><?php echo get_locale() ?></td>
						</tr>
						
						<tr>
							<td><?php esc_html_e( 'WP Memory Limit', 'mayosis' ); ?></td>
							<td><?php
								$memory = mayosis_let_to_num( WP_MEMORY_LIMIT );

								if ( $memory < 100663296 ) {
									echo '<mark class="error">' . sprintf(esc_html__('%s - We recommend setting memory to at least 96MB. %s.','mayosis'), size_format( $memory ), '<a href="' . esc_url('//teconce.com/help/increase-wordpress-memory-limit/') . '" target="_blank">'.esc_html__('More info','mayosis').'</a>') . '</mark>';
								} else {
									echo '<mark class="green">' . size_format( $memory ) . '</mark>';
								}
							?></td>
						</tr>
						
						
						
						<tr>
							<td><?php esc_html_e( 'PHP Max Input Vars', 'mayosis' ); ?></td>
							<td><?php
								$max_input = ini_get('max_input_vars');
								if ( $max_input < 3000 ) {
									echo '<mark class="error">' . sprintf( wp_kses(__( '%s - We recommend setting PHP max_input_vars to at least 3000. See: <a href="%s" target="_blank">Increasing the PHP max vars limit</a>', 'mayosis' ), array( 'a' => array( 'href' => array(),'target' => array() ) ) ), $max_input, '//teconce.com/help/increasing-max-input-vars/' ) . '</mark>';
								} else {
									echo '<mark class="green">' . $max_input . '</mark>';
								}
							?></td>
						</tr>
						<tr>
						  <td>
						     <?php esc_html_e( 'PHP Version', 'mayosis' ); ?> 
						  </td>
						  	<?php $php_version = PHP_VERSION . "\n";?>
						  <td>
						<mark class="green"><?php echo esc_attr($php_version); ?></mark>
						</td>
						</tr>
						
				</tbody>		
    </table>
        </div>
</div>

