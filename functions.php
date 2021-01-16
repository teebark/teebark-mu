<?php
/* Adds page name to classes for page */
add_filter('body_class','page_class');
function page_class($classes) {
   global $wp_query;
   $page = '';
   $page = $wp_query->query_vars['pagename'];
   // add 'pagename' to the $classes array
   $classes[] = $page;
   // return the $classes array
   return $classes;
}
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );

// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
	/* $error_message =  print_r($sorted_menu_items,true); */
	/* error_log ($error_message,3,'/home/teebarkc/logs/php-errors.log'); */
	/* $args -> sub_menu = 1; */
	/* $error_message =  print_r($args,true); */
	/* error_log ($error_message,3,'/home/teebarkc/logs/php-errors.log'); */
	
	if ( isset( $args->sub_menu ) ) {
		foreach ( $sorted_menu_items as $key => $item ) {
			if ( $item->menu_item_parent == '0' ) { // only get sub-menu items
				unset( $sorted_menu_items[$key] );
			}
		}
		$error_message = print_r($sorted_menu_items,true);
		error_log($error_message,3,'/home/teebarkc/logs/php-errors.log');
		return $sorted_menu_items;
	} 
	else {
		return $sorted_menu_items;
	}
	}
?>