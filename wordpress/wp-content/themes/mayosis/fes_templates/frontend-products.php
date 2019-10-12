<?php global $products; ?>
<h1 class="fes-headers" id="fes-products-page-title"><?php echo EDD_FES()->helper->get_product_constant_name( $plural = true, $uppercase = true ) ?></h1>
<?php echo EDD_FES()->dashboard->product_list_status_bar(); ?>

<table class="table fes-table table-condensed" id="fes-product-list">
	<thead>
		<tr>
			<th><?php esc_html_e( 'Image', 'mayosis' ); ?></th>
			<th><?php esc_html_e( 'Name', 'mayosis' ); ?></th>
			<th><?php esc_html_e( 'Price', 'mayosis' ); ?></th>
			<th><?php esc_html_e( 'Purchases', 'mayosis' ) ?></th>
			<th><?php esc_html_e( 'Actions','mayosis') ?></th>
			<th><?php esc_html_e( 'Date', 'mayosis' ); ?></th>
			<?php do_action('fes-product-table-column-title'); ?>
		</tr>
	</thead>
	<tbody>
		<?php
		if (count($products) > 0 ){
		foreach ( $products as $product ) : ?>
			<tr>
				<td class = "fes-product-list-td"><?php echo get_the_post_thumbnail( $product->ID, array(90,90)); ?></td>
				<td class = "fes-product-list-td fes_product_title"><?php echo EDD_FES()->dashboard->product_list_title($product->ID); ?>
				<p><?php echo EDD_FES()->dashboard->product_list_status($product->ID); ?></p>
				</td>
				<td class = "fes-product-list-td fes-price-data-main"><?php echo EDD_FES()->dashboard->product_list_price($product->ID); ?></td>
				<td class = "fes-product-list-td"><?php echo EDD_FES()->dashboard->product_list_sales_esc($product->ID); ?></td>
				<td class = "fes-product-list-td fes-action-buttons-main"><?php EDD_FES()->dashboard->product_list_actions($product->ID); ?></td>
				<td class = "fes-product-list-td fes-date-data-main"><?php echo EDD_FES()->dashboard->product_list_date($product->ID); ?></td>
				<?php do_action('fes-product-table-column-value'); ?>
			</tr>
		<?php endforeach;
		} else {
			echo '<tr><td colspan="7" class = "fes-product-list-td" >'. sprintf( _x('No %s found', 'FES lowercase plural setting for download','mayosis'), EDD_FES()->helper->get_product_constant_name( $plural = true, $uppercase = false ) ).'</td></tr>';
		}
		?>
	</tbody>
</table>
<?php EDD_FES()->dashboard->product_list_pagination();