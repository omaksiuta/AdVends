<form role="search" method="get" class="search_form" action="<?php echo esc_url(home_url('/')); ?>"><input type="text" class="search_field" placeholder="<?php esc_attr_e('Search &hellip;', 'sweet-dessert'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s" title="<?php esc_attr_e('Search for:', 'sweet-dessert'); ?>" /><button type="submit" class="search_button icon-search" href="#"></button></form>