<?php
// The Archive template file for babystreet-portfolio CPT.

get_header();
$babystreet_category_layout = json_decode(babystreet_get_option('portfoio_cat_layout'), true);

$babystreet_portfolio_style_class = $babystreet_category_layout['babystreet_portfolio_style_class'];
$babystreet_columns_class = $babystreet_category_layout['babystreet_columns_class'];

//If Masonry Fullwidth append fullwidth class to body
if ($babystreet_columns_class == 'babystreet_masonry_fullwidth') {

	$babystreet_inline_js = '(function ($) {"use strict"; $(document).ready(function () { $("#content > .inner").addClass("babystreet_masonry_fullwidth");});})(window.jQuery);';
	wp_add_inline_script('babystreet-front', $babystreet_inline_js);
	$babystreet_columns_class = '';
}

set_query_var('babystreet_portfolio_style_class', $babystreet_portfolio_style_class);
set_query_var('babystreet_columns_class', $babystreet_columns_class);

// Load the partial
get_template_part('partials/content', 'babystreet_portfolio_category');

get_footer();
