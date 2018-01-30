<?php
/**
 * function for return all post types name.
 *
 * @since    1.0
 * @access   public
 */

function return_post_types_names() {

	$post_types = get_post_types( '', 'names' );

	$exclude_post_type = array('revision','attachment','nav_menu_item','custom_css','customize_changeset','oembed_cache');

	$all_post_types = array();
	foreach ( $post_types  as $post_type ) {
		if( !in_array( $post_type, $exclude_post_type )) {
			$all_post_types[] = $post_type;
		}
	}
	return $all_post_types;
}