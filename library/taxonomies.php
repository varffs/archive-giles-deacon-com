<?php
function year_taxonomy() {
	$labels = array(
		'name'                       => 'Year',
		'singular_name'              => 'year',
		'menu_name'                  => 'Year',
		'all_items'                  => 'All Year',
		'parent_item'                => 'Parent Year',
		'parent_item_colon'          => 'Parent Year:',
		'new_item_name'              => 'New Year Name',
		'add_new_item'               => 'Add New Year',
		'edit_item'                  => 'Edit Year',
		'update_item'                => 'Update Year',
		'view_item'                  => 'View Year',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove items',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Items',
		'search_items'               => 'Search Items',
		'not_found'                  => 'Not Found',
		'no_terms'                   => 'No items',
		'items_list'                 => 'Items list',
		'items_list_navigation'      => 'Items list navigation',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'year', array( 'post' ), $args );
}
add_action( 'init', 'year_taxonomy', 0 );
?>